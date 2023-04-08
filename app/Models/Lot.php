<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lot extends Model
{
    use HasFactory;

    protected $table = 'lots';

    protected $fillable = ['title', 'description'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class,'lot_category','lot_id','category_id');
    }

}
