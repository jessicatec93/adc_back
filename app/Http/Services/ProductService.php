<?php

namespace App\Http\Services;

use App\Filters\ProductFilters;
use App\Models\ProductModel;
use Illuminate\Support\Carbon;

class ProductService
{
    /**
     * Display a listing of the resource.
    */
    public function getList(ProductFilters $filter, Int $limit = 5)
    {
        return ProductModel::select('*')->filter($filter)->paginate($limit);
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
        return ['id' => $product->id];
    }

    /**
     * Display a listing of the resource.
    */
    public function update(ProductModel $product, $data)
    {
        tap($product)->update($data);
        return ['id' => $product->id];
    }

    /**
     * Display a listing of the resource.
    */
    public function delete(ProductModel $product)
    {
        $product->timestamps = false;
        $product->deleted_by = 1;
        $product->deleted_at = Carbon::now();
        $product->save();
        return ['id'=> $product->id];
    }
}