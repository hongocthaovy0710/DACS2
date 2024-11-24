<?php

namespace App\Http\Controllers;

use App\Models\SanPhamModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(){

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id', 'desc')->get();
     
        $all_product = DB::table('tbl_product')->where('product_status','0')->orderby('product_id', 'desc')->limit(4)->get();

        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product);
 
        }
        // public function index1(){
        //     return view('home');
        //     }

       
        
        public function  show_category(){
            $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();
            $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id', 'desc')->get();
         
            $all_product = DB::table('tbl_product')->where('product_status','0')->orderby('product_id', 'desc')->limit(4)->get();
            return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product);
            }

            public function  contact(){
                return view('pages.contact');
                }

              
         public function show_shop_detail (){
            return view('pages.sanpham.show_details');
            }


            // public function search(){
            //     $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();
            //     $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id', 'desc')->get();
             
            //     $all_product = DB::table('tbl_product')->where('product_status','0')->orderby('product_id', 'desc')->limit(4)->get();
            //     return view('pages.search')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product);
            //     }

                public function search(Request $request){
                    $find = $request->search;
                    $reuslt = SanPhamModel::where('product_name','like','%'.$find.'%')->orWhere('product_price','like',$find)->get();
                    if($reuslt){
                        
                        return view('pages.sanpham.search')->with('timkiem',$reuslt);
                    }else{
                        Session::put('timsanpham','Không Tìm Thấy Sản Phẩm ');
                        Session::put('message1',$find);
                        return view('pages.sanpham.search')->with('timkiem',$reuslt);
                    };
            
                }
}