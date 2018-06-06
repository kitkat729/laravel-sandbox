<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use DeliveryDotCom\Models\MyDice;
use DeliveryDotCom\Models\DieFactory;

class DiceRollingTest extends TestCase
{
  public function testCreateContainer() {
    $container = new MyDice();
    $this->assertInstanceOf(MyDice::class, $container);
  }

  public function testTotalEquals() {
    $container = new MyDice();
    $container->attach(DieFactory::create(1));
    $container->attach(DieFactory::create(1));
    $container->attach(DieFactory::create([9, 9, 9, 9, 9]));
    $this->assertEquals($container->getTotal(), 11);
  }
}
