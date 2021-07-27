<?php
/*
$date1 = "2014-05-26";
$date2 = "2014-05-17";
$datetimeObj1 = new DateTime($date1);
$datetimeObj2 = new DateTime($date2);
$interval = $datetimeObj1->diff($datetimeObj2);
$dateDiff = $interval->format('%R%a');
 
if($dateDiff == 0){
echo $date1."is equal to the".$date2;
}elseif($dateDiff < 0){
echo $date1."is greater than the".$date2;
}else{
echo $date2."is greater than the".$date1;
}
*/
$date1 = date("Y/m/d h:i:sa");
$date2 = date("2014/05/26 h:i:sa");
$datetimeObj1 = new DateTime($date1);
$datetimeObj2 = new DateTime($date2);
$interval = $datetimeObj1->diff($datetimeObj2);
$dateDiff = $interval->format('%R%a');
 
if($dateDiff == 0){
echo $date1."is equal to the".$date2;
}elseif($dateDiff < 0){
echo $date1." is greater than the ".$date2;
}else{
echo $date2." is greater than the ".$date1;
}
?>
