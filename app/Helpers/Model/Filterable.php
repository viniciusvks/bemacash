<?php

namespace App\Helpers\Model;

use Illuminate\Database\Eloquent\Builder;

/**
 * Interface Searchable
 * @package App\Handlers
 */
interface Filterable
{
    /**
     * @param Builder $builder
     * @param array|null $filters
     * @return Builder
     */
    public function scopeFilter(Builder $builder, ?array $filters) : Builder;
}
