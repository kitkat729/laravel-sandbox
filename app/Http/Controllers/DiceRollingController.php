<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use DeliveryDotCom\Models\DieFactory;

class DiceRollingController extends Controller
{
  //protected $container;

  public function __construct()
  {
    //$this->container = $container;
  }

  public function index()
  {
    $dice = app()->make('MyDice');
    $dice->attach(app('DiceManager')::create(10)); // 10-sided die
    $dice->attach(app('DiceManager')::create(8)); // 8-sided die
    $dice->attach(app('DiceManager')::create(6)); // 6-sided die
    $dice->attach(app('DiceManager')::create(4)); // 4-sided die
    $dice->attach(app('DiceManager')::create([0, 0, 1, 2, 3, 3])); // A die with arbitrary faces
    $total = $dice->getTotal();

    echo "Total of all dice: $total\n";
  }
}