<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Spatie\Feed\Feedable;

use App\Starter;

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
     * @param  Builder $query
     * @param  string  $search
     *
     * @return Builder
     */
    public function scopeSearch($query, ?string $search)
    {
        return $query->when($search, function (Builder $query, $search) {
            return $query->where('title', 'LIKE', '%' . $search . '%')
                         ->orWhere('message', 'LIKE', '%' . $search . '%');
        });
    }

    /**
     * @param  Builder $query
     *
     * @return Builder
     */
    public function scopeJobs($query)
    {
        //TODO:後で変更
        //$expired = now()->subRealDays(30);
        //$expired = now()->subRealDays(Starter::expired());

        return $query->latest('updated_at')
            //->where('updated_at', '>=', $expired)
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
