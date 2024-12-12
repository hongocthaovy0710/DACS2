<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function add_product() {
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id', 'desc')->get();
        
        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }

    public function all_product()
    {
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->orderBy('tbl_product.product_id', 'desc')->get();
        $manager_product = view('admin.all_product')->with('all_product', $all_product);
        return view('admin_layout')->with('admin.all_product', $manager_product);
    }

    public function save_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $date['product_image'] = $request->product_status;

        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
        }

        DB::table('tbl_product')->insert($data);
        Session::put('message', 'Thêm sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function unactive_product($product_id) {
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message', 'không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function active_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message', 'Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id)
    {
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();

        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product', $edit_product)
            ->with('cate_product', $cate_product)->with('brand_product', $brand_product);
        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }

    

    public function update_product(Request $request, $product_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;

        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
        }

        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    public function delete_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id) ->delete();
        Session::put('message', 'Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function showProducts()
    {
        // Lấy tất cả sản phẩm 
        $products = DB::table('tbl_product')->get();

        return view('admin.product_list', compact('products'));
    }

     // Hiển thị trang chủ

  
     public function showNewProducts() {
        // Lấy danh sách category
        $categories = DB::table('tbl_category_product')->get();
    
        // Lấy danh sách sản phẩm mới nhất theo từng category, giới hạn 8 sản phẩm mỗi category
        $new_products_by_category = [];
        foreach ($categories as $category) {
            $new_products_by_category[$category->category_id] = DB::table('tbl_product')
                ->where('category_id', $category->category_id)
                ->orderBy('created_at', 'desc')
                ->limit(8)
                ->get();
        }
        // lấy ra chậu hoa mới nhất
        $flower_pots = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
        ->where('tbl_category_product.category_name', 'Chậu hoa')
        ->orderBy('tbl_product.created_at', 'desc')
        ->limit(3)
        ->get();

        // lấy ra kệ hoa mới nhất
        $flower_stands = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
        ->where('tbl_category_product.category_name', 'Kệ hoa')
        ->orderBy('tbl_product.created_at', 'desc')
        ->limit(3)
        ->get();

        $bestsellers = DB::table('tbl_order_details')
        ->join('tbl_product', 'tbl_order_details.product_id', '=', 'tbl_product.product_id')
        ->select('tbl_product.product_id', 'tbl_product.product_name', 'tbl_product.product_image', 'tbl_product.product_price', DB::raw('SUM(tbl_order_details.product_sales_quantity) as total_sales'))
        ->groupBy('tbl_product.product_id', 'tbl_product.product_name', 'tbl_product.product_image', 'tbl_product.product_price')
        ->orderBy('total_sales', 'desc')
        ->limit(6)
        ->get();
        

        // Truyền dữ liệu sang view
        return view('pages.home', [
            'categories' => $categories,
            'new_products_by_category' => $new_products_by_category, 
            'flower_pots' => $flower_pots,
            'flower_stands' => $flower_stands,
            'bestsellers' => $bestsellers
        ]);
    }
    

    public function details_product($product_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id', 'desc')->get();

        $details_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_product.product_id',$product_id)->get();

        foreach($details_product as $key => $value)
            $category_id = $value->category_id;
        

        $related_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_category_product.category_id',$category_id)
            ->whereNotIn('tbl_product.product_id',[$product_id])->get();

        return view('pages.sanpham.show_details')
        ->with('category',$cate_product)->with('brand',$brand_product)
        ->with('product_details',$details_product)
        ->with('relate', $related_product);
    }


    public function bestSellingProducts()
    {
        $bestSellingProducts = Product::orderBy('product_sold', 'desc')->take(10)->get();
        return view('admin.dashboard', compact('bestSellingProducts'));
    }

}