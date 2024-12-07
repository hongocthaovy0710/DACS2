<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'category_name', 'category_desc', 'category_status', 'category_product_keywords','slug_category_product'
    ];

    protected $primaryKey ='category_id';
    protected $table ='tbl_category_product';
}