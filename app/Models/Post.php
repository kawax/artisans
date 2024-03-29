<?php

namespace App\Models;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;

class Post extends Model implements Feedable
{
    use HasFactory;
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
     * @return Builder
     */
    public function scopeSearch(Builder $query, ?string $search)
    {
        return $query->when($search, function (Builder $query, $search) {
            return $query->where(function (Builder $query) use ($search) {
                $query->where('title', 'LIKE', '%'.$search.'%')
                    ->orWhere('message', 'LIKE', '%'.$search.'%');
            });
        });
    }

    /**
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeArticles($query)
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
