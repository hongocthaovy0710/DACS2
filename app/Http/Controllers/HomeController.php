<?php

namespace App\Http\Controllers;

use App\Models\SanPhamModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(){

        $meta_desc = "Trang bán hoa "; 
        $meta_keywords = "Hoa tươi";
        $meta_title = "flower store";

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


                public function send_mail(){
                    //send mail
                           $to_name = "nhungdang";
                          // $tam1 = 'ngolequanit@gmail.com'".','.'lequan007@gmail.com'";
                           $tam2 = 'hongnhungdt137@gmail.com';
                           $tam3='nhungdth.23it@vku.udn.vn';
                          // $to_email = array();
                              $to_email= [];
                 $to_email[] = $tam2;
                   $to_email[] = $tam3;
                          //  $to_email = ['ngolequanit@gmail.com','lequan007@gmail.com'];
                           //$to_email = "ngolequanit@gmail.com";//send to this email
                           //$to_email = ['ngolequanit@gmail.com','lequan007@gmail.com'];
                        
                           $data = array("name"=>"Mail từ tài khoản Khách hàng","body"=>'Mail gửi về vấn về hàng hóa'); //body of mail.blade.php
                           
                           Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){
           
                               $message->to($to_email)->subject('kiểm tra thử gửi mail google');//send this mail with subject
                               $message->from($to_email,$to_name);//send from this mail
           
                           });
                            return view('pages.send_mail')->with('name',$to_name);
                           //--send mail
               }


            }