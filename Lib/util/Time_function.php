<?php
/**
 * Created by PhpStorm.
 * User: moise.convolbo
 * Date: 2017/04/14
 * Time: 17:37
 */
class Time_function {

    private $timeTag;
    private $timeTable;
    public function __construct()
    {
         $this->timeTag = "PROPORTIONAL";
         $this->timeTable = array(
             "6" => 0.0182,
             "7" => 0.1995,
             "8" => 0.2703,
             "9" => 0.2613,
             "10" => 0.1848,
             "11" => 0.0132,
             "12" => 0.0267,
             "13" => 0.0147,
             "14" => 0.0073,
             "15" => 0.0035,
              "16" => 0.0004
         );
    }

    public function getTimeValue($time)
    {
        $val = 0;
        if($time >= 6 && $time <=16 ){
            $val = $this->timeTable["$time"];
        }
        return $val;
    }

}
