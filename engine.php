<?php
include 'helper.php';

function generateCandidates($conn){

    $candidates=[];

    for($i=0;$i<=99;$i++){
        $a2d=str_pad($i,2,"0",STR_PAD_LEFT);
        $b2d=hitungBeban($conn,$a2d,'2D');

        for($j=0;$j<=9;$j++){
            $a3d=$j.$a2d;
            $b3d=hitungBeban($conn,$a3d,'3D');

            for($k=0;$k<=9;$k++){
                $a4d=$k.$a3d;
                $b4d=hitungBeban($conn,$a4d,'4D');

                $score = ($b4d*1000000)+($b3d*1000)+$b2d;

                $candidates[]=[
                    '2d'=>$a2d,
                    '3d'=>$a3d,
                    '4d'=>$a4d,
                    'b2d'=>$b2d,
                    'b3d'=>$b3d,
                    'b4d'=>$b4d,
                    'score'=>$score
                ];
            }
        }
    }

    usort($candidates,function($a,$b){
        return $a['score'] <=> $b['score'];
    });

    return array_slice($candidates,0,5);
}
?>
