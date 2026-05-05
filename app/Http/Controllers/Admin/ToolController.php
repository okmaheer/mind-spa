<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use App\Services\PublishableRegistry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class ToolController extends Controller
{
    public function index()
    {
        $grouped = Tool::orderBy('category')
                       ->orderBy('sort_order')
                       ->get()
                       ->groupBy('category');

        return view('admin.tools.index', compact('grouped'));
    }

    public function publish(int $id)
    {
        $tool = Tool::findOrFail($id);
        $tool->publish();
        $this->clearCaches($tool);

        return back()->with('success', "\"{$tool->name}\" is now published.");
    }

    public function unpublish(int $id)
    {
        $tool = Tool::findOrFail($id);
        $tool->unpublish();
        $this->clearCaches($tool);

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
