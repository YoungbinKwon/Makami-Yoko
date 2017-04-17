<?php
class VoiceSearchController
{
    private $request;
    private $model;
    private $view;
    private $url;

    public function __construct($url)
    {
        $this->model = new VoiceSearchModel();
        $this->view = new Template();
        $this->url = $url;
    }

    public function searchAction()
    {
        $this->view->display("VoiceSearch/search.tpl");
    }

    public function resultAction(){
        if (isset($_POST["audio"])) {

            $user_id   = $_POST["userid"];
            $customer  = new Customer();
            $user_info = $customer->selectById($user_id);
$trade_off = new Tradeoff();
exit();
            //Get text from voice
            $stt = new SpeechToText();
            $voice_result = $stt->getText($_POST["audio"]);
            $results = $voice_result->results;

            if ($results[0]->alternatives) {
                $alternatives = $results[0]->alternatives;
                $transcript = $alternatives[0]->transcript;
            } else {
                $transcript = "";
            }

            $user_id   = 2;
            $customer  = new Customer();
            $user_info = $customer->selectById($user_id);
/*
$transcript = "北海道のゴルフ場 明日";
            //Get parameters from text
            $nlc = new NaturalLanguageClassifier();
            if ($transcript != "") {
                $divided_words = $nlc->divideWordsByIgo($transcript);
            } else {
                $divided_words = [];
            }
*/
$nlc = new NaturalLanguageClassifier();
$divided_words = ['東京'];

            $class_results = $nlc->classifyWords($divided_words);
            //Call Gora API and get plan
            $gora_plan = new GoraPlanSearch();
            $params = $gora_plan->setParam($class_results);

            $gora_result = $gora_plan->getPlan($params);
            $plan_info_array = [];
            $course_id_array = [];
            $destination = [];
            $i = 0;
            if (isset($gora_result['Items'])) {
                foreach ($gora_result['Items'] as $key => $item) {
                    if (!empty($item['Item']['planInfo'])) {
                        foreach ($item['Item']['planInfo'] as $plan) {
                            if(strpos($plan['plan']['planName'],'ハーフ') === false && strpos($plan['plan']['planName'],'ショートコース') === false && strpos($plan['plan']['planName'],'楽ゴル') === false && strpos($plan['plan']['planName'],'レッスン') === false && strpos($plan['plan']['planName'],'アーリーバード') === false && strpos($plan['plan']['planName'],'以上') === false && strpos($item['Item']['golfCourseName'],'ショートコース') === false && strpos($item['Item']['golfCourseName'],'楽ゴル') === false && strpos($item['Item']['golfCourseName'],'レッスン') === false){
                                $plan_info_array[$plan['plan']['planId']] = $plan['plan'];
                                $plan_info_array[$plan['plan']['planId']]['golfCourseId'] = $item['Item']['golfCourseId'];
                                $course_id_array[$item['Item']['golfCourseId']] = $item['Item']['golfCourseId'];
                                $destination[$item['Item']['golfCourseId']]['from'] = $user_info[$user_id]['address'];
                                $course_name = preg_replace("/(\(|（).*(\)|）)/","",$item['Item']['golfCourseName']);
                                $course_name = preg_replace("/【(.*?)】/","",$course_name);
                                $destination[$item['Item']['golfCourseId']]['to'] = $course_name;
                                $i++;
                            }
                        }
                    }
                    if ($i >= 10) {
                        break;
                    }
                }
            } else {
                $tts = new TextToSpeech();
                $this->view->result_text = $tts->getAudio("大変残念ながらご希望のプランはございませんでした");
                $this->view->display("VoiceSearch/noresult.tpl");
                exit();
            }
            $gora_result = [];
            if ($i == 0) {
                $tts = new TextToSpeech();
                $this->view->result_text = $tts->getAudio("大変残念ながらご希望のプランはございませんでした");
                $this->view->display("VoiceSearch/noresult.tpl");
                exit();
            }

            //Make parameters for tradeoff
            $google_map = new GoogleMapApi();
            foreach ($course_id_array as $course_id) {
                $course_info[$course_id]['time'] = $google_map->getDistance($destination[$course_id]['from'], $destination[$course_id]['to']);
                $course_info[$course_id]['weather'] = 100;
            }


            $trade_off_data = [];
            foreach ($plan_info_array as $plan_id => $plan_info) {
                $trade_off_data[$plan_id]['price'] = $plan_info['price'];
                
                // TODO make function to get time
                $trade_off_data[$plan_id]['distance'] = $course_info[$plan_info['golfCourseId']]['time'];
                
                // TODO make function to get weather
                $trade_off_data[$plan_id]['weather'] = $course_info[$plan_info['golfCourseId']]['weather'];
                
                if (!empty($plan_info['startTimeZone'])) {
                    $time = preg_replace("/時台/","",$plan_info['startTimeZone']);
                    $time = preg_replace("/、/",",",$time);
                    $trade_off_data[$plan_id]['time'] = $time;
                } else {
                    $trade_off_data[$plan_id]['time'] = 10;
                }
            }

 //           $trade_off = new Tradeoff();
exit();
            $trade_off_results = $trade_off->getPlanByTradeOff($trade_off_data);

            $recommend_value = explode('_', $trade_off_results['Preferable_List'][0]);
            $recommend_plan_id = $recommend_value[0];

            //Get golf course detail to show
            $gora_course = new GoraCourseDetail();
            $course_info = $gora_course->getCourseDetail($plan_info_array[$recommend_plan_id]['golfCourseId']);

            //Make parameters for display
            $display_data['plan'] = $plan_info_array[$recommend_plan_id];
            $display_data['course'] = $course_info;
            $display_data['time'] = $recommend_value[1];
            if (@file_get_contents('https://gora.golf.rakuten.co.jp/img/golf/'. $plan_info_array[$recommend_plan_id]['golfCourseId'] . '/img/c0/01.jpg') !== false) {
                $display_data['image1'] = 'https://gora.golf.rakuten.co.jp/img/golf/'. $plan_info_array[$recommend_plan_id]['golfCourseId'] . '/img/c0/01.jpg';
            } else {
                $display_data['image1'] = 'https://gora.golf.rakuten.co.jp/img/golf/10054/middle_img/c1/19_01.jpg';
            }

            if (@file_get_contents('https://gora.golf.rakuten.co.jp/img/golf/'. $plan_info_array[$recommend_plan_id]['golfCourseId'] . '/img/c0/02.jpg') !== false) {
                $display_data['image2'] = 'https://gora.golf.rakuten.co.jp/img/golf/'. $plan_info_array[$recommend_plan_id]['golfCourseId'] . '/img/c0/02.jpg';
            } else {
                $display_data['image2'] = 'https://gora.golf.rakuten.co.jp/img/golf/10054/middle_img/c0/001.jpg';
            }

            if (@file_get_contents('https://gora.golf.rakuten.co.jp/img/golf/'. $plan_info_array[$recommend_plan_id]['golfCourseId'] . '/img/c1/01_01.jpg') !== false) {
                $display_data['image3'] = 'https://gora.golf.rakuten.co.jp/img/golf/'. $plan_info_array[$recommend_plan_id]['golfCourseId'] . '/img/c1/01_01.jpg';
            } else {
                $display_data['image3'] = 'https://gora.golf.rakuten.co.jp/img/golf/10054/middle_img/c0/04.jpg';
            }

            if (@file_get_contents('https://gora.golf.rakuten.co.jp/img/golf/'. $plan_info_array[$recommend_plan_id]['golfCourseId'] . '/img/c1/02_01.jpg') !== false) {
                $display_data['image4'] = 'https://gora.golf.rakuten.co.jp/img/golf/'. $plan_info_array[$recommend_plan_id]['golfCourseId'] . '/img/c1/02_01.jpg';
            } else {
                $display_data['image4'] = 'https://gora.golf.rakuten.co.jp/img/golf/10135/img/c1/05_03.jpg';
            }

            if (@file_get_contents('https://gora.golf.rakuten.co.jp/img/golf/'. $plan_info_array[$recommend_plan_id]['golfCourseId'] . '/img/c1/03_01.jpg') !== false) {
                $display_data['image5'] = 'https://gora.golf.rakuten.co.jp/img/golf/'. $plan_info_array[$recommend_plan_id]['golfCourseId'] . '/img/c1/03_01.jpg';
            } else {
                $display_data['image5'] = 'https://gora.golf.rakuten.co.jp/img/golf/10054/middle_img/c5/01_01.jpg';
            }

            if (@file_get_contents('https://gora.golf.rakuten.co.jp/img/golf/'. $plan_info_array[$recommend_plan_id]['golfCourseId'] . '/img/c1/04_01.jpg') !== false) {
                $display_data['image6'] = 'https://gora.golf.rakuten.co.jp/img/golf/'. $plan_info_array[$recommend_plan_id]['golfCourseId'] . '/img/c1/04_01.jpg';
            } else {
                $display_data['image6'] = 'https://gora.golf.rakuten.co.jp/img/golf/10054/middle_img/c5/07_01.jpg';
            }

            $yoko = new Yoko();
            $yoko_user = $yoko->getYoko($user_info[$user_id]['play_count']);
            $this->view->results = $display_data;
            $this->view->user_info = $user_info[$user_id];
            $this->view->yoko_user = $yoko_user;
            $tts = new TextToSpeech();

            $this->view->result_text = $tts->getAudio($course_info['Item']['golfCourseNameKana'] . "の" . $plan_info_array[$recommend_plan_id]['planName']  . " が おすすめだよ " . " 予約いたしましょうか？");
        }

        $this->view->display("VoiceSearch/result.tpl");
    }
}
