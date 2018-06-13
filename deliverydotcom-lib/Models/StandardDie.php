<?php

namespace DeliveryDotCom\Models;

use DeliveryDotCom\Contracts\Dice\Dice;

class StandardDie implements Dice
{
  /**
   * Create a new StandardDie instance.
   *
   * @param int $faces
   * @return void
   *
   * @throws \InvalidArgumentException
   */
  public function __construct($faces = 0)
  {
    $this->faces = $faces;
  }

  /**
   * Generate a random number from the set face values associated with the die
   *
   * @return int
   */ 
  public function roll()
  {
    $val = 0;

    if ($this->faces > 0)
    {
      $val = rand(1, $this->faces);
    }

    return $val;
  }

  public function __set($name, $value)
  {
    switch($name) {
      case 'faces':
        if (!is_numeric($value) || (is_numeric($value) && $value < 0)) {
          throw new \InvalidArgumentException('Argument must be a positive numeric value');
        }
        $this->{$name} = $value;
        break;
    }
  }
}