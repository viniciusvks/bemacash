<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * @package App\Models
 */
class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name'
    ];

    /**
     * @return array
     */
    public function toArray()
    {
        $product =  collect(parent::toArray())
            ->except(
                'id',
                'pivot',
                'created_at',
                'updated_at'
            );

        $product['quantity'] = $this->pivot
            ->quantity;

        return $product;
    }
}
