<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table = 'subcategorys';
    protected $primaryKey = 'id_subcategory';
    protected $fillable = ['name', 'description', 'id_category'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }
}
