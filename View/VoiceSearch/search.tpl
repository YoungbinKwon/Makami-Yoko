<!DOCTYPE html>
<html>
<head>
    <title>PHP Starter Application</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../../css/voicesearch.css" />

</head>
<body>
    <div class="wrapper">
        <div>
            <audio src="https://4b7626a3-2f57-4ba2-ab12-5b11653e76e8:nDBMluWI5guk@stream.watsonplatform.net/text-to-speech/api/v1/synthesize?voice=ja-JP_EmiVoice&text=がんばれモモちゃん" autoplay loop></audio>
        </div>
        <div>
            <button type="button" class="start">start</button>
            <button type="button" class="end">end</button>
        </div>
        <textarea class="result"></textarea>
    </div>
</body>
<script type="text/javascript" src="../../js/voicesearch.js"></script>
</html>
