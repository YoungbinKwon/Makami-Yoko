<?php

class GoraPlanSearch {

    private $url_base;
    private $appl_id;

    public function __construct()
    {
        $this->url_base = 'https://app.rakuten.co.jp/services/api/Gora/GoraPlanSearch/20150706?format=json';
        $this->appl_id = GORAAPPID;
    }

    public function getPlan($data)
    {
        $ch = curl_init();
        $url = $this->url_base . "&applicationId=" . $this->appl_id;

        foreach ($data as $key => $value) {
            $url .= "&" . $key . "=" . $value;
        }

        $params = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        );

        curl_setopt_array($ch, $params);
        $result = curl_exec($ch);
        curl_close($ch);
        $decoded = json_decode($result, true);
        
        return $decoded;
    }

    public function setParam($data)
    {
        $params = ['areaCode'=> 13,'playDate' => date("Y-m-d",strtotime("+2 week"))];
        foreach ($data as $key => $value) {
            switch ($key) {
                case "date":
                    $params['playDate'] = $this->setDate($value['code']);
                    break;
                case "areaCode":
                    $params['areaCode'] = (int) $value['code'];
                    break;
                case "time":
                    $params['startTimeZone'] = (int) $value['code'];
                    break;
                default:
                    break;
            }
        }
var_dump($params);
        return $params;
    }

    private function setDate($date)
    {
        switch ($date) {
            case "today":
                $param = date("Y-m-d");
                break;
            case "tomorrow":
                $param = date("Y-m-d",strtotime("+1 day"));
                break;
            case "2day":
                $param = date("Y-m-d",strtotime("+2 day"));
                break;
            case "nextweek":
                $param = date("Y-m-d",strtotime("+1 week"));
                break;
            case "twoweek":
                $param = date("Y-m-d",strtotime("+2 week"));
                break;
            case "nextmonth":
                $param = date("Y-m-d",strtotime("+1 month"));
                break;
            case "twomonth":
                $param = date("Y-m-d",strtotime("+2 month"));
                break;
            default:
                $param = date("Y-m-d",strtotime("+2 week"));
                break;
        }

        return $param;
    }

    function getDateFromDayOfWeek($year, $month, $week, $day_of_week){ 
        if($wday - $target >= 0) {
            $day = $day - ($wday - $target);
        } else {
            $day = $day + ($target - $wday) - 7;
        }
        $time = mktime(0,0,0,$month, $day, $year);
        return date("Y-m-d", $time);
    }

}
