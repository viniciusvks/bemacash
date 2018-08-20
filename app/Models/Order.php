<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Order
 *
 * @package App\Models
 * @property int $id
 * @property string $status_updated_at
 * @property-read  OrderStatus $status
 * @property-read  User $user
 * @property-read  UserAddress $shippingAddress
 * @property-read  OrderHistory $history
 * @property-read  Kit $kit
 */
class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'status_updated_at',
       'comment',
       'invoice_number',
       'invoice_issue_date',
       'sales_executive',
       'hardware_order_number',
    ];

    /**
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function kit() : BelongsTo
    {
        return $this->belongsTo(Kit::class, 'kit_id');
    }

    /**
     * @return BelongsTo
     */
    public function status() : BelongsTo
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }

    /**
     * @return BelongsTo
     */
    public function shippingAddress() : BelongsTo
    {
        return $this->belongsTo(UserAddress::class, 'user_address_id');
    }

    /**
     * @return HasMany
     */
    public function history() : HasMany
    {
        return $this->hasMany(OrderHistory::class, 'order_id');
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $order = collect(parent::toArray())
            ->except(
                'user_id',
                'user_address_id',
                'kit_id',
                'status_id',
                'status_updated_at'
            )->toArray();

        $order['status'] = [

            'description' => $this->status->description,
            'last_updated' => $this->status_updated_at

        ];

        $order['shipping_document'] = $this->user
            ->document_number;

        $order['shipping_address'] = $this->shippingAddress
        ->toArray();

        $order['kit'] = $this->kit
            ->toArray();

        $order['history'] = $this->history
            ->toArray();

        return $order;
    }
}
