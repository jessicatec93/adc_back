<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\OrderService;
use App\Models\OrderModel;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderListResource;
use App\Filters\OrderFilters;
use Exception;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  OrderService  $service
     * @return void
     */
    public function __construct(protected OrderService $service)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(OrderFilters $filters)
    {
        try{
            return  OrderListResource::collection($this->service->getList($filters));
        } catch(Exception $e){
            return ['error'=> $e->getMessage()];
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
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
    public function show(OrderModel $order)
    {
        try{
            return  OrderResource::make($this->service->getOne($order));
        } catch(Exception $e){
            return ['error'=> $e->getMessage()];
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(OrderModel $order, OrderRequest $request)
    {
        try{
            $data = $request->validated();
            $response = $this->service->update($order, $data);
            return response()->json(['data' => $response], 200);
        } catch(Exception $e){
            return ['error'=> $e->getMessage()];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderModel $order)
    {
        try{
            $response = $this->service->delete($order);
            return response()->json(['data' => $response], 200);
        } catch(Exception $e){
            return ['error'=> $e->getMessage()];
        }
    }
}
