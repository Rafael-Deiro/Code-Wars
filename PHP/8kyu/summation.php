<?php
/**
 * @author Rafael Deiro Lopes <rafaeldeirolopes@gmail.com>
*/

/*
Kata URI: https://www.codewars.com/kata/55d24f55d7dd296eb9000030
Kata Author: danleavitt0

Description:
  Find a program that finds the summation of every number from 1 to num. The number will always be a positive integer greater than 0.

Example:
  summation(2): 3
  1 + 2

  summation(8): 36
  1 + 2 + 3 + 4 + 5 + 6 + 7 + 8

Tags:
  Fundamentals, Loops, Control Flow, Basic Language Features
*/

/* ---------------------------- My Solution ---------------------------- */

/* 
  summation($n) does an Arithmetic Progression where $n is the number of elements growing by 1.
  AP sum is given by: n*(A1+An)/2; where n is the number of elements, A1 is the first and An is the last.
*/

/**
 * Calculates Arithmetic Progression sum
*/
class APSummation{

  /**
   * Calculates the sum of an AP with the element count given by $n and growth equal to 1;
   * 
   * @param int $n The desired number of elements
   * @return int Returns the AP sum
  */
  public function summation($n){

    // Before processing we check if $n is numeric. If it isn`t, we return false
    if (!is_numeric($n)){
      return false;
    }

    // AP elements array, started with [0] = 0 so the AP elements begin at index 1
    $elements = [0 => 0];
  
    // First we create and push the elements to the array
    for ($i = 1; $i <= $n; $i++){
      $elements[] = $i;
    }
  
    // Then we obtain the AP sum and round it to the nearest integer
    $sum = round(($n * ($elements[1] + $elements[$n]))/2);
  
    // Now we return $sum explicitly as int (because round() outputs a float)
    return (int) $sum;
  }
}

/**
 * Tests APSummation class
*/
class testSummation extends APSummation{

  /**
   * Tests APSummation->summation(int) and logs the results to a file.
  */
  public function testSummationShouldResultIntAPSum(){
    $this->checkValidity($this->summation(7), 28, true);
    $this->checkValidity($this->summation(1.49), 1, true);
    $this->checkValidity($this->summation(3.773e5), 71177833650, true);
    $this->checkValidity($this->summation('abq'), false, true);

    echo 'The assertion logs can be found at /PHP/8kyu/logs/summation.log.txt';
  }

  /**
   * Checks the validity of the assertion given by val1 == val2, or val1 === val2, logs the results to a file, and returns true or false based on the assertion validity.
   * 
   * @param mixed $actual Actual value given to the assertion/ Usually the output of a function
   * @param mixed $expected Expected value given to the assertion. Has to be known prior to the test, otherwise, the assertion may be invalid even though the function works correctly.
   * @param bool $sameType Tells the function to either check the assertion values types or not (=== operator on/of). True checks, false doesn`t.
   * @return bool True if the assertion is valid. False if the assertion is invalid.
  */
  public function checkValidity($actual, $expected, $sameType = false){
    // Sets $actual and $expected strings for the log file writing
    $actualStr = "";
    $expectedStr = "";
    if ($actual === true){
      $actualStr = "true";
    }
    elseif ($actual === false){
      $actualStr = "false";
    }
    else {
      $actualStr = strval($actual);
    }

    if ($expected === true){
      $expectedStr = "true";
    }
    elseif ($expected === false){
      $expectedStr = "false";
    }
    else {
      $expectedStr = strval($expected);
    }

    // Validates the assertion by values and types
    if ($sameType === true){
      if ($actual === $expected){

        // Actions when the assertion is valid
        $log = [[$actualStr, $expectedStr], "PASS: The actual match with the expected in value and type"];
        $this->logTest($log[0], $log[1]);
        return true;
      }
    }

    // Validates the assertion only by values
    else {
      if ($actual == $expected){

        // Actions when the assertion is valid
        $log = [[$actualStr, $expectedStr], "PASS: The actual match with the expected in value"];
        $this->logTest($log[0], $log[1]);
        return true;
      }
    }

    // Actions when the assertion is invalid
    $log = [[$actualStr, $expectedStr], "FAIL: The actual doesn`t match with the expected either in value or type."];
    $this->logTest($log[0], $log[1]);
    return false;
  }

  /**
   * Logs the assertion test to a file
   * 
   * @param array $values Array containing the expected value as $arr[1] and the actual value as $arr[0].
   * @param string $log Log message to be recorded in the file.
  */
  public function logTest(array $values, string $log){

    // Opens the log file or creates if it doesn`t exists
    $logFile = fopen('logs/summation.log.txt', 'a+');

    // Creates the log string containing the date and time of the log, as well as the message, the expected and the actual values
    $logString = date('Y/m/d @ H:i:s') . " | $log \nExpected: {$values[1]} | Result: {$values[0]}\n\n";

    // Appends the log string and closes the file
    fwrite($logFile, $logString);
    fclose($logFile);
  }
}

// Now we run the test
$testSum = new testSummation();
$testSum->testSummationShouldResultIntAPSum();
