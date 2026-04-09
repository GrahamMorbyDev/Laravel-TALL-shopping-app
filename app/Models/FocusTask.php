<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class FocusTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'notes',
        'is_completed',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
    ];

    protected $attributes = [
        'is_completed' => false,
    ];

    /**
     * Scope to filter tasks by completion status.
     *
     * Accepted values for $filter:
     * - 'all' or null: no filtering
     * - 'active': only tasks where is_completed = false
     * - 'completed': only tasks where is_completed = true
     */
    public function scopeFilterByCompletion(Builder $query, ?string $filter): Builder
    {
        if ($filter === 'active') {
            return $query->where('is_completed', false);
        }

        if ($filter === 'completed') {
            return $query->where('is_completed', true);
        }

        return $query;
    }

    /**
     * Mark the task as completed.
     */
    public function markComplete(): bool
    {
        $this->is_completed = true;

        return $this->save();
    }

    /**
     * Mark the task as not completed.
     */
    public function markIncomplete(): bool
    {
        $this->is_completed = false;

        return $this->save();
    }

    /**
     * Set completion to the given value.
     */
    public function setCompleted(bool $value): bool
    {
        $this->is_completed = $value;

        return $this->save();
    }

    /**
     * Relationship to owning user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
