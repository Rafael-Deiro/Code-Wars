<?php
/**
 * @author Rafael Deiro Lopes <rafaeldeirolopes@gmail.com>
*/

/*
Kata URI: https://www.codewars.com/kata/546f922b54af40e1e90001da
Kata Author: MysteriousMagenta

Description:
  Given a string, replace each letter for it`s alphabet index.
  If a character isn`t a letter, it should be ignored and not returned.

Example:
  "a" = 1, "b" = 2, ...

  $inputStr = "abc something else";
  alphabetPosition($inputStr): "1 2 3 21 15 13 5 20 8 9 14 7 5 12 21 5"

Tags:
  Fundamentals, Strings
*/

/* ---------------------------- My Solution ---------------------------- */

/**
 * Alphabet functions class
*/
class alphabet{

  /**
   * Receives a string $str and returns another string made of each $s char index in the alphabet.
   * 
   * @param string $str String with any value
   * @return string String made of $str chars alphabet indexes
  */
  public function alphabetPosition(string $str){
    $alphabet = [array()];
    $outputStr = '';
    $str = strtoupper($str);

    foreach (range('A', 'Z') as $letter){
      $alphabet[] = $letter;
    }

    for ($i = 0; $i < strlen($str); $i++){
      if (in_array($str[$i], $alphabet)){
        $outputStr .=  array_search($str[$i], $alphabet) . ' ';
      }
    }

    return trim($outputStr);
  }
}

/**
 * Tests alphabet class
*/
class testAlphabet extends alphabet{

  /**
   * Tests alphabet->alphabetPosition() and writes the logs in a file
  */
  public function testAlphabetShouldOutputIndexString(){
    $test_1 = "ABC, Something Else";
    $test_2 = "The sunset sets at twelve o\' clock.";
    $test_3 = "123, 974@ab31.ac";

    $this->checkValidity($this->alphabetPosition($test_1), "1 2 3 19 15 13 5 20 8 9 14 7 5 12 19 5", true);
    $this->checkValidity($this->alphabetPosition($test_2), "20 8 5 19 21 14 19 5 20 19 5 20 19 1 20 20 23 5 12 22 5 15 3 12 15 3 11", true);
    $this->checkValidity($this->alphabetPosition($test_3), "1 2 1 3", true);

    echo "The assertion logs can be found at /PHP/6kyu/logs/alphabet_indexer.log.txt\n";
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
    $logFile = fopen('logs/alphabet_indexer.log.txt', 'a+');

    $logString = date('Y/m/d @ H:i:s') . " | $log \nExpected: {$values[1]} | Result: {$values[0]}\n\n";

    fwrite($logFile, $logString);
    fclose($logFile);
  }
}

$testAlphabet = new testAlphabet();
$testAlphabet->testAlphabetShouldOutputIndexString();
