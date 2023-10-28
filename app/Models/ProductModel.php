<?php

namespace App\Models;

//use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductModel extends Model
{
    use HasFactory, SoftDeletes;// Filterable;

    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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
        'deleted_by',
    ];

     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'expiration_at'       =>  'datetime:Y-m-d H:m:s',
        'storage'             =>  'integer',
        'price_per_unit'      =>  'float',
        'created_at'          =>  'datetime:Y-m-d H:m:s',
        'updated_at'          =>  'datetime:Y-m-d H:m:s',
    ];

    public function classification(): HasOne
    {
        return $this->hasOne(ClassificationsModel::class, 'id', 'classification_id');
    }

    public function creator(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
