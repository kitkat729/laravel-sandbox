<?php

namespace DeliveryDotCom\Models;

use DeliveryDotCom\Contracts\OrderInterface;

class Order implements OrderInterface
{
  /**
   * Order items
   *
   * @var array
   */
  protected $items = [];

  /**
   * Payments applied to the order
   *
   * @var array
   */
  protected $payments = [];

  public function addItem(ItemIterface $item)
  {
    $this->items[] = $item;
  }

  public function addPayment(PaymentInterface $payment)
  {
    $this->payments[] = $payment;
  }

  /**
   * Determine whether the order is paid in full
   *
   * @return boolean
   */
  public function isPaidInFull()
  {
    return ($this->getTotalPaymentAmount() >= $this->getTotalItemAmount());
  }

  /**
   * Get the total amount of order items
   *
   * @return float
   */
  protected function getTotalItemAmount()
  {
    $amount = 0.0;

    foreach ($this->items as $item) {
      $amount += $item->getAmount();
    }

    return $amount;
  }

  /**
   * Get the total amount of payments applied to the order
   *
   * @return float
   */
  protected function getTotalPaymentAmount()
  {
    $amount = 0.0;

    foreach ($this->payments as $payment) {
      $amount += $payment->getAmount();
    }

    return $amount;
  }
}