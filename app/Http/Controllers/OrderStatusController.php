<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filters\OrderStatusFilters;
use App\Http\Resources\OrderStatusResource;
use App\Http\Services\OrderStatusService;
use Exception;

class OrderStatusController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  ProductService  $service
     * @return void
     */
    public function __construct(protected OrderStatusService $service)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(OrderStatusFilters $filters)
    {
        try{
            return  OrderStatusResource::collection($this->service->getList($filters));
        } catch(Exception $e){
            return ['error'=> $e->getMessage()];
        }
    }
}
