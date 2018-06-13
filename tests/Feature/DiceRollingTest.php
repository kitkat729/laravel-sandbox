<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use DeliveryDotCom\Services\MyDice;
//use DeliveryDotCom\Models\DieFactory;

class DiceRollingTest extends TestCase
{
  /**
   * Run once before the first test
   */
  //public static function setUpBeforeClass() {}

  /**
   * Run before every test
   */
  //protected function setUp() {}

  public function testCreateDice() {
    $dice = app()->make('MyDice');
    $this->assertInstanceOf(MyDice::class, $dice);
  }

  public function testEmptyDice() {
    $dice = app()->make('MyDice');
    $this->assertEquals($dice->getTotal(), 0);
  }

  public function testNonEmptyDice() {
    $dice = app()->make('MyDice');
    $DiceManager = resolve('DeliveryDotCom\Dice\DiceManager');
    $dice->attach($DiceManager::create(1));
    $dice->attach($DiceManager::create(1));
    $dice->attach($DiceManager::create([9, 9, 9, 9, 9]));
    $this->assertEquals($dice->getTotal(), 11);
  }

  /**
   * Run after every test. Use to tear down external resources created by setUp()
   */
  //proctected function tearDown() {}

  /**
   * Run once after the last test
   */
  //public static function tearDownAfterClass() {}
}
