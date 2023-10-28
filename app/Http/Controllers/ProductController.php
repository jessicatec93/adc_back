<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ProductService;
use App\Models\ProductModel;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductListResource;
use App\Filters\ProductFilters;
use Exception;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  ProductService  $service
     * @return void
     */
    public function __construct(protected ProductService $service)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(ProductFilters $filter)
    {
        try{
            return  ProductListResource::collection($this->service->getList($filter))->response()->getData(true);
        } catch(Exception $e){
            return ['error'=> $e->getMessage()];
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try{
            $data = $request->validated();
            return  $this->service->create($data);
        } catch(Exception $e){
            return ['error'=> $e->getMessage()];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductModel $product)
    {
        try{
            return  ProductResource::make($this->service->getOne($product));
        } catch(Exception $e){
            return ['error'=> $e->getMessage()];
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ProductModel $product, ProductRequest $request)
    {
        try{
            $data = $request->validated();
            return  $this->service->update($product, $data);
        } catch(Exception $e){
            return ['error'=> $e->getMessage()];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductModel $product)
    {
        try{
            return  $this->service->delete($product);
        } catch(Exception $e){
            return ['error'=> $e->getMessage()];
        }
    }
}
