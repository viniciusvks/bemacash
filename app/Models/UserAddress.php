<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserAddress
 *
 * @package App\Models
 */
class UserAddress extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'zip_code',
        'city',
        'state',
        'country'
    ];

    /**
     * @return array
     */
    public function toArray()
    {
        $address =  collect(parent::toArray())
            ->except(
                'id',
                'user_id',
                'created_at',
                'updated_at'
            )
            ->all();
        return $address;
    }
}
