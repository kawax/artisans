<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Builder;

use Illuminate\Mail\Markdown;

use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class User extends Authenticatable implements Feedable
{
    use Notifiable;

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
     * @param  Builder $query
     * @param  string  $search
     *
     * @return Builder
     */
    public function scopeSearch($query, ?string $search)
    {
        return $query->when($search, function (Builder $query, $search) {
            return $query->where('title', 'LIKE', '%' . $search . '%')
                         ->orWhere('message', 'LIKE', '%' . $search . '%')
                         ->orWhere('name', 'LIKE', '%' . $search . '%');
        });
    }

    /**
     * @param  Builder $query
     * @param  int     $page
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
     * @return array|FeedItem
     */
    public function toFeedItem()
    {
        return FeedItem::create()
                       ->id('user/' . $this->id)
                       ->title($this->title ?? $this->name ?? 'no title')
                       ->summary(Markdown::parse(e($this->message)))
                       ->updated($this->updated_at)
                       ->link(route('user', $this))
                       ->author($this->name);
    }

    /**
     * @return mixed
     */
    public static function getFeedItems()
    {
        return cache()->remember('feed.users', now()->addHours(12), function () {
            return self::latest()
                       ->whereHidden(false)
                       ->take(50)
                       ->get();
        });
    }

    /**
     * モデルのルートキーの取得
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
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
