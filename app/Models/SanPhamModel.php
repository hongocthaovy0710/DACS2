<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPhamModel extends Model
{
    use HasFactory;
    public $timestamps = true; 
    protected $table ='tbl_product';
    protected $fillable = ['product_name','brand_id','product_decs','product_content','product_price','product_image','product_status','category_id'];
    protected $primaryKey = 'product_id';
}