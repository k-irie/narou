<?php

function logWrite($tag,$process,$message){
    $now = new DateTime();

    $filename = "./logs/" . $now->format('Ymd') . ".log";
    $fp = fopen($filename,"a");
    $data = array($now->format('Y/m/d H:i:s.u'),$tag,$process,$message);
    fprintf($fp,"%s\n",implode("\t",$data));
    fclose($fp);
}