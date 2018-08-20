<?php

namespace App\Helpers\Model;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait SearchAndFilter
 * @package App\Helpers\Search
 */
trait SearchAndFilter
{
    /**
     * @param Builder $builder
     * @param string $subject
     * @return mixed
     */
    public function scopeSearch(Builder $builder, ?string $subject) : Builder
    {
        $builder =  $this->useJoinsToSearch($builder);
        $builder =  $this->useScopeToSearch($builder);

        if (!empty($subject)) {
            $columns = $this->useColumnsToSearch();

            $builder = $builder->where(function ($query) use ($subject, $columns) {
                foreach ($columns as $key => $column) {
                    if ($key == 0) {
                        $query->where($column, 'LIKE', "%{$subject}%");
                    } else {
                        $query->orWhere($column, 'LIKE', "%{$subject}%");
                    }
                }
            });
        }

        return $builder;
    }

    /**
     * @param Builder $builder
     * @param array|null $filters
     * @return Builder
     */
    public function scopeFilter(Builder $builder, ?array $filters): Builder
    {
        if (!empty($filters)) {
            $builder = $builder->where(function ($query) use ($filters) {
                foreach ($filters as $column => $value) {
                    $query->where($column, '=', $value);
                }
            });
        }

        return $builder;
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    protected function useJoinsToSearch(Builder $builder) : Builder
    {
        return $builder;
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    abstract public function useScopeToSearch(Builder $builder) : Builder;

    /**
     * @return array
     */
    abstract public function useColumnsToSearch() : array;
}
