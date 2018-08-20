<?php

namespace App\Helpers\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait OrderedRelation
 * @package App\Helpers\Model
 */
trait Ordered
{
    /**
     * @return HasMany
     */
    public function ordered() : HasMany
    {
        return $this->hasMany($this->orderedClass());
    }

    /**
     * @return string
     */
    abstract public function orderedClass() : string;
}
