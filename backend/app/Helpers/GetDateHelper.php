<?php


namespace App\Helpers;


class GetDateHelper
{
    public function getTodayTimestamp($hour = null, $minute = null)
    {
        $getDate = getdate();
        if($hour !== null){
            $getDate['hours'] = $hour;
        }
        if($minute !== null){
            $getDate['minutes'] = $minute;
        }
        return $this->getTimestamp($getDate);
    }

    public function parseTime($string)
    {
        $data = explode(':', $string);
        $time = new class{};
        $time->hours = +$data[0];
        $time->minutes = +$data[1];
        $time->second = 0;
        return $time;
    }

    private function getTimestamp($getDate)
    {
        $year = $getDate['year'];
        $mon = $getDate['mon'];
        $day = $getDate['mday'];
        $hours = $getDate['hours'];
        $minutes = $getDate['minutes'];
        $timestamp = mktime($hours, $minutes, 0, $mon, $day, $year);
        return $timestamp;
    }

    public function currentTimestamp()
    {
        $date = new \DateTime();
        return $date->getTimestamp();
    }
}
