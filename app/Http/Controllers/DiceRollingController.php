<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DeliveryDotCom\Models\MyDice;
use DeliveryDotCom\Models\DieFactory;

class DiceRollingController extends Controller
{
  public function index()
  {
    $container = new MyDice();
    $container->attach(DieFactory::create(10)); // 10-sided die
    $container->attach(DieFactory::create(8)); // 8-sided die
    $container->attach(DieFactory::create(6)); // 6-sided die
    $container->attach(DieFactory::create(4)); // 4-sided die
    $container->attach(DieFactory::create([0, 0, 1, 2, 3, 3])); // A die with arbitrary faces
    $total = $container->getTotal();

    echo "Total of all dice: $total\n";
  }
}