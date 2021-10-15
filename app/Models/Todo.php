<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'complete', 'description', 'user_id'
    ];

    /**
     *
     * Attributes that should be casted to either a date, array or boolean
     *
     * @var array
     */
    protected $casts = [
        'complete' => 'boolean',
        'user_id'  => 'int'
    ];

    /**
     * Returns a relation with the user.
     *
     * This can be accessed through by calling:
     * $model->user
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class
        );
    }

    /**
     * Query Scope for owned.
     *
     * @param Builder $query
     * @param int $user_id
     * @return Builder
     */
    public function scopeOwned(Builder $query, int $user_id): Builder
    {
        return $query->where('user_id', $user_id);
    }

}
