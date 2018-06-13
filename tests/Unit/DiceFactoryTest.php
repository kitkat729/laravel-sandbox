<?php

namespace Tests\Unit;

use Tests\TestCase;

use InvalidArgumentException;
//use DeliveryDotCom\Dice\DiceManager;
use DeliveryDotCom\Models\StandardDie;
use DeliveryDotCom\Models\AnyDie;

class DiceFactoryTest extends TestCase
{
    protected function setUp()
    {

    }
    /**
      * Test DieFactory returning a StandardDie instance
      *
      * @return void
      */
    public function testCreateStandardDie()
    {
      $DiceManager = resolve('DeliveryDotCom\Dice\DiceManager');
      $die = $DiceManager::create(10);
      $this->assertInstanceOf(StandardDie::class, $die, "DieFactory returns the wrong instance");
    }

    public function testStandardDieRollsANumber()
    {
      $DiceManager = resolve('DeliveryDotCom\Dice\DiceManager');
      $die = $DiceManager::create(10);
      $num = $die->roll();
      $this->assertInternalType("int", $num);
    }

    public function testStandardDieNonNumeric()
    {
      $DiceManager = resolve('DeliveryDotCom\Dice\DiceManager');
      $this->expectException(InvalidArgumentException::class);
      $die = $DiceManager::create('A');
    }

    public function testStandardDieNonPositive()
    {
      $DiceManager = resolve('DeliveryDotCom\Dice\DiceManager');
      $this->expectException(InvalidArgumentException::class);
      $die = $DiceManager::create(-1);
    }

    /**
      * Test DieFactory returning an AnyDie instance
      *
      * @return void
      */
    public function testCreateAnyDie()
    {
      $DiceManager = resolve('DeliveryDotCom\Dice\DiceManager');
      $die = $DiceManager::create([0, 0, 1, 2, 9]);
      $this->assertInstanceOf(AnyDie::class, $die, "DieFactory returns the wrong instance");
    }

    public function testAnyDieRollsANumber()
    {
      $DiceManager = resolve('DeliveryDotCom\Dice\DiceManager');
      $die = $DiceManager::create([9]);
      $num = $die->roll();
      $this->assertInternalType("int", $num);
    }

    public function testAnyDieNonNumeric()
    {
      $DiceManager = resolve('DeliveryDotCom\Dice\DiceManager');
      $this->expectException(InvalidArgumentException::class);
      $die = $DiceManager::create([0, 0, 'A', 1, 2, 9]);
    }

    public function testAnyDieNonPositive()
    {
      $DiceManager = resolve('DeliveryDotCom\Dice\DiceManager');
      $this->expectException(InvalidArgumentException::class);
      $die = $DiceManager::create([0, 0, -7, 1, 2, 9]);
    }
}
