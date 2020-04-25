<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $this->assertEquals(
            'user@example.com',
            'user@example.com'
        );
    }
    
    public function testIndexes()
    {
        $this->assertEquals(
            'user@example.com',
            'user@example.com'
        );
    }
  
    
    /**
     * @dataProvider additionProvider
     */
    public function testAdd($a, $b, $expected)
    {
        $this->assertSame($expected, $a + $b);
    }

    public function additionProvider()
    {
        return [
            [0, 0, 0],
            [0, 1, 1],
            [1, 0, 1],
            [1, 1, 2]
        ];
    }
    
    
    
    
    
    public function testProducerFirst()
    {
        $this->assertTrue(true);
        return 'first';
    }

    public function testProducerSecond()
    {
        $this->assertTrue(true);
        return 'second';
    }

    /**
     * @depends testProducerFirst
     * @depends testProducerSecond
     */
    public function testConsumer($a, $b)
    {
        $this->assertSame('first', $a);
        $this->assertSame('second', $b);
    }
    
    
        
    public function testStringMathcer1(){
                $this->assertTrue(true);
        return 'match';
    }
    
    public function testStringMatcher2(){
                $this->assertTrue(true);
        return 'match2';
    }
    
      /**
     * @depends testStringMathcer1
     * @depends testStringMatcher2
     */
    public function testStringMatcher($a,$b){

         $this->assertSame('match', $a);
        $this->assertSame('match2', $b);
    }
    
    //Throwing exceptions
    public function testException()
    {
//        $this->expectException(InvalidArgumentException::class);
    }
      
}
