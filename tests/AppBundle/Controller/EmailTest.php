<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use  AppBundle\Entity\Admin;
class EmailTest extends WebTestCase
{
    public function testCanBeUsedAsString(): void
    {
        $this->assertEquals(
            'user@example.com',
            'user@example.com'
        );
    }
    
     public function testCanBeUsedAsStrings(): void
    {
         $admin = new Admin();
         $admin->setUsername("adc");
         $admin->setPasscode("123");
         
         $this->assertEquals($admin->getPasscode(),"123","Password does not matched");
    }
    
    
        public function testEmpty()
    {
        $stack = [];
        $this->assertEmpty($stack);
        print "running testEmpty";
        return $stack;
    }

    /**
     * @depends testEmpty
     */
    public function testPush(array $stack)
    {
        array_push($stack, 'foo');
        $this->assertSame('foo', $stack[count($stack)-1]);
        $this->assertNotEmpty($stack);
        print "Running Test Push  " . $stack[count($stack)-1];
        return $stack;
    }

    /**
     * @depends testPush
     */
    public function testPop(array $stack)
    {
        $this->assertSame('foo', array_pop($stack));
        $this->assertEmpty($stack);
        print "Running Test POP";
    }
}
