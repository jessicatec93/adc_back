<?php

namespace App\Http\Services;

use App\Filters\OrderStatusFilters;
use App\Models\OrderStatusModel;

class OrderStatusService
{
    /**
     * Display a listing of the resource.
    */
    public function getList(OrderStatusFilters $filters)
    {
        return OrderStatusModel::select('*')->filter($filters)->get();
    }
}