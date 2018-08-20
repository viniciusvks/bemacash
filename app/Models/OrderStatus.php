<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderStatus
 *
 * @package App\Models
 * @property string $description
 */
class OrderStatus extends Model
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
        $orderStatus =  collect(parent::toArray())->all();
        return $orderStatus;
    }
}
