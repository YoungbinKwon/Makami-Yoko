<?php

class TradeOff
{
    private $model;
    private $view;
    private $url;
    private $dilemmaFile;

    public function __construct()
    {

        $this->model = new TradeOffModel();
        $this->view = new Template();
        $this->url = "https://gateway.watsonplatform.net/tradeoff-analytics/api/v1/dilemmas/";
        $this->dilemmaFile = array('data' =>"@problem_w.json");
        $this->url_base = 'https://gateway.watsonplatform.net/tradeoff-analytics/api';
        $this->username = TRADEOFFUSERNAME;
        $this->password = TRADEOFFPASSWORD;

    }

    public function getPlanByTradeOff($Tradeoff_data){

        $endpoint_url = "https://gateway.watsonplatform.net/tradeoff-analytics/api/v1/dilemmas/?find_preferable_options=true";
        $credentials = [
            "username" => TRADEOFFUSERNAME,
            "password" => TRADEOFFPASSWORD
        ];
        $credentials_text = "{$credentials['username']}: {$credentials['password']}";

        /* ============OBJECTIVE INPUT=================== */
        $rows[] = array(
            "name" => "price",
            "type" => "numeric",
            "is_objective" => true,
            "goal" => "min"
        );
        $rows[] = array(
            "name" => "weather",
            "type" => "numeric",
            "is_objective" => true,
            "goal" => "max"
        );
        $rows[] = array(
            "name" => "distance",
            "type" => "numeric",
            "is_objective" => true,
            "goal" => "min"
        );
        $rows[] = array(
            "name" => "time",
            "type" => "numeric",
            "is_objective" => true,
            "goal" => "max"
        );
        /*================================================= */

        /* ============OBJECTIVE COLUMNS=================== */
        $count=1;
        foreach ($rows as $key => $value){
            $objective_items[] = array(
                "key" => $value['name'],
                "full_name" => $value['name'],
                "type" => $value['type'],
                "is_objective" => $value['is_objective'],
                "goal" => $value['goal']
            );

        }

        /*================================================= */
        $TimerVal = new Time_function();
        foreach ($Tradeoff_data as $key => $value)
        {

            $num= explode(",", $value['time']);
            for ($i = 0; $i < count($num); $i++){
                $js_price = $value['price'];
                $js_weather = $value['weather'];
                $js_distance = $value['distance'];
                $js_time = $TimerVal->getTimeValue($num[$i]);
                $js_planId = $key;

                $object_data = json_encode(
                    array("price" => $js_price,
                        "weather" => $js_weather,
                        "distance" => $js_distance,
                        "time" => $js_time
                    ));

                $items[] = array('key'=> $js_planId."_".$num[$i], "values" =>json_decode($object_data));
            }

        }
	$dilemma['subject']= "YOKO";
        $dilemma['columns']=$objective_items;
        $dilemma['options'] = $items;

       /*================================================= */
        $ch = curl_init($endpoint_url);
        curl_setopt($ch, CURLOPT_USERPWD, $credentials_text);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dilemma));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($ch);
        $err = curl_errno($ch);
        $err_or = curl_error($ch);

        curl_close($ch);

        $ResultArray = json_decode($result);
        $solution_Space = $ResultArray->resolution;
        $solutions = $solution_Space->solutions;
        foreach ($solutions as $key => $val){
            $bestSolution[$key]["planId"] = $val->solution_ref;
            $bestSolution[$key]["status"] = $val->status;
        }

        $PreferableSolution = $solution_Space->preferable_solutions;
        $preferredList['list'] = $PreferableSolution->solution_refs;
        $preferredList['score'] = $PreferableSolution->score;
        $param =array();
        $param['Preferable_List'] = $preferredList['list'];
        $param['Confidence'] = $preferredList['score'];
        $param['BestSolutionList'] = $bestSolution[$key]["planId"];
        $param['BestSolutionStatus'] = $bestSolution[$key]["status"];
        $timeElement = new Time_function();
        $param['Time_Value'] = $timeElement->getTimeValue(7);

        return $param;
    }

}
