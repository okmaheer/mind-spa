<?php

namespace App\Traits;

use Illuminate\Support\Carbon;

trait HasPublishing
{
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->whereNull('published_at');
    }

    public function scopeScheduled($query)
    {
        return $query->whereNotNull('published_at')
                     ->where('published_at', '>', now());
    }

    public function isPublished(): bool
    {
        return $this->published_at !== null && $this->published_at->isPast();
    }

    public function isDraft(): bool
    {
        return $this->published_at === null;
    }

    public function isScheduled(): bool
    {
        return $this->published_at !== null && $this->published_at->isFuture();
    }

    public function publishingStatus(): string
    {
        if ($this->isScheduled()) return 'scheduled';
        if ($this->isPublished()) return 'published';
        return 'draft';
    }

    public function publish(): bool
    {
        return $this->forceFill(['published_at' => now()])->save();
    }

    public function unpublish(): bool
    {
        return $this->forceFill(['published_at' => null])->save();
    }

    public function scheduleTo(Carbon|string $date): bool
    {
        return $this->forceFill(['published_at' => Carbon::parse($date)])->save();
    }
}
