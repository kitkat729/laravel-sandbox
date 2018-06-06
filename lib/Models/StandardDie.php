<?php

namespace DeliveryDotCom\Models;

use Exception;
use DeliveryDotCom\Contracts\DiceInterface;

class StandardDie implements DiceInterface
{
  public function __construct($faces = 0)
  {
    $this->faces = $faces;
  }

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
        if (!is_numeric($value)) {
          throw new Exception('Invalid argument');
        }
        $this->{$name} = $value;
        break;
    }
  }
}