<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filters\ClassificationFilters;
use App\Http\Resources\ClassificationResource;
use App\Http\Services\ClassificationService;
use Exception;

class ClassificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  ProductService  $service
     * @return void
     */
    public function __construct(protected ClassificationService $service)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(ClassificationFilters $filters)
    {
        try{
            return  ClassificationResource::collection($this->service->getList($filters));
        } catch(Exception $e){
            return ['error'=> $e->getMessage()];
        }
    }
}
