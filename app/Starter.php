<?php

namespace App;

use App\Model\User;

//TODO:後で削除
class Starter
{
    /**
     * @param int $count
     *
     * @return bool
     * @throws
     */
    public static function can($count): bool
    {
        if (auth()->check() and auth()->user()->id === config('artisans.admin_id')) {
            return true;
        }

        $user_count = cache()->remember('user_count', now()->addHours(1), function () {
            return User::count();
        });

        return $user_count >= $count;
    }

    /**
     * @return int
     */
    public static function expired(): int
    {
        if (self::can(config('artisans.starter.step3'))) {
            return 30;
        } elseif (self::can(config('artisans.starter.step2'))) {
            return 20;
        } elseif (self::can(config('artisans.starter.step1'))) {
            return 10;
        }

        return 10;
    }
}
