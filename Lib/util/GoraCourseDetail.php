<?php

class GoraCourseDetail {

    private $url_base;
    private $appl_id;

    public function __construct()
    {
        $this->url_base = 'https://app.rakuten.co.jp/services/api/Gora/GoraGolfCourseDetail/20140410?format=json';
        $this->appl_id = GORAAPPID;
    }

    public function getCourseDetail($course_id)
    {
        $ch = curl_init();
        $url = $this->url_base . "&applicationId=" . $this->appl_id;
        $url .= "&" . "golfCourseId" . "=" . $course_id;

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
}
