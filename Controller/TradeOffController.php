<?php

/**
 * Created by PhpStorm.
 * User: moise.convolbo
 * Date: 2017/04/12
 * Time: 16:57
 */
class TradeOffController
{
    private $model;
    private $view;
    private $url;
    private $dilemmaFile;


    public function __construct($url)
    {

        $this->model = new TradeOffModel();
        $this->view = new Template();
        $this->url = $url;
        $this->dilemmaFile =  array('data' => 'problem.json');
    }


        public function SolveDilemma(){


            // create a new cURL resource
            $ch = curl_init();
            // set URL and other appropriate options
            curl_setopt($ch, CURLOPT_URL, $this->url);
            curl_setopt($ch, CURLOPT_HEADER, array('Content-Type: application/json','Accept: application/xml'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->dilemmaFile);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POST, 0);
            curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, TRADEOFFUSERNAME .":".TRADEOFFPASSWORD);
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_STDERR, fopen("headers.txt", "w+"));
            $ckfile = tempnam ("/", 'MyCookie');
            curl_setopt ($ch, CURLOPT_COOKIEFILE, $ckfile);

            $result = curl_exec($ch);
            $info = curl_getinfo($ch);

            var_dump($result);

            // Will dump a beauty json :3
            //var_dump(json_decode($result, true));
            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($result, 0, $header_size);
            $body = substr($result, $header_size);
            $result = json_decode($body, true);


            $err = curl_getinfo($ch,CURLINFO_HTTP_CODE);
            // close cURL resource, and free up system resources
            curl_close($ch);

            exit();

        }

}