<?php
namespace Ebanx\Benjamin\Services\Adapters;

class CashPaymentAdapter extends PaymentAdapter
{
    public function transform()
    {
        $transformed = parent::transform();
        $transformed->bypass_boleto_screen = true;

        if (isset($this->payment->dueDate)) {
            $transformed->due_date = $this->payment->dueDate->format('d/m/Y');
        }

        return $transformed;
    }
}
