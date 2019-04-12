<?php
/**
 * @author Rafael Deiro Lopes <rafaeldeirolopes@gmail.com>
*/

/*
Kata URI: URI
Kata Author: AUTHOR_NAME

Description:
  Kata task description

Example:
  Kata task example

Tags:
  Kata tags
*/

/* ---------------------------- My Solution ---------------------------- */

/**
 * Kata functions class
*/
class kataClass{

  /**
   * Main kata function
  */
  public function kataFunction(){

  }
}

/**
 * Tests kata class
*/
class testKataClass extends kataClass{

  /**
   * Main test function
  */
  public function testFunction(){
    $this->checkValidity($this->kataFunction, 'EXPECTED', true);

    echo "The assertion logs can be found at /PHP/7kyu/logs/" . "LOG_FILE_NAME" . "\n";
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

    if ($sameType === true){
      if ($actual === $expected){
        $log = [[$actualStr, $expectedStr], "PASS: The actual match with the expected in value and type"];
        $this->logTest($log[0], $log[1]);
        return true;
      }
    }
    else {
      if ($actual == $expected){
        $log = [[$actualStr, $expectedStr], "PASS: The actual match with the expected in value"];
        $this->logTest($log[0], $log[1]);
        return true;
      }
    }

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
    $logFile = fopen('logs/' . 'LOG_FILE_NAME', 'a+');

    $logString = date('Y/m/d @ H:i:s') . " | $log \nExpected: {$values[1]} | Result: {$values[0]}\n\n";

    fwrite($logFile, $logString);
    fclose($logFile);
  }
}

// Test function call
