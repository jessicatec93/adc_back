<?php

namespace App\Http\Services;

use App\Models\ProductModel;
use Illuminate\Support\Carbon;

class ProductService
{
    /**
     * Display a listing of the resource.
    */
    public function getList()
    {
        return ProductModel::select('*')->get()->toArray();
    }

    /**
     * Display a listing of the resource.
    */
    public function getOne(ProductModel $product)
    {
        return $product->load(['classification', 'creator']);
    }

    /**
     * Display a listing of the resource.
    */
    public function create($data)
    {
        $data['created_by'] = 1;
        $product = new ProductModel($data);
        $product->save();
        return $product;
    }

    /**
     * Display a listing of the resource.
    */
    public function update(ProductModel $product, $data)
    {
        return tap($product)->update($data);
    }

    /**
     * Display a listing of the resource.
    */
    public function delete(ProductModel $product)
    {
        $product->timestamps = false;
        $product->deleted_by = 1;
        $product->deleted_at = Carbon::now();
        return $product->save();
    }
}