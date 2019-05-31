<?php

namespace App\Model;

use Spatie\Feed\Feedable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model implements Feedable
{
    use Feed\PostFeed;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'message',
    ];

    /**
     * @param  Builder  $query
     * @param  string  $search
     *
     * @return Builder
     */
    public function scopeSearch($query, ?string $search)
    {
        return $query->when($search, function (Builder $query, $search) {
            return $query->where('title', 'LIKE', '%'.$search.'%')
                         ->orWhere('message', 'LIKE', '%'.$search.'%');
        });
    }

    /**
     * @param  Builder  $query
     *
     * @return Builder
     */
    public function scopeJobs($query)
    {
        return $query->latest('updated_at')
                     ->with('user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
