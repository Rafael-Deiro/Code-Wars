<?php
class APSummation{
public function summation($n){
if (!is_numeric($n)) return false;
$els = [0 => 0];
for ($i = 1; $i <= $n; $i++) $els[] = $i;
$sum = round(($n * ($els[1] + $els[$n]))/2);
return (int) $sum;}}
class testSummation extends APSummation{
public function testSummationShouldResultIntAPSum(){
$this->checkValidity($this->summation(7), 28, true);
$this->checkValidity($this->summation(1.49), 1, true);
$this->checkValidity($this->summation(3.773e5), 71177833650, true);
$this->checkValidity($this->summation('abq'), false, true);
echo 'The assertion logs can be found at /PHP/8kyu/logs/summation.log.txt';}
public function checkValidity($act, $exp, $sType = false){
$actStr = ""; $expStr = "";
if ($act === true) $actStr = "true";
elseif ($act === false) $actStr = "false";
else $actStr = strval($act);
if ($exp === true) $expStr = "true";
elseif ($exp === false) $expStr = "false";
else $expStr = strval($exp);
if ($sType === true && $act === $exp){
$log = [[$actStr, $expStr], "PASS: The actual match with the expected in value and type"];
$this->logTest($log[0], $log[1]);
return true;
} elseif ($sType === false && $act == $exp){
$log = [[$actStr, $expStr], "PASS: The actual match with the expected in value"];
$this->logTest($log[0], $log[1]);
return true;}
$log = [[$actStr, $expStr], "FAIL: The actual doesn`t match with the expected either in value or type."];
$this->logTest($log[0], $log[1]);
return false;}
public function logTest(array $vals, string $log){
$lFile = fopen('logs/summation.log.txt', 'a+');
$lString = date('Y/m/d @ H:i:s') . " | $log \nExpected: {$vals[1]} | Result: {$vals[0]}\n\n";
fwrite($lFile, $lString);
fclose($lFile);}}
$tSum = new testSummation();
$tSum->testSummationShouldResultIntAPSum();