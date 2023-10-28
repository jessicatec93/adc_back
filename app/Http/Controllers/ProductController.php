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
    public function index(ProductFilters $filters)
    {
        try{
            return  ProductListResource::collection($this->service->getList($filters));
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
            $response = $this->service->create($data);
            return response()->json(['data' => $response], 201);
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
            $response = $this->service->update($product, $data);
            return response()->json(['data' => $response], 200);
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
            $response = $this->service->delete($product);
            return response()->json(['data' => $response], 200);
        } catch(Exception $e){
            return ['error'=> $e->getMessage()];
        }
    }
}
