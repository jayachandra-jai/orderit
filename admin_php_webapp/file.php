<?php
$datetime1 = strtotime("2011-10-10 10:00:00");
$datetime2 = strtotime("2011-10-10 10:45:00");
$interval  = abs($datetime2 - $datetime1);
$minutes   = round($interval / 60);
echo 'Diff. in minutes is: '.$minutes; 
?>