<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Feed\Feedable;

class User extends Authenticatable implements Feedable
{
    use Notifiable;
    use Feed\UserFeed;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'avatar',
        'hidden',
        'title',
        'message',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'hidden' => 'boolean',
    ];

    /**
     * @param  Builder  $query
     * @param  string  $search
     *
     * @return Builder
     */
    public function scopeSearch($query, ?string $search)
    {
        return $query->when(
            $search,
            function (Builder $query, $search) {
                return $query->where('title', 'LIKE', '%'.$search.'%')
                             ->orWhere('message', 'LIKE', '%'.$search.'%')
                             ->orWhere('name', 'LIKE', '%'.$search.'%');
            }
        );
    }

    /**
     * @param  Builder  $query
     * @param  int  $page
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function scopeArtisans($query, ?int $page = 20)
    {
        return $query->latest('updated_at')
                     ->whereHidden(false)
                     ->with('tags')
                     ->paginate($page);
    }

    /**
     * モデルのルートキーの取得.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? 'name', $value)
                    ->with(
                        [
                            'tags',
                            'posts' => function ($query) {
                                $query->latest('updated_at')->limit(5);
                            },
                        ]
                    )->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->orderBy('tag');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
