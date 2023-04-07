<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    use HasFactory;

    protected $table = 'lot';

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'created_at',
        'updated_at',
    ];

    public function category()
    {
        $this->hasMany(Lot::class);
    }
}
