<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use App\Filters\Query\Filters;

class ProductFilters extends QueryFilters
{
    private const DEFAULT_ORDER = 'name';
    private const DEFAULT_SORT = 'ASC';

    /**
    * Filter product by name
    */
    public function name($value = '')
    {
        if(!$value){
            $this->builder;
        }
        return $this->builder->where('name', 'like', '%' . $value . '%');
    }

    /**
     * Filter by prodcuts expiration date
     * filter by range when end date exists.
     */
    public function start_expiration_at($start = '')
    {
        $end = $this->request->end_expiration_at;

        if (empty($start)) {
            return $this->builder;
        }

        if ($start && $end) {
            return $this->builder->whereBetween('expiration_at', [$start, $end]);
        }

        return $this->builder->whereDate('expiration_at', '>=', $start);
    }

    /**
     * Filter by products expiration date
     * omitted when start exists
     */
    public function end_expiration_at($end = '')
    {
        $start = $this->request->start_expiration_at;

        if (empty($end) || ($start && $end)) {
            return $this->builder;
        }

        return $this->builder->whereDate('expiration_at', '<=', $end);
    }

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