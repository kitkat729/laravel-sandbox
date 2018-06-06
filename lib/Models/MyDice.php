<?php

namespace DeliveryDotCom\Models;

use DeliveryDotCom\Contracts\DiceContainerInterface;
use DeliveryDotCom\Contracts\DiceInterface;

class MyDice implements DiceContainerInterface
{
  /**
   * Dice in the container
   *
   * @var array
   */
  protected $items = [];

  /**
   * Attach a die to the container
   *
   * @param DiceInterface $die
   * @return this
   */
  public function attach(DiceInterface $die)
  {
    $this->items[] = $die;

    return $this;
  }

  /**
   * Get the sum of all rolled dice
   *
   * @return int
   */
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