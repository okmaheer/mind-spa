<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use App\Services\PublishableRegistry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::orderBy('category')->orderBy('sort_order')->get();

        $stats = [
            'total'     => $tools->count(),
            'published' => $tools->filter(fn($t) => $t->isPublished())->count(),
            'draft'     => $tools->filter(fn($t) => $t->isDraft())->count(),
            'scheduled' => $tools->filter(fn($t) => $t->isScheduled())->count(),
        ];

        $categories = $tools->pluck('category')->unique()->sort()->values();

        return view('admin.tools.index', compact('tools', 'stats', 'categories'));
    }

    public function publish(int $id)
    {
        $tool = Tool::findOrFail($id);
        $tool->publish();
        $this->clearCaches($tool);

        if (request()->ajax()) {
            return response()->json([
                'status'       => $tool->publishingStatus(),
                'published_at' => $tool->published_at->format('d M Y, H:i'),
            ]);
        }

        return back()->with('success', "\"{$tool->name}\" is now published.");
    }

    public function unpublish(int $id)
    {
        $tool = Tool::findOrFail($id);
        $tool->unpublish();
        $this->clearCaches($tool);

        if (request()->ajax()) {
            return response()->json([
                'status'       => $tool->publishingStatus(),
                'published_at' => null,
            ]);
        }

        return back()->with('success', "\"{$tool->name}\" has been set to draft.");
    }

    public function schedule(Request $request, int $id)
    {
        $request->validate([
            'date' => ['required', 'date', 'after:now'],
        ]);

        $tool = Tool::findOrFail($id);
        $tool->scheduleTo($request->input('date'));
        $this->clearCaches($tool);

        $date = \Illuminate\Support\Carbon::parse($request->input('date'))->format('d M Y, H:i');

        return back()->with('success', "\"{$tool->name}\" is scheduled for {$date}.");
    }

    private function clearCaches(Tool $tool): void
    {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        PublishableRegistry::clearCache($tool->slug);
    }
}
