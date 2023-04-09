<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;


class Lot extends Model
{
    use HasFactory;

    protected $table = 'lots';

    protected $fillable = ['title', 'description'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class,'lot_category','lot_id','category_id');
    }

    public function scopeCategoriesId(Builder $query,Request $request)
    {
        return $query->when(request()->has('categories'),function ($query) use ($request) {
            $query->withWhereHas('categories', function ($query) use ($request){
                $categories = explode(',',$request->input('categories'));
                $query->whereIn('category_id', $categories);
            });
        })->get();
    }

}
