<?php

namespace App\Models;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ClassificationsModel extends Model
{
    use HasFactory, SoftDeletes, Filterable;

    protected $table = 'classifications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'active',
    ];
}
