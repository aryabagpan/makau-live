<?php
function hitungBeban($conn,$angka,$tipe){
    $q=$conn->prepare("SELECT SUM(nilai) t FROM entries WHERE angka=? AND tipe=?");
    $q->bind_param("ss",$angka,$tipe);
    $q->execute();
    return $q->get_result()->fetch_assoc()['t'] ?? 0;
}
?>
