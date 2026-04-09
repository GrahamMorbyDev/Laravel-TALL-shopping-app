<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class FocusTask extends Model
{
    use HasFactory;

    public const PRIORITY_LOW = 'low';
    public const PRIORITY_MEDIUM = 'medium';
    public const PRIORITY_HIGH = 'high';

    public static function priorities(): array
    {
        return [
            self::PRIORITY_LOW,
            self::PRIORITY_MEDIUM,
            self::PRIORITY_HIGH,
        ];
    }

    protected $fillable = [
        'title',
        'notes',
        'is_completed',
        'priority',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
    ];

    protected $attributes = [
        'is_completed' => false,
        'priority' => self::PRIORITY_MEDIUM,
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
     * Scope to apply the sorting used by the UI:
     * 1) incomplete tasks first
     * 2) highest priority first (high, medium, low)
     * 3) newest tasks first
     */
    public function scopeSorted(Builder $query): Builder
    {
        // is_completed: false (0) before true (1) -> ASC
        // priority: order high, medium, low
        // created_at: newest first
        return $query
            ->orderBy('is_completed', 'asc')
            ->orderByRaw("FIELD(priority, '" . self::PRIORITY_HIGH . "', '" . self::PRIORITY_MEDIUM . "', '" . self::PRIORITY_LOW . "')")
            ->orderBy('created_at', 'desc');
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
