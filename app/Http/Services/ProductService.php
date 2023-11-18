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
    public function getList(ProductFilters $filter)
    {
        $limit = $filter->request->limit ?? 5;
        return ProductModel::select('*')->filter($filter)->paginate($limit);
    }

        /**
     * Display a listing of the resource.
    */
    public function getListResum(ProductFilters $filter)
    {
        return ProductModel::select('*')->filter($filter)->get();
    }

    /**
     * Display a listing of the resource.
    */
    public function getOne(ProductModel $product)
    {
        return $product->load(['classification', 'creator', 'updater']);
    }

    /**
     * Display a listing of the resource.
    */
    public function create($data)
    {
        $data['created_by'] = 1;
        $product = new ProductModel($data);
        $product->folio = $product->getfolio();
        $product->save();
        return ['folio' => $product->folio];
    }

    /**
     * Display a listing of the resource.
    */
    public function update(ProductModel $product, $data)
    {
        $data['updated_by'] = 1;
        tap($product)->update($data);
        return ['folio' => $product->folio];
    }

    /**
     * Display a listing of the resource.
    */
    public function delete(ProductModel $product)
    {
        $product->timestamps = false;
        $product->deleted_by = 1;
        $product->deleted_at = Carbon::now();
        $product->active = false;
        $product->save();
        return ['folio'=> $product->folio];
    }
}