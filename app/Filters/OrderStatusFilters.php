<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use App\Filters\Query\Filters;

class OrderStatusFilters extends QueryFilters
{
    private const DEFAULT_ORDER = 'name';
    private const DEFAULT_SORT = 'ASC';
    
    /**
    * Filter order products by any sort
    */
    public function sort($sort = ''): Builder
    {
        if (empty($sort)) {
            return $this->builder;
        }

        $order = $this->request->order ?? self::DEFAULT_ORDER;

        return $this->builder->orderBy($order, $sort);
    }

    /**
    * Filter order products
    */
    public function order($order = ''): Builder
    {
        if (empty($order) || !empty($this->request->sort)) {
            return $this->builder;
        }

        $sort = $this->request->sort ?? self::DEFAULT_SORT;

        return $this->builder->orderBy($order, $sort);
    }
}