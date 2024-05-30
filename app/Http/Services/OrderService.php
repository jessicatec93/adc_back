<?php

namespace App\Http\Services;

use App\Filters\OrderFilters;
use App\Models\OrderModel;
use App\Models\ProductModel;
use Illuminate\Support\Carbon;

class OrderService
{
        /**
     * Display a listing of the resource.
    */
    public function getList(OrderFilters $filter)
    {
        $limit = $filter->request->limit ?? 5;
        return OrderModel::select('*')->with('status')->filter($filter)->paginate($limit);
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
        $user_id = 1;
        $data['created_by'] = $user_id;
        $finalized = 5;
        $order = new OrderModel($data);
        $order->folio = $order->getfolio();
        $order->save();

        if($data["status_id"] == $finalized) {
            $product = ProductModel::find($order->product_id);
            $product->updated_by = $user_id;
            $product->storage += $order->required_quantity;
            $product->save();
        }

        return ['folio' => $order->folio];
    }

    /**
     * Display a listing of the resource.
    */
    public function update(OrderModel $order, $data)
    {
        $user_id = 1;
        $finalized = 5;

        if ($order->status_id != $finalized) {
            if($data["status_id"] == $finalized) {
                $product = ProductModel::find($order->product_id);
                $product->updated_by = $user_id;
                $product->storage += $order->required_quantity;
                $product->save();
            }

            $data['updated_by'] = $user_id;
            tap($order)->update($data);
        }

        return ['folio' => $order->folio];
    }

    /**
     * Display a listing of the resource.
    */
    public function delete(OrderModel $order)
    {
        $user_id = 1;
        $finalized = 5;

        if($order->status_id == $finalized) {
            $product = ProductModel::find($order->product_id);;
            if ($product->storage - $order->required_quantity >= 0) {
                $product->updated_by = $user_id;
                $product->storage -= $order->required_quantity;
                $product->save();
            }
        }

        $order->timestamps = false;
        $order->deleted_by = $user_id;
        $order->deleted_at = Carbon::now();
        $order->active = false;
        $order->save();

        return ['folio'=> $order->folio];
    }
}