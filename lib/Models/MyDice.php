<?php

namespace DeliveryDotCom\Models;

use DeliveryDotCom\Contracts\DiceContainerInterface;
use DeliveryDotCom\Contracts\DiceInterface;

class MyDice implements DiceContainerInterface
{
  protected $items = [];

  public function attach(DiceInterface $die)
  {
    $this->items[] = $die;

    return $this;
  }

  public function getTotal()
  {
    $total = 0;

    foreach ($this->items as $item)
    {
      $total += $item->roll();
    }

    return $total;
  }
}