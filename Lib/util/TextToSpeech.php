<?php

class TextToSpeech {
    public function __construct()
    {
        $this->url_base = 'https://stream.watsonplatform.net/text-to-speech/api/v1/synthesize?voice=ja-JP_EmiVoice';
        $this->username = TTSUSERNAME;
        $this->password = TTSPASSWORD;
    }

    public function getAudio($text)
    {
        try {
        $url = "https://".
            $this->username . ":".
            $this->password . "@stream.watsonplatform.net/text-to-speech/api/v1/synthesize?voice=ja-JP_EmiVoice&text=".
            $text;

        } catch(Exception $e) {
            return false;
        }
    }
}