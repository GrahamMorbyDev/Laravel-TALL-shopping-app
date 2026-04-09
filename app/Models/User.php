<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the focus tasks for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function focusTasks(): HasMany
    {
        return $this->hasMany(FocusTask::class);
    }

    /**
     * Get the user's focus tasks using the default UI sorting.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function focusTasksSorted(): HasMany
    {
        return $this->hasMany(FocusTask::class)->sorted();
    }
}
