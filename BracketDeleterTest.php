<?php

use PHPUnit\Framework\TestCase;
require_once 'BracketDeleterClass.php';

class BracketDeleterTest extends TestCase {
    public function testProcessEmptyString() {
        $bracketDeleter_1 = new BracketDeleter("");
        $bracketDeleter_1->process();
        $result = $bracketDeleter_1->getResult();
        $this->assertEquals("", $result);
    }

    public function testProcessStringWithoutBrackets() {
        $bracketDeleter_2 = new BracketDeleter("Строка без скобок");
        $bracketDeleter_2->process();
        $result = $bracketDeleter_2->getResult();
        $this->assertEquals("Строка без скобок", $result);
    }

    public function testProcessStringInBrackets() {
        $bracketDeleter_3 = new BracketDeleter("(Вся строка в скобках)");
        $bracketDeleter_3->process();
        $result = $bracketDeleter_3->getResult();
        $this->assertEquals("", $result);
    }

    public function testProcessStringWithMultipleBrackets() {
        $bracketDeleter_4 = new BracketDeleter("Строка (с) {несколькими }скобками");
        $bracketDeleter_4->process();
        $result = $bracketDeleter_4->getResult();
        $this->assertEquals("Строка  скобками", $result);
    }

    public function testProcessStringWithNestedBrackets() {
        $bracketDeleter_5 = new BracketDeleter("Строка (с ) {несколькими <влож>енными скоб}ками");
        $bracketDeleter_5->process();
        $result = $bracketDeleter_5->getResult();
        $this->assertEquals("Строка  ками", $result);
    }

    public function testProcessStringWithOneOpeningBracket() {
        $bracketDeleter_6 = new BracketDeleter("Строка с <одной открывающей скобкой");
        $bracketDeleter_6->process();
        $result = $bracketDeleter_6->getResult();
        $this->assertEquals("Строка с <одной открывающей скобкой", $result);
    }

    public function testProcessStringWithOneClosingBracket() {
        $bracketDeleter_7 = new BracketDeleter("Строка с одной закрыв}ающей скобкой");
        $bracketDeleter_7->process();
        $result = $bracketDeleter_7->getResult();
        $this->assertEquals("Строка с одной закрыв}ающей скобкой", $result);
    }

    public function testProcessStringWithDifferentOpeningAndClosingBracketsFirstOption () {
        $bracketDeleter_8 = new BracketDeleter("Строка {с разными открывающей и] закрывающей скобками");
        $bracketDeleter_8->process();
        $result = $bracketDeleter_8->getResult();
        $this->assertEquals("Строка {с разными открывающей и] закрывающей скобками", $result);
    }

    public function testProcessStringWithDifferentOpeningAndClosingBracketsSecondOption() {
        $bracketDeleter_9 = new BracketDeleter("Строка }с разными открывающей и[ закрывающей скобками");
        $bracketDeleter_9->process();
        $result = $bracketDeleter_9->getResult();
        $this->assertEquals("Строка }с разными открывающей и[ закрывающей скобками", $result);
    }

    public function testProcessStringConsistingOfBrackets() {
        $bracketDeleter_10 = new BracketDeleter("<>(){}[]");
        $bracketDeleter_10->process();
        $result = $bracketDeleter_10->getResult();
        $this->assertEquals("", $result);
    }

    public function testProcessStringWithMixedUpBrackets () {
        $bracketDeleter_11 = new BracketDeleter("Строка ]с перепутанными[ скобками");
        $bracketDeleter_11->process();
        $result = $bracketDeleter_11->getResult();
        $this->assertEquals("Строка ]с перепутанными[ скобками", $result);
    }
}
?>

       

