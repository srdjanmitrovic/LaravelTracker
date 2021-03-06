<?php namespace Arcanedev\LaravelTracker\Trackers;

use Arcanedev\LaravelTracker\Contracts\Trackers\ErrorTracker as ErrorTrackerContract;
use Arcanedev\LaravelTracker\Support\BindingManager;
use Exception;

/**
 * Class     ErrorTracker
 *
 * @package  Arcanedev\LaravelTracker\Trackers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ErrorTracker extends AbstractTracker implements ErrorTrackerContract
{
    /* -----------------------------------------------------------------
     |  Getters and Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the model.
     *
     * @return \Arcanedev\LaravelTracker\Models\Error
     */
    protected function getModel()
    {
        return $this->makeModel(BindingManager::MODEL_ERROR);
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Track the exception error.
     *
     * @param  \Exception  $exception
     *
     * @return int
     */
    public function track(Exception $exception)
    {
        return $this->getModel()->newQuery()->firstOrCreate([
            'code'    => $this->getCode($exception),
            'message' => $exception->getMessage(),
        ])->getKey();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the code from the exception.
     *
     * @param  \Exception  $exception
     *
     * @return int|mixed|null
     */
    public function getCode(Exception $exception)
    {
        if (method_exists($exception, 'getCode') && $code = $exception->getCode())
            return $code;

        if (method_exists($exception, 'getStatusCode') && $code = $exception->getStatusCode())
            return $code;

        return null;
    }
}
