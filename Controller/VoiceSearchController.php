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
/*        if (isset($_POST["audio"])) {
            //Get text from voice
            $voice_result = $stt->getText($_POST["audio"]);
            $results = $voice_result->results;

            if ($results[0]->alternatives) {
                $alternatives = $results[0]->alternatives;
                $transcript = $alternatives[0]->transcript;
            } else {
                echo('もう一度お願いします。');
                $this->view->display("VoiceSearch/search.tpl");
            }
*/
$transcript = "東京のゴルフ場朝から";
            //Get parameters from text
            $nlc = new NaturalLanguageClassifier();
            $divided_words = $nlc->divideWordsByIgo($transcript);
            $class_results = $nlc->classifyWords($divided_words);

            //Call Gora API and get plan
            $gora_plan = new GoraPlanSearch();
            $params = $gora_plan->setParam($class_results);
            $gora_result = $gora_plan->getPlan($params);
            $plan_info_array = [];
            $course_id_array = [];
            $destination = [];

            $i = 0;

            foreach ($gora_result['Items'] as $key => $item) {
                if (!empty($item['Item']['planInfo'])) {
                    foreach ($item['Item']['planInfo'] as $plan) {
                        if (!empty($plan['plan']['startTimeZone'])) {
                            $plan_info_array[$plan['plan']['planId']] = $plan['plan'];
                            $plan_info_array[$plan['plan']['planId']]['golfCourseId'] = $item['Item']['golfCourseId'];
                            $course_id_array[$item['Item']['golfCourseId']] = $item['Item']['golfCourseId'];
                            $destination[$item['Item']['golfCourseId']]['from'] = "東京";
                            $course_name = preg_replace("/(\(|（).*(\)|）)/","",$item['Item']['golfCourseName']);
                            $course_name = preg_replace("/【(.*?)】/","",$course_name);
                            $destination[$item['Item']['golfCourseId']]['to'] = $course_name;
                            $i++;
                        }
                    }
                }
                if ($i == 5) {
                    break;
                }
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

                $time = preg_replace("/時台/","",$plan_info['startTimeZone']);
                $time = preg_replace("/、/",",",$time);
                $trade_off_data[$plan_id]['time'] = $time;
            }
            //Run tradeoff
            $recommend_plan_id = $plan_id;
            /* 
            TODO make tradeoff
            $trade_off = new Tradeoff();
            $recommend_plan_id = $trade_off->getRecommendPlan($trade_off_data);
            */

            //Get golf course detail to show
            $gora_course = new GoraCourseDetail();
            $course_info = $gora_course->getCOurseDetail($plan_info_array[$recommend_plan_id]['golfCourseId']);

            //Make parameters for display
            $display_data['plan'] = $plan_info_array[$plan_id];
            $display_data['course'] = $course_info;
var_dump($display_data);
            $this->view->class_results = $class_results;
//        }

        $this->view->display("VoiceSearch/search.tpl");
    }

    public function resultAction(){
        $this->view->display("VoiceSearch/result.tpl");
    }
}
