<?php
class Yoko {

    public function getYoko($play_count)
    {
        $yoko['level'] = ceil($play_count/3) + 1;
        $level = ceil($play_count/3) + 1;

        if ($level == 1) {
            $yoko['img'] = "/img/baby_3.png";
            $yoko['thinking'] = "かんがえちゅうzzz";
        } elseif ($level >= 2 && $level < 3) {
            $yoko['img'] = "/img/baby_4.png";
            $yoko['thinking'] = "考え中でちゅ";
        } elseif ($level >= 3 && $level < 5) {
            $yoko['img'] = "/img/baby_1.png";
            $yoko['thinking'] = "考え中です";
        } elseif ($level >= 5 && $level < 8) {
            $yoko['img'] = "/img/baby_2.png";
            $yoko['thinking'] = "考え中だよ〜";
        } else {
            $yoko['img'] = "/img/baby_8.png";
            $yoko['thinking'] = "考え中だよ";
        }

        return $yoko;
    }

}
