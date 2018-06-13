<?php

namespace DeliveryDotCom\Contracts\Dice;

use DeliveryDotCom\Contracts\Dice\Dice as DiceInterface;

interface Container
{
	public function attach(DiceInterface $die);
	public function getTotal();
}
