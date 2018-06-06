<?php

namespace DeliveryDotCom\Models;

use DeliveryDotCom\Contracts\DiceContainerInterface;
use DeliveryDotCom\Contracts\DiceInterface;

class MyDice implements DiceContainerInterface
{
  private $collection = [];

  public function attach(DiceInterface $die)
  {
    $this->collection[] = $die;

    return $this;
  }

  public function getTotal()
  {
    $total = 0;

    foreach ($this->collection as $item)
    {
      $total += $item->roll();
    }

    return $total;
  }
}