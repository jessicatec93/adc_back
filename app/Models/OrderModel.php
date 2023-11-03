<?php

namespace App\Models;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderModel extends Model
{
    use HasFactory, SoftDeletes, Filterable;

    protected $table = 'orders';

    protected $PREFIX = 'O';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'folio',
        'delivery_at',
        'deadline_at',
        'active',
        'description',
        'price_per_unit',
        'total_price',
        'required_quantity',
        'status_id',
        'product_id',
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
        'delivery_at'         =>  'datetime:Y-m-d H:m:s',
        'deadline_at'         =>  'datetime:Y-m-d H:m:s',
        'required_quantity'   =>  'integer',
        'price_per_unit'      =>  'float',
        'total_price'         =>  'float',
        'created_at'          =>  'datetime:Y-m-d H:m:s',
        'updated_at'          =>  'datetime:Y-m-d H:m:s',
    ];

    public function product(): HasOne
    {
        return $this->hasOne(ProductModel::class, 'id', 'product_id');
    }

    public function status(): HasOne
    {
        return $this->hasOne(OrderStatusModel::class, 'id', 'status_id');
    }

    public function creator(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function updater(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }

    public function getFolio()
    {
        $num = $this::count() + 1;
        return $this->PREFIX . str_pad($num, 5, '0', STR_PAD_LEFT);
    }
}
