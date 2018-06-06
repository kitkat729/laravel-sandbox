<?php

namespace DeliveryDotCom\Models;

use InvalidArgumentException;
use DeliveryDotCom\Contracts\DiceInterface;

class AnyDie implements DiceInterface
{

  public function __construct(array $faces)
  {
    $this->faces = $faces;
  }

  public function roll()
  {
    $val = 0;

    if (($count = count($this->faces)) > 0)
    {
      $val = $this->faces[rand(0, $count-1)];
    }

    return $val;
  }

  public function __set($name, $value)
  {
    switch($name) {
      case 'faces':
        foreach($value as $item) {
          if (!is_numeric($item) || (is_numeric($item) && $item < 0)) {
            throw new InvalidArgumentException('Array argument must contain only positive numeric values');
          }
        }
        $this->{$name} = $value;
        break;
    }
  }
}