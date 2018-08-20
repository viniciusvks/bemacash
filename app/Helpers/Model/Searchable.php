<?php

namespace App\Helpers\Model;

use Illuminate\Database\Eloquent\Builder;

/**
 * Interface Searchable
 * @package App\Handlers
 */
interface Searchable
{
    /**
     * @param Builder $builder
     * @param string $subject
     * @return Builder
     */
    public function scopeSearch(Builder $builder, ?string $subject) : Builder;

    /**
     * @param Builder $builder
     * @param array|null $filters
     * @return Builder
     */
    public function scopeFilter(Builder $builder, ?array $filters): Builder;
}
