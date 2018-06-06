<?php

namespace DeliveryDotCom\Models;

use DeliveryDotCom\Models\StandardDie;
use DeliveryDotCom\Models\AnyDie;

class DieFactory
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