<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Kit
 *
 * @package App\Models
 * @property-read string $name
 * @property-read Collection $products
 * @property-read License $license
 */
class Kit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name',
       'price'
    ];

    /**
     * @return BelongsTo
     */
    public function license() : BelongsTo
    {
        return $this->belongsTo(License::class, 'license_id');
    }

    /**
     * @return BelongsToMany
     */
    public function products() : BelongsToMany
    {
        return $this->belongsToMany('App\Models\Product', 'kit_product', 'kit_id')
            ->withPivot('quantity');
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $kit =  collect(parent::toArray())->except(
            'id',
            'license_id',
            'created_at',
            'updated_at'
        )->toArray();

        $kit['license'] = $this->license
            ->toArray();

        $kit['products'] = $this->products
            ->toArray();

        return $kit;
    }
}
