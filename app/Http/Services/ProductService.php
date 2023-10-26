<?php

namespace App\Http\Services;

use App\Models\ProductModel;

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
    public function getOne()
    {
        return ["producto" => "Datos"];
    }

    /**
     * Display a listing of the resource.
    */
    public function create()
    {
        return ["producto" => "Datos"];
    }

    /**
     * Display a listing of the resource.
    */
    public function update()
    {
        return ["producto" => "Datos"];
    }

    /**
     * Display a listing of the resource.
    */
    public function delete()
    {
        return ["producto" => "Datos"];
    }
}