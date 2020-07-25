<?php
  include "../server/CRON.php";
  
  $url = $argv[1];
  $namePath = $argv[2];
  $scorePath = $argv[3];
  $rankPath = $argv[4];
  $name = $argv[5];
  $duration = $argv[6];
  $interval = $argv[7];
  
  $ticks = $duration*60 / $interval;
  while($ticks > 0){
    cron($url, $namePath, $scorePath, $rankPath, $name);
    sleep($interval);
    $ticks--;
  }
?>
