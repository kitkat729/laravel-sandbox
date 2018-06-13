<?php

namespace DeliveryDotCom\Dice;

use DeliveryDotCom\Contracts\Dice\Factory;
use DeliveryDotCom\Models\StandardDie;
use DeliveryDotCom\Models\AnyDie;

class DiceManager implements Factory
{
  public static function create($faces)
  {
    $die = null;

    if (is_array($faces)) {
      $die = new AnyDie($faces);
    } else {
      $die = new StandardDie($faces);
    }

    return $die;
  }
}