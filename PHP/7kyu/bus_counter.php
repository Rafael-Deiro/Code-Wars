<?php
/**
 * @author Rafael Deiro Lopes <rafaeldeirolopes@gmail.com>
*/

/*
Kata URI: https://www.codewars.com/kata/5648b12ce68d9daa6b000099
Kata Author: aryan-firouzian

Description:
  You receive an array of int arrays $bus_stops[[n1, n2], ...] where each int array represents a bus stop, [n][0] is the number of people that got in the bus, and [n][1] is the number of people that got off the bus.
  Your task is to return the number of people left in the bus after the last stop.
  The count returned always has to be an integer equal or greater than 0. Otherwise, the function may return false.
  [0][1] is allways 0, since the bus is empty in the first stop.

Example:
  $bus_stops = [[5, 0], [7, 3], [2, 5], [0, 5]];
  number($bus_stops): (int) 1

  $bus_stops_2 = [[5, 0], [7, 3], [2, 5], [0, 10]];
  number($bus_stops_2): (bool) false

Tags:
  Fundamentals
*/

/* ---------------------------- My Solution ---------------------------- */

/**
 * Counts the people in a bus for each stop
*/
class busCounter{

  /**
   * Counts the people remaining on the bus after the last stop
   * 
   * @param array $bus_stops Array made of int arrays containing the number of people that entered the bus [0] and the number of people that exited the bus [1].
   * @return mixed If the number of people remaining is equal or greater than 0, this int is returned. In case the number is lower than 0, false is returned. If the numbers provided are not int, false is returned.
  */
  public function number(array $bus_stops){
    $current = 0;

    foreach ($bus_stops as $stop){
      if (!is_int($stop[0]) || !is_int($stop[1])){
        return false;
      }
    
      $current += $stop[0];
      $current -= $stop[1];
    }

    if ($current < 0){
      return false;
    }

    return $current;
  }
}

/**
 * Tests busCounter class
*/
class testBusCounter extends busCounter{

  /**
   * Tests busCounter->number() and writes the results to a log file
  */
  public function testNumberShouldReturnIntGTMinusOne(){
    $travel_1 = [
      [7, 0],
      [12, 3],
      [5, 10],
      [2, 11],
      [7, 0],
      [0, 9],
    ];

    $travel_2 = [
      [8, 0],
      [9, 3],
      [0, 7],
      [4, 1],
      [0, 7],
    ];

    $travel_3 = [
      [10, 0],
      [20, 15],
      [3, 0],
      [0, 20],
    ];

    $this->checkValidity($this->number($travel_1), 0, true);
    $this->checkValidity($this->number($travel_2), 3, true);
    $this->checkValidity($this->number($travel_3), false, true);

    echo "The assertion logs can be found at /PHP/7kyu/logs/bus_counter.log.txt\n";
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
    $logFile = fopen('logs/bus_counter.log.txt', 'a+');

    $logString = date('Y/m/d @ H:i:s') . " | $log \nExpected: {$values[1]} | Result: {$values[0]}\n\n";

    fwrite($logFile, $logString);
    fclose($logFile);
  }
}

$testBusCounter = new testBusCounter();
$testBusCounter->testNumberShouldReturnIntGTMinusOne();
