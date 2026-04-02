<?php
include 'db.php';
include 'schedule_engine.php';

$s = getSchedule();
$now = new DateTime();

// tentukan sesi aktif
$current = (date('N') <= 2) ? 'selasa' : 'jumat';

$cfg = $s[$current];

// ==========================
// STATUS
// ==========================
if($now < $cfg['lock']){
    $status = 'OPEN';
}
elseif($now >= $cfg['lock'] && $now < $cfg['result']){
    $status = 'LOCK';
}
elseif($now >= $cfg['result']){
    $status = 'RESULT';
}

// update DB
$conn->query("UPDATE session_config 
SET status='$status',
    lock_time='".$cfg['lock']->format('Y-m-d H:i:s')."',
    result_time='".$cfg['result']->format('Y-m-d H:i:s')."' 
WHERE id=1");
