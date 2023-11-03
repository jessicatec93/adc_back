<?php

namespace App\Http\Services;

use App\Filters\OrderFilters;
use App\Models\OrderModel;
use Illuminate\Support\Carbon;

class OrderService
{
        /**
     * Display a listing of the resource.
    */
    public function getList(OrderFilters $filter)
    {
        $limit = $filter->request->limit ?? 5;
        return OrderModel::select('*')->filter($filter)->paginate($limit);
    }

    /**
     * Display a listing of the resource.
    */
    public function getOne(OrderModel $order)
    {
        return $order->load(['product', 'status', 'creator', 'updater']);
    }

    /**
     * Display a listing of the resource.
    */
    public function create($data)
    {
        $data['created_by'] = 1;
        $order = new OrderModel($data);
        $order->folio = $order->getfolio();
        $order->save();
        return ['id' => $order->id];
    }

    /**
     * Display a listing of the resource.
    */
    public function update(OrderModel $order, $data)
    {
        $data['updated_by'] = 1;
        tap($order)->update($data);
        return ['id' => $order->id];
    }

    /**
     * Display a listing of the resource.
    */
    public function delete(OrderModel $order)
    {
        $order->timestamps = false;
        $order->deleted_by = 1;
        $order->deleted_at = Carbon::now();
        $order->active = false;
        $order->save();
        return ['id'=> $order->id];
    }
}