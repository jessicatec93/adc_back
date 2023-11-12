<?php

namespace App\Models;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductModel extends Model
{
    use HasFactory, SoftDeletes, Filterable;

    protected $table = 'products';

    protected $PREFIX = 'P';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'folio',
        'description',
        'price_per_unit',
        'classification_id',
        'expiration_at',
        'storage',
        'active',
        'min_amount',
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
        'min_amount'          =>  'integer',
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
