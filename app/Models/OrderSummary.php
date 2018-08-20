<?php

namespace App\Models;

/**
 * Class OrderSummary
 *
 * @package App\Models
 */
class OrderSummary extends Order
{
    protected $table = 'orders';

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'kit' => $this->kit->name,
            'status' => [
                'description' => $this->status->description,
                'last_updated' => $this->status_updated_at
            ]
        ];
    }
}
