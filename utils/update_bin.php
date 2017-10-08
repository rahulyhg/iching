<?php

$bin = array(
 '111111'=>1,
 '000000'=>2,
 '010001'=>3,
 '100010'=>4,
 '010111'=>5,
 '111010'=>6,
 '000010'=>7,
 '000010'=>8,
 '111011'=>9,
 '110111'=>10,
 '000111'=>11,
 '111000'=>12,
 '111101'=>13,
 '101111'=>14,
 '000100'=>15,
 '001000'=>16,
 '011001'=>17,
 '100110'=>18,
 '000011'=>19,
 '110000'=>20,
 '101001'=>21,
 '100101'=>22,
 '100000'=>23,
 '000001'=>24,
 '111001'=>25,
 '100111'=>26,
 '100001'=>27,
 '011110'=>28,
 '010010'=>29,
 '101101'=>30,
 '011100'=>31,
 '001110'=>32,
 '111100'=>33,
 '001111'=>34,
 '101000'=>35,
 '000101'=>36,
 '110101'=>37,
 '101011'=>38,
 '010100'=>39,
 '001010'=>40,
 '100011'=>41,
 '110001'=>42,
 '011111'=>43,
 '111110'=>44,
 '011000'=>46,
 '011010'=>47,
 '010110'=>48,
 '011101'=>49,
 '101110'=>50,
 '001001'=>52,
 '110100'=>53,
 '001011'=>55,
 '101100'=>56,
 '110110'=>57,
 '011011'=>58,
 '110010'=>59,
 '010011'=>60,
 '110011'=>61,
 '001100'=>62,
 '010101'=>63,
 '101010'=>64
    );

foreach ($bin as $binary => $psec) {
    $bsec = bindec($binary);
    
    $sql = "update hexagrams set `binary` = '$binary',bseq = $bsec where pseq = $psec;\n";
    echo $sql;
//    echo "binary: $binary, bsec = $bsec, seq: $psec\n";
}