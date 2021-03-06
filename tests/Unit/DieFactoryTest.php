<?php

namespace Tests\Unit;

use Tests\TestCase;

use InvalidArgumentException;
use DeliveryDotCom\Models\DieFactory;
use DeliveryDotCom\Models\StandardDie;
use DeliveryDotCom\Models\AnyDie;

class DieFactoryTest extends TestCase
{
    /**
      * Test DieFactory returning a StandardDie instance
      *
      * @return void
      */
    public function testCreateStandardDie()
    {
      $die = DieFactory::create(10);
      $this->assertInstanceOf(StandardDie::class, $die, "DieFactory returns the wrong instance");
    }

    public function testStandardDieRollsANumber()
    {
      $die = DieFactory::create(10);
      $num = $die->roll();
      $this->assertInternalType("int", $num);
    }

    public function testStandardDieNonNumeric()
    {
      $this->expectException(InvalidArgumentException::class);
      $die = DieFactory::create('A');
    }

    public function testStandardDieNonPositive()
    {
      $this->expectException(InvalidArgumentException::class);
      $die = DieFactory::create(-1);
    }

    /**
      * Test DieFactory returning an AnyDie instance
      *
      * @return void
      */
    public function testCreateAnyDie()
    {
      $die = DieFactory::create([0, 0, 1, 2, 9]);
      $this->assertInstanceOf(AnyDie::class, $die, "DieFactory returns the wrong instance");
    }

    public function testAnyDieRollsANumber()
    {
      $die = DieFactory::create([9]);
      $num = $die->roll();
      $this->assertInternalType("int", $num);
    }

    public function testAnyDieNonNumeric()
    {
      $this->expectException(InvalidArgumentException::class);
      $die = DieFactory::create([0, 0, 'A', 1, 2, 9]);
    }

    public function testAnyDieNonPositive()
    {
      $this->expectException(InvalidArgumentException::class);
      $die = DieFactory::create([0, 0, -7, 1, 2, 9]);
    }
}
