<?php

class Tosser {

    public $code;
    public $script;

    public function __construct() {
        
    }

    public function getRandomOrg() {
        $throw = array(null, null, null, null, null, null);
        for ($i = 0; $i < 6; $i++) {
            $id = uniqid();
            $f = "./throw.sh ${id} ${i}";
            $run = trim(system($f));
            $flip = file_get_contents("id/${id}");

            switch ($flip) {
                case 0:
                    $throw[$i] = 6;
                    break;
                case 1:
                    $throw[$i] = 7;
                    break;
                case 2:
                    $throw[$i] = 8;
                    break;
                case 3:
                    $throw[$i] = 9;
                    break;
            }
        }
        return($throw);
    }

    public function getHotBits() {
        $lines = array();
        $id= uniqid("hb_"); /* used to save and inspect values */
        for ($i = 0; $i < 6; $i++) {
            $hotbits = $this->getCleanHotBits($id);
            $line = null;
            foreach ($hotbits as $tb) {
                $c = ($tb % 2) + 2;
                $line += ($tb % 2) + 2;
            }
            array_push($lines, $line);
        }
        return($lines);
    }

    private function getCleanHotBits($id) {
        $intAry = array();
        $hotbitsURL = "http://www.fourmilab.ch/cgi-bin/uncgi/Hotbits?nbytes=3&fmt=c&apikey=HB1P93mBRUA23F7HUF5MCpyZ2PS";
        $start = microtime();
        $str = file_get_contents($hotbitsURL);
        /* $str = "/* Random data from the HotBits radioactive random number generator * /\nunsigned char hotBits[3] = {\n    10, 240, 151\n};"; */

        preg_match('/[\d].*[\d]/', $str, $matches, PREG_OFFSET_CAPTURE);
        $str = ($matches[0][0]);
        $hotbits = explode(",", $str);
        $end = microtime();
        $tdelta = $end - $start;
        $f = fopen("id/${id}","w");
        $fb = var_export($f, TRUE);
        fwrite($f, $fb);
        fwrite($f, $$tdelta."\n");
        fclose($f);

        foreach ($hotbits as $h) {
            array_push($intAry, intval(trim($h)));
        }
        //var_dump($intAry);
        return($intAry);
    }

    public function getPlum() {


        $hex = array();
        $m = 0;
        for ($k = 0; $k < 6; $k++) {
            $now = microtime_float() * 10000;
            $nowAry = str_split("" . $now);

            $combo = array();

            $ci1 = $this->rand_seq(0, 5, 5);
            $ci2 = $this->rand_seq(6, 11, 5);

            array_push($combo, ($nowAry[$ci1[0]] + $nowAry[$ci2[5]]));
            array_push($combo, ($nowAry[$ci1[1]] + $nowAry[$ci2[4]]));
            array_push($combo, ($nowAry[$ci1[2]] + $nowAry[$ci2[3]]));
            array_push($combo, ($nowAry[$ci1[3]] + $nowAry[$ci2[2]]));
            array_push($combo, ($nowAry[$ci1[4]] + $nowAry[$ci2[1]]));
            array_push($combo, ($nowAry[$ci1[5]] + $nowAry[$ci2[0]]));

            $recombo = array();

            $rci1 = $this->rand_seq(0, 2, 2);
            $rci2 = $this->rand_seq(3, 5, 2);

            array_push($recombo, ($combo[$rci1[0]] + $combo[$rci2[2]]) % 4);
            array_push($recombo, ($combo[$rci1[1]] + $combo[$rci2[1]]) % 4);
            array_push($recombo, ($combo[$rci1[2]] + $combo[$rci2[0]]) % 4);

            for ($l = 0; $l < 3; $l++) {
                //if ($recombo[$l] == 0) {
                $recombo[$l] = ($recombo[$l] % 2) + 2;
                //}
            }
            $ts = $recombo[0] . "," . $recombo[1] . "," . $recombo[2];
            $t = $recombo[0] + $recombo[1] + $recombo[2];
//        print "[$t]  ";


            usleep(rand(rand(1000, 10000), rand(10000, 100000)));
            array_push($hex, $t);
            $m++;
        }
        //var_dump($hex);
        return($hex);
    }

    private function rand_seq($fromto, $to = null, $limit = null) {

        if (is_null($to)) {
            $to = $fromto;
            $fromto = 0;
        }

        if (is_null($limit)) {
            $limit = $to - $fromto + 1;
        }
        $randArr = array();

        for ($i = $fromto; $i <= $to; $i++) {
            $randArr[] = $i;
        }
        $result = array();

        for ($i = 0; $i < $limit || sizeof($randArr) > 0; $i++) {
            $index = mt_rand(0, sizeof($randArr) - 1); // select rand index / выбираем случайный индекс массива 
            $result[] = $randArr[$index]; // add random element / добавляем случайный элемент массива 
            array_splice($randArr, $index, 1); // remove it=) / удаляем его =)
        }

        return $result;
    }

}

/*
  //   Find a quiet place, and take a few moments to relax and meditate on your query. Concentrate on your question or the situation for which you seek guidance.
  //Taking the 50 sticks in your hand, remove one stick and set it aside.

  $sticks = 50 -1;
  //With the 49 sticks remaining, divide them into two (right side and left side) and place them down side by side.
  $left_floor = rand (1,48);
  $right_floor = $sticks - $left;

  // 4 Take the bunch on the right side (with your right hand), and remove one stick, placing it on your left hand,
  //between your ring (fourth) and little finger (pinkie).
  $right_hand - $right_floor -1;
  // 5 From the left-side bunch, remove groups of four sticks at a time, until four or less sticks are left. Set this aside.
  $left_floor_remaining = ($left_floor % 4);
  $left_floor_remaining = ($left_floor_remaining == 0 ? 4 : $left_floor_remaining);
  // 6 Taking back the right-side bunch, remove four sticks at a time again, until four of less remain. Set this aside.
  $right_floor_remaining = ($rightfloor_ % 4);
  $right_floor_remaining = ($right_floor_remaining == 0 ? 4 : $right_floor_remaining);
  // 7 Place the remainder from the left-hand bunch between the ring finger and the middle finger and the remainder from the
  $left_hand = $left_floor_remaining;

  //right-hand bunch between the middle finger and index finger of the left hand.
  $left_hand += $right_floor_remaining;
  //Take all the sticks from your left hand and set them aside. Gather the remaining sticks and divide them into two bunches.
  $remaining = $sticks - $left_hand;
 */