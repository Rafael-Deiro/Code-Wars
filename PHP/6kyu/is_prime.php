<?php
/**
 * @author Rafael Deiro Lopes <rafaeldeirolopes@gmail.com>
*/

/*
Kata URI: https://www.codewars.com/kata/5262119038c0985a5b00029f
Kata Author: arithmetric

Description:
  Define a function isPrime()/is_prime() that receives an integer and returns true if it`s a prime number or false if it isn`t prime.
  A prime number is a natural number greater than 1 that has no divisors other than 1 and itself.
  You may receive integers lower than 0.

Example:
  isPrime(5): true

  is_prime(10002): false

Tags:
  Algorithms, Mathematics, Numbers
*/

/* ---------------------------- My Solution ---------------------------- */

/**
 * Arithmetic functions class
*/
class arithmetic{

  /**
   * Evaluates if $n integer is either a prime number or not
   * 
   * @param int $n Integer value to be evaluated
   * @return bool True if $n is prime. Otherwise, false is returned
  */
  public function is_prime($n){
    if ($n < 2){
      return false;
    }
    
    for ($i = 2; $i <= $n; $i++){
      if ($n/$i < $i){
        return true;
      }
      elseif ($n % $i == 0){
        return false;
      }
      elseif ($n == $i){
        return true;
      }
    }
  }

  public function isPrime($n){
    return $this->is_prime($n);
  }
}

/**
 * Tests arithmetic class
*/
class testArithmetic extends arithmetic{

  /**
   * is_prime()/isPrime() test function
  */
  public function testIsPrimeShouldReturnBool(){
    $this->checkValidity($this->isPrime(5), true);
    $this->checkValidity($this->is_prime(-7), false);
    $this->checkValidity($this->isPrime(rand(-100000, 1)), false);

    echo "The assertion logs can be found at /PHP/6kyu/logs/is_prime.log.txt\n";
  }

  /**
   * Checks the validity of the assertion given by val1 == val2, or val1 === val2, logs the results to a file, and returns true or false based on the assertion validity.
   * 
   * @param mixed $actual Actual value given to the assertion/ Usually the output of a function
   * @param mixed $expected Expected value given to the assertion. Has to be known prior to the test, otherwise, the assertion may be invalid even though the function works correctly.
   * @param bool $sameType Tells the function to either check the assertion values types or not (=== operator on/of). True checks, false doesn`t.
   * @param bool $log Tells the function to either log the results to a file or not. True logs, false doesn`t.
   * @return bool True if the assertion is valid. False if the assertion is invalid.
  */
  public function checkValidity($actual, $expected = null, $sameType = true){
    $actualStr = "";
    $expectedStr = "";

    if ($actual === true){
      $actualStr = "true";
    }
    elseif ($actual === false){
      $actualStr = "false";
    }
    elseif ($actual === null){
      $actualStr = "nothing";
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
    elseif ($expected === null){
      $expectedStr = "nothing";
    }
    else {
      $expectedStr = strval($expected);
    }

    if ($sameType === true && $expected !== null){
      if ($actual === $expected){
        $log = [[$actualStr, $expectedStr], "PASS: The actual match with the expected in value and type"];
        $this->logTest($log[0], $log[1]);
        return true;
      }
    }
    elseif ($expected !== null){
      if ($actual == $expected){
        $log = [[$actualStr, $expectedStr], "PASS: The actual match with the expected in value"];
        $this->logTest($log[0], $log[1]);
        return true;
      }
    }

    if ($expected === null){
      $log = [[$actualStr, $expectedStr], "UNKNOWN: No expected value"];
      $this->logTest($log[0], $log[1]);
      return true;
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
    $logFile = fopen('logs/is_prime.log.txt', 'a+');

    $logString = date('Y/m/d @ H:i:s') . " | $log \nExpected: {$values[1]} | Result: {$values[0]}\n\n";

    fwrite($logFile, $logString);
    fclose($logFile);
  }
}

$testArithmetic = new testArithmetic();
$testArithmetic->testIsPrimeShouldReturnBool();

