<?php namespace Arcanedev\LaravelTracker\Trackers;

use Arcanedev\LaravelTracker\Contracts\Trackers\CookieTracker as CookieTrackerContract;
use Arcanedev\LaravelTracker\Models\Cookie;
use Illuminate\Contracts\Cookie\QueueingFactory as CookieJar;
use Ramsey\Uuid\Uuid;

/**
 * Class     CookieTracker
 *
 * @package  Arcanedev\LaravelTracker\Trackers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CookieTracker implements CookieTrackerContract
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * CookieTracker constructor.
     */
    public function __construct()
    {
        //
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Track the cookie.
     *
     * @param  mixed  $cookie
     *
     * @return int
     */
    public function track($cookie)
    {
        if ( ! $cookie) {
            $cookie = (string) Uuid::uuid4();

            app(CookieJar::class)->queue(config('laravel-tracker.cookie.name'), $cookie, 0);
        }

        return Cookie::firstOrCreate(['uuid' => $cookie])->id;
    }
}
