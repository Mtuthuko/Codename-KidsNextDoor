<?php
use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;
#require_once('locallib.php');
class UCTAPSTest extends TestCase{
  
 public function test_testing(){
   require_once('/home/travis/build/noreplysims/VarsityOnline/phpmailer/UCTAPS.php');
   $tests=UCT_APS(79);
 $this->assertEquals(6,$tests, "correct!"); 
   $tests2=UCT_APS(47);
 $this->assertEquals(3,$tests2, "correct!"); 
 }
 
}
?>
