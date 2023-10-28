<?php

namespace App\Http\Services;

use App\Filters\ClassificationFilters;
use App\Models\ClassificationsModel;

class ClassificationService
{
    /**
     * Display a listing of the resource.
    */
    public function getList(ClassificationFilters $filters)
    {
        return ClassificationsModel::select('*')->filter($filters)->get();
    }
}