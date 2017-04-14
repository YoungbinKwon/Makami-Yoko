<?php
error_reporting(E_ALL);

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


        $string = file_get_contents("problem_w.json");
        $this->model = new TradeOffModel();
        $this->view = new Template();
        $this->url = "https://gateway.watsonplatform.net/tradeoff-analytics/api/v1/dilemmas/";
        $this->dilemmaFile = array('data' =>"@problem_w.json");
        $this->url_base = 'https://gateway.watsonplatform.net/tradeoff-analytics/api';
        $this->username = TRADEOFFUSERNAME;
        $this->password = TRADEOFFPASSWORD;
    }

    public function UserTradeoffAPI(){
        $endpoint_url = "https://gateway.watsonplatform.net/tradeoff-analytics/api/v1/dilemmas/?find_preferable_options=true";
        $credentials = [
            "username" => TRADEOFFUSERNAME,// コピペする
            "password" => TRADEOFFPASSWORD// コピペする
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
        /*================================================= */

        /* ============OBJECTIVE COLUMNS=================== */
        $count=1;
        foreach ($rows as $key => $value){
            $objective_items[] = array(
                "key" => "obj".$count++,
                "full_name" => $value['name'],
                "type" => $value['type'],
                "is_objective" => $value['is_objective'],
                "goal" => $value['goal']
            );

        }

        /*================================================= */




        $request = [
            "subject" => "holiday",
            "columns" => [
                array("key" => "price",
                    "full_name" => "Price",
                    "type" => "numeric",
                    "is_objective" => true,
                    "goal" => "min"),

                array("key" => "engineSize",
                    "full_name" => "Engine Volume",
                    "type" => "numeric",
                    "is_objective" => false,
                    "goal" => "min"),

                array("key" => "power",
                    "full_name" => "Power",
                    "type" => "numeric",
                    "is_objective" => true,
                    "goal" => "max")
            ],
            "options" => [
               array( "key" => 200727569,
                        "name" => "Acura ILX",
                        "description" =>"Technology Plus Package 4dr Sedan (2.4L 4cyl 8AM)",
                        "values"=> array(
                        "price" => 32900,
                        "engineSize" => 3.4,
                         "power" => 501)),

                array( "key" => 200726801,
                    "name" => "Acura MDX",
                    "description" =>"4dr SUV (3.5L 6cyl 9A)",
                    "values"=> array(
                        "price" => 33015,
                        "engineSize" => 3.5,
                        "power" => 290))
        ]
    ];

        $ch = curl_init($endpoint_url);
        curl_setopt($ch, CURLOPT_USERPWD, $credentials_text);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
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

        return $param;
    }


        public function indexAction(){
              $this->view->TradeOffResults = $this->UserTradeoffAPI();
              $this->view->display('Tradeoff/index.tpl');
        }

}