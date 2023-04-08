<?php

namespace App\Filters;

class LotFilter extends QueryFilter
{
    public function category_id($id = null)
    {
        return $this->builder->when($id, function ($query) use ($id) {
            $query->where('category_id', $id);
        });
    }

    public function search_field($search_string = '')
    {
        return $this->builder
            ->where('name', 'LIKE', '%' . $search_string . '%')
            ->orWhere('description', 'LIKE', '%' . $search_string . '%');
    }
}
