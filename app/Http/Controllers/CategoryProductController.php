<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class CategoryProductController extends Controller
{
    public function add_category_product(){
        return view('admin.add_category_product');
    }

    public function all_category_product(){
        $all_category_product = Category::orderBy('category_id','desc')->get();
        // $this->AuthLogin();
        // $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product', $all_category_product);
        return view('admin_layout')->with('admin.all_category_product', $manager_category_product);
    }

    public function save_category_product(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $category = new Category();
        $category->category_name = $data['category_product_name'];
        $category->category_desc = $data['category_product_desc'];
        $category->category_status = $data['category_product_status'];
        $category->category_product_keywords = $data['category_product_keywords'];
        $category->slug_category_product = $data['slug_category_product'];
        $category->save();



        // $data = array();
        // $data['category_name'] = $request->category_product_name;
        // $data['category_product_keywords'] = $request->category_product_keywords;
        // $data['slug_category_product'] = $request->slug_category_product;
        // $data['category_desc'] = $request->category_product_desc;
        // $data['category_status'] = $request->category_product_status;
        // DB::table('tbl_category_product')->insert($data);
        Session::put('message', 'Thêm danh mục sản phẩm thành công');
        return Redirect::to('add-category-product');
    }

    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function unactive_category_product($category_product_id) {
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);
        Session::put('message', 'không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    public function active_category_product($category_product_id){
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);
        Session::put('message', 'Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id){
        $edit_category_product = Category::find($category_product_id);
        // $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }

    public function update_category_product(Request $request,$category_product_id){
        $this->AuthLogin();
        $data = $request->all();
        $category = Category::find($category_product_id);
        $category->category_name = $data['category_product_name'];
        $category->category_desc = $data['category_product_desc'];
        $category->category_status = $data['category_product_status'];
        $category->category_product_keywords = $data['category_product_keywords'];
        $category->slug_category_product = $data['slug_category_product'];
        $category->save();
        // $data = array();
        // $data['category_name'] = $request->category_product_name;
        // $data['category_desc'] = $request->category_product_desc;
        
        // DB::table('tbl_category_product')->where('category_id',$category_product_id) ->update($data);
        Session::put('message', 'Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    public function delete_category_product($category_product_id){
        DB::table('tbl_category_product')->where('category_id',$category_product_id) ->delete();
        Session::put('message', 'Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    public function show_category_home($category_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id', 'desc')->get();
        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_product.category_id',$category_id)->get();
        
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->limit(1)->get();
        
        return view('pages.category.show_category')
        ->with('category',$cate_product)->with('brand',$brand_product)
        ->with('category_by_id',$category_by_id)
        ->with('category_name',$category_name);
    }
   
}
    