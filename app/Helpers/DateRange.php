<?php

namespace App\Helpers;

class DateRange
{

    public static function getDates($name)
    {
        //Default is this month
        switch($name) {
            case 'last_month':
                $range = [
                    'start' => now()->subMonth()->startOfMonth(),
                    'end' => now()->subMonth()->endOfMonth()
                ];
                break;
            case 'last_week':
                $range = [
                    'start' => now()->subWeek()->startOfWeek(),
                    'end' => now()->subWeek()->endOfWeek()
                ];
                break;
            case 'today':
                $range = [
                    'start' => now()->startOfDay(),
                    'end' => now()->endOfDay()
                ];
                break;
            default:
                $range = [
                    'start' => now()->startOfMonth(),
                    'end' => now()->endOfMonth()
                ];
        }
        return $range;
    }

}
