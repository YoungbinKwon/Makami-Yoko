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
        $this->view->customer = $customer->selectAll();
        $tts = new TextToSpeech();
        $this->view->result_text = $tts->getAudio("予約したいゴルフ場を教えてね");
        $this->view->display("Main/index.tpl");
    }
}
