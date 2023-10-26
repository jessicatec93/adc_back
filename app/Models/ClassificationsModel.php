<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassificationsModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'classifications';

    protected $fillable = [
        'name',
        'slug',
        'active',
    ];
}
