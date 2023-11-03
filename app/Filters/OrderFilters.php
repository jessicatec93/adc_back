<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use App\Filters\Query\Filters;

class OrderFilters extends QueryFilters
{
    private const DEFAULT_ORDER = 'folio';
    private const DEFAULT_SORT = 'ASC';

    /**
    * Filter order by folio
    */
    public function folio($value = '')
    {
        if(!$value){
            $this->builder;
        }
        return $this->builder->where('folio', 'like', '%' . $value . '%');
    }

    /**
     * Filter by orders delivery date
     * filter by range when end date exists.
     */
    public function start_delivery_at($start = '')
    {
        $end = $this->request->end_delivery_at;

        if (empty($start)) {
            return $this->builder;
        }

        if ($start && $end) {
            return $this->builder->whereBetween('delivery_at', [$start, $end]);
        }

        return $this->builder->whereDate('delivery_at', '>=', $start);
    }

    /**
     * Filter by orders delivery date
     * omitted when start exists
     */
    public function end_delivery_at($end = '')
    {
        $start = $this->request->start_delivery_at;

        if (empty($end) || ($start && $end)) {
            return $this->builder;
        }

        return $this->builder->whereDate('delivery_at', '<=', $end);
    }

        /**
     * Filter by orders deadline date
     * filter by range when end date exists.
     */
    public function start_deadline_at($start = '')
    {
        $end = $this->request->end_deadline_at;

        if (empty($start)) {
            return $this->builder;
        }

        if ($start && $end) {
            return $this->builder->whereBetween('deadline_at', [$start, $end]);
        }

        return $this->builder->whereDate('deadline_at', '>=', $start);
    }

    /**
     * Filter by orders deadline date
     * omitted when start exists
     */
    public function end_deadline_at($end = '')
    {
        $start = $this->request->start_deadline_at;

        if (empty($end) || ($start && $end)) {
            return $this->builder;
        }

        return $this->builder->whereDate('deadline_at', '<=', $end);
    }

    /**
    * Filter order orders by any sort
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
    * Filter order orders
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