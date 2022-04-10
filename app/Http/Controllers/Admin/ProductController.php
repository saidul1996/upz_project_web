<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Requisition;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Lib\Image;
use App\Traits\ChecksPermission;

class ProductController extends Controller
{
    use ChecksPermission;
    protected string $permissionPrefix = 'product';

    public function index()
    {
        $all_data = Product::all();
        return view('admin.product.index', compact('all_data'));
    }

    public function alertProduct()
    {
        $all_data = Product::where('status', 0)->whereRaw('quantity < alert_quantity')->get();
        return view('admin.product.index', compact('all_data'));
    }

    public function create()
    {

        $all_category = Category::where('status',0)->get();
        $all_brand = Brand::where('status',0)->get();
        $all_unit = Unit::where('status',0)->get();
        return view('admin.product.create', compact('all_category','all_brand','all_unit'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'    => 'required',
            'brand_id'       => 'required',
            'product_name'   => 'required|min:3',
            'price'          => 'required',
            'unit_id'        => 'required',
            'quantity'       => 'required',
            'alert_quantity' => 'required',
            'vat'            => 'required',
            'image'          => 'image|mimes:jpeg,png,jpg|max:1024'
        ]);

        $insert_row_id = Product::insertGetId([
            'category_id'    => $request->category_id,
            'brand_id'       => $request->brand_id,
            'product_name'   => $request->product_name,
            'price'          => $request->price,
            'unit_id'        => $request->unit_id,
            'quantity'       => $request->quantity,
            'alert_quantity' => $request->alert_quantity,
            'vat'            => $request->vat,
            'description'    => $request->description,
            'added_by'       => Auth::id(),
            'created_at'     => Carbon::now(),
        ]);

        $code_row = Product::find($insert_row_id);
        $code_row->product_code = strtoupper(substr($request->product_name, 0, 3)).$insert_row_id;
        $code_row->save();

        if(!empty($request->image)){
            $image_row = Product::find($insert_row_id);
            $image_row->image = Image::store("image","upload/product");
            $image_row->save();
        }

        if(isset($insert_row_id)){
            session()->flash('success', 'Product Created Successfully');
            return back();
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return back();
        }
    }

    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $all_category = Category::where('status',0)->get();
        $all_brand = Brand::where('status',0)->get();
        $all_unit = Unit::where('status',0)->get();
        return view('admin.product.edit', compact('product','all_category','all_brand','all_unit'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id'    => 'required',
            'brand_id'       => 'required',
            'product_name'   => 'required|min:3',
            'price'          => 'required',
            'unit_id'        => 'required',
            'quantity'       => 'required',
            'alert_quantity' => 'required',
            'vat'            => 'required',
            'image'          => 'image|mimes:jpeg,png,jpg|max:1024'
        ]);

        $product->category_id    = $request->category_id;
        $product->brand_id       = $request->brand_id;
        $product->product_name   = $request->product_name;
        $product->price          = $request->price;
        $product->unit_id        = $request->unit_id;
        $product->quantity       = $request->quantity;
        $product->alert_quantity = $request->alert_quantity;
        $product->vat            = $request->vat;
        $product->description    = $request->description;
        $product->status         = $request->status;
        $product->added_by       = Auth::id();
        $product->updated_at     = Carbon::now();
        $update_row = $product->save();

        if(!empty($request->image)){
            Image::delete($product->image);
            $product->image = Image::store("image","upload/category");
            $update_row = $product->save();
        }

        if(isset($update_row)){
            session()->flash('success', 'Product Updated Successfully');
            return back();
        }
        else{
            session()->flash('error', 'Somethin Went Wrong');
            return back();
        }
    }

    public function destroy(Product $product)
    {
        $requisitionCount = Requisition::whereIn('id', $product->requisitionProducts->pluck('requisition_id')->unique())->whereIn('status', [1,2,3])->count();
        if($requisitionCount){
            session()->flash('error', 'This product has processing requisition!!');
            return back();
        }
        else{
            Image::delete($product->image);
            $delete_row = $product->delete();
            if(isset($delete_row)){
                session()->flash('success', 'Product Deleted Successfully');
                return back();
            }
            else{
                session()->flash('error', 'Somethin Went Wrong');
                return back();
            }
        }
    }

    public function getProductPrice($productId){
        return response()->json(Product::where('id', $productId)->first()->price??'0');
    }
}
