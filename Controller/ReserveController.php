<?php

class ReserveController
{
    private $request;
    private $model;
    private $view;
    private $url;

    public function __construct($url)
    {
        $this->model = new ReserveModel();
        $this->view = new Template();
        $this->url = $url;
    }

    public function confirmAction()
    {
        $this->view->display("Reserve/confirm.tpl");
    }

    public function completeAction(){
        if (isset($_POST['userid'])) {
            $user_id = $_POST['userid'];
            $customer  = new Customer();
            $user_info = $customer->selectById($user_id);
            $customer->updatePlayCount($user_id);
            $yoko = new Yoko();
            $yoko_user = $yoko->getYoko($user_info[$user_id]['play_count']);
            $this->view->yoko_user = $yoko_user;

            $tts = new TextToSpeech();
            $this->view->result_text = $tts->getAudio("予約を完了したよ　トップページに戻るよ");
        }
        $this->view->display("Reserve/complete.tpl");
    }
}

?>

