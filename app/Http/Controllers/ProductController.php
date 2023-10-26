<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ProductService;

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
    public function index()
    {
        try{
            return  $this->service->getList();
        } catch(\Exception $e){
            return ['error'=> $e->getMessage()];
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            return  $this->service->create();
        } catch(\Exception $e){
            return ['error'=> $e->getMessage()];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            return  $this->service->getOne();
        } catch(\Exception $e){
            return ['error'=> $e->getMessage()];
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            return  $this->service->update();
        } catch(\Exception $e){
            return ['error'=> $e->getMessage()];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            return  $this->service->delete();
        } catch(\Exception $e){
            return ['error'=> $e->getMessage()];
        }
    }
}
