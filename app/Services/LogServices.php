<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class LogServices
{
    /**
     * Write info log
     *
     * @param mixed  $details
     * @param string $channel
     * @return bool
     */
    public static function createInfoLog($details, $channel = 'top_ten_bazar')
    {
        Log::channel($channel)->info(self::normalizeDetails($details));
        return true;
    }

    /**
     * Write error log
     *
     * @param mixed  $details
     * @param string $channel
     * @return bool
     */
    public static function createErrorLog($details, $channel = 'top_ten_bazar')
    {
        Log::channel($channel)->error(self::normalizeDetails($details));
        return true;
    }

    /**
     * Write warning log
     *
     * @param mixed  $details
     * @param string $channel
     * @return bool
     */
    public static function createWarningLog($details, $channel = 'top_ten_bazar')
    {
        Log::channel($channel)->warning(self::normalizeDetails($details));
        return true;
    }

    /**
     * Ensure details are loggable
     *
     * @param mixed $details
     * @return string
     */
    private static function normalizeDetails($details): string
    {
        if (is_array($details) || is_object($details)) {
            return json_encode($details, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        return (string) $details;
    }
}
