<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;

class ApiController extends Controller
{
    public function login(Request $request){

        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
            $user = Auth::user();
            return response()->json(['user' => $user->makeVisible('api_token')], 201);
        }
        else{
            return response()->json(["message" => "Sorry!! Your email and password doesn't matched!!"], 201);
        }
        return response()->json(['message' => "Something went wrong!!"], 201);
    }

    public function passwordReset(Request $request){

        if(Hash::check($request->oldpassword, Auth::user()->password)){
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->newpassword);
            $user->save();
            return response()->json(['message' => "Your password has been changed successfully!"], 201);
        }
        else{
            return response()->json(['message' => "Your old password does not matched!!"], 201);
        }
    }

    function categoryWiseProduct(){

        // $fields = explode(',',$req->fields);
        // $fields = array_intersect($fields,array_keys(Product::first()->toArray()));
        // $fields = array_values(array_unique(array_merge($fields, ['id','category_id'])));
        // $limit  = $req->get('limit', 10);

        // $products = [];

        // foreach(Category::whereHas('products')->get() as $category) {
        //     $products[] = Category::where(['id' => $category->id])->with(['products' => function($query) use ($fields, $limit){
        //         $query->select($fields)->limit($limit);
        //     }])->first()->toArray();
        // }

        $products = Category::whereHas('products')->with('products')->get()->map(function($category){
            $category->image = \App\Lib\Image::url($category->image);
            return $category;
        });

        return response()->json(['categoryWithProduct' => $products], 201);
    }

    public function allCategory(){
        $all_category = Category::whereHas('products')->get()->map(function($category){
            $category->image = \App\Lib\Image::url($category->image);
            return $category;
        });
        return response()->json(['allCategory' => $all_category], 201);
    }

    public function allProductWithCategory(Request $request){
        $all_product_with_category = Product::where([['category_id', $request->cat_id],['status', 0]])->get();
        return response()->json(['productWithCategory' => $all_product_with_category], 201);
    }

    public function productDetails(Request $request){
        $product_details = Product::with(['category'])->where('id', $request->id)->first();
        return response()->json(['product' => $product_details], 201);
    }

    public function makeOrder(Request $request){
        $payable_amount = 0;
        foreach($request->orderProduct as $product){
            $payable_amount =$payable_amount + Product::where('id',$product['product_id'])->first()->price * $product['quantity'];
        }

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'payable_amount' => $payable_amount,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        foreach($request->orderProduct as $product){
            $total_price = Product::where('id',$product['product_id'])->first()->price * $product['quantity'];
            OrderProduct::insert([
                'order_id' => $order_id,
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'],
                'total_price' => $total_price,
                'added_by' => 0,
                'created_at' => Carbon::now(),
            ]);
        }

        if(isset($order_id)){
            return response()->json(['message' => "Your order has been complete successfully!"], 201);
        }
        else{
            return response()->json(['message' => "Something went wrong!!"], 201);
        }

    }

    public function viewAllOrder(){
        $all_order = Order::where('user_id', Auth::id())->orderBy('id', 'desc')->get()->map(function($order){
            if($order->status==1)
                $order->status = 'Pending';
            elseif($order->status==2)
                $order->status = 'Viewed';
            elseif($order->status==3)
                $order->status = 'Picking';
            elseif($order->status==4)
                $order->status = 'Delivered';
            else
                $order->status = 'Canceled';

            return $order;
        });
        return response()->json(['all_order' => $all_order], 201);
    }

    public function orderDetails(Request $request){
        $order_details = Order::with(['user','orderProduct.product:id,product_name,image,price'])->where('id', $request->order_id)->first();
        return response()->json(['order_details' => $order_details], 201);
    }

    public function hotProduct(){
        $hot_products = Product::whereHas('orderProducts')->withCount('orderProducts')->get()->sortByDesc('order_products_count')->map->makeHidden(['order_products_count'])->values();
        return response()->json(['hot_products' => $hot_products], 201);
    }
}
