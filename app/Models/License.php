<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 *
 * @package App\Models
 */
class License extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name',
       'contract'
    ];

    /**
     * @return array
     */
    public function toArray()
    {
        $license =  collect(parent::toArray())
            ->except(
                'id',
                'created_at',
                'updated_at'
            )->toArray();

        return $license;
    }
}
