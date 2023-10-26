<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price_per_unit',
        'classification_id',
        'expiration_at',
        'storage',
        'active',
        'created_by',
        'updated_by',
        'removed_by',
    ];
    
}
