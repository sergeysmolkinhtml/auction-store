<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotCategory extends Model
{
    use HasFactory;

    protected $table = 'lot_category';

    protected $fillable = [
        'category_id',
        'product_id'
    ];

}
