<?php

class MainController
{
    private $request;
    private $model;
    private $view;
    private $url;

    public function __construct($url)
    {
        $this->model = new MainModel();
        $this->view = new Template();
        $this->url = $url;
    }

    public function indexAction()
    {
        $customer = new Customer();
        $all_customer = $customer->selectAll();
        $this->view->customer = $all_customer;

        $yoko = new Yoko();
        foreach ($all_customer as $id => $info) {
            $yoko_user[$id] = $yoko->getYoko($info['play_count']);
        }

        $tts = new TextToSpeech();
        $this->view->result_text = $tts->getAudio("いつ、どこでゴルフをしますか？");
        $this->view->yoko_user = $yoko_user;
        $this->view->display("Main/index.tpl");
    }
}
