<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderHistory
 *
 * @package App\Models
 */
class OrderHistory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'description'
    ];

    /**
     * @return array
     */
    public function toArray()
    {
        $orderStatus = collect(parent::toArray())
            ->except(
                'id',
                'order_id'
            )
            ->all();
        return $orderStatus;
    }
}
