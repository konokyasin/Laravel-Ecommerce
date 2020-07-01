<?php

namespace App\Http\Controllers;

use App\Category;
use App\Coupons;
use App\Products;
use App\Country;
use App\DeliveryAddress;
use App\Orders;
use App\OrdersProduct;
use App\User;
use App\ProductsAttributes;
use App\ProductsImages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProductsController extends Controller
{
    //add product
    public function addProduct()
    {
        //category dropdown
        $categories = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option value='' selected disabled>Select</option>";
        foreach ($categories as $cat) {
            $categories_dropdown .= "<option value='" . $cat->id . "'>" . $cat->name . "</option>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                $categories_dropdown .= "<option value='" . $sub_cat->id . "'>&nbsp;--&nbsp;" . $sub_cat->name . "</option>";
            }
        }
        return view('admin.products.add_product', compact('categories_dropdown'));
    }

    //store product
    public function storeProduct(Request $request)
    {

        $data = $request->all();

        $product = new Products();
        $product->category_id = $data['category_id'];
        $product->name = $data['product_name'];
        $product->code = $data['product_code'];
        $product->color = $data['product_color'];
        if (!empty($data['product_description'])) {
            $product->description = $data['product_description'];
        } else {
            $product->description = '';
        }
        $product->price = $data['product_price'];

        //upload image
        if ($request->hasFile('image')) {
            echo $img_tmp = Input::file('image');
            //image path
            $extension = $img_tmp->getClientOriginalExtension();
            $filename = rand(111, 9999) . '.' . $extension;
            $img_path = 'uploads/product/' . $filename;

            //image resize
            Image::make($img_tmp)->resize(500, 500)->save($img_path);
            $product->image = $filename;
        }

        $product->save();
        session()->flash('working', 'Product has been added successfully');
        return redirect('/admin/view-products');
    }

    public function viewProducts()
    {
        $products = Products::all();
        return view('admin.products.view_products', compact('products'));
    }

    public function editProduct($id = null)
    {
        $productDetails = Products::where(['id' => $id])->first();
        //category dropdown code
        $categories = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option value='' selected disabled>Select</option>";
        foreach ($categories as $cat) {
                if ($cat->id == $productDetails->category_id) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                $categories_dropdown .= "<option value='" . $cat->id . "' " . $selected . ">" . $cat->name . "</option>";
            
            //sub category code
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                if ($cat->id == $productDetails->category_id) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                $categories_dropdown .= "<option value='" . $sub_cat->id . "' " . $selected . ">&nbsp;--&nbsp;" . $sub_cat->name . "</option>";
            }
        }
        return view('admin.products.edit_product', compact('productDetails', 'categories_dropdown'));
    }

    public function updateProduct(Request $request, $id = null)
    {
        $data = $request->all();
        //upload image
        if ($request->hasFile('image')) {
            echo $img_tmp = Input::file('image');
            //image path
            $extension = $img_tmp->getClientOriginalExtension();
            $filename = rand(111, 9999) . '.' . $extension;
            $img_path = 'uploads/product/' . $filename;

            //image resize
            Image::make($img_tmp)->resize(500, 500)->save($img_path);
        } else {
            $filename = $data['current_image'];
        }
        if (empty($data['product_description'])) {
            $data['product_description'] = '';
        }
        Products::where(['id' => $id])->update([
            'name' => $data['product_name'], 'category_id' => $data['category_id'], 'code' => $data['product_code'],
            'color' => $data['product_color'], 'description' => $data['product_description'],
            'price' => $data['product_price'], 'image' => $filename
        ]);

        return redirect('/admin/view-products')->with('working', 'Product Updated Successfully!!');
    }

    public function deleteProduct($id = null)
    {
        Products::where(['id' => $id])->delete();
        Alert::success('Deleted Successfully', 'Product Deleted!!');
        return redirect()->back();
    }

    public function updateStatus(Request $request)
    {
        $data = $request->all();
        Products::where('id', $data['id'])->update(['status'=>$data['status']]);
    }

    public function products($id=null)
    {
        $productDetails = Products::with('attributes')->where('id', $id)->first();
        $productAltImages = ProductsImages::where('product_id', $id)->get();
        $featuredProducts = Products::where(['featured_products'=>1])->get();
        return view('wayshop.product_details', compact('productDetails', 'productAltImages', 'featuredProducts'));
    }

    public function addAttribute($id=null)
    {
        $productDetails = Products::with('attributes')->where(['id'=>$id])->first();
        return view('admin.products.add_attribute', compact('productDetails'));
    }

    public function storeAttribute(Request $request,$id = null)
    {
        $data = $request->all();
        foreach($data['sku'] as $key=> $val)
        {
            if(!empty($val))
            {
                $attrCountSKU = ProductsAttributes::where('sku', $val)->count();
                //prevent duplicate sku
                if($attrCountSKU > 0) {
                    return redirect('/admin/add-attributes/'.$id)->with('error', 'SKU is already exist, please select another SKU!!');
                }

                $attrCountSizes = ProductsAttributes::where(['product_id'=>$id, 'size'=>$data['size'][$key]])->count();
                //prevent duplicate size
                if ($attrCountSizes > 0) {
                    return redirect('/admin/add-attributes/' . $id)->with('error', ''.$data['size'][$key]. 'Size already exist, please select another size!!');
                }

                $attribute = new ProductsAttributes;
                $attribute->product_id = $id;
                $attribute->sku = $val;
                $attribute->size = $data['size'][$key];
                $attribute->price = $data['price'][$key];
                $attribute->stock = $data['stock'][$key];
                $attribute->save();
            }          
        }
        return redirect('/admin/add-attributes/' . $id)->with('working', 'Product attributes added Successfully!!');
    }

    public function deleteAttribute($id=null)
    {
        ProductsAttributes::where(['id'=>$id])->delete();
        return redirect()->back()->with('error', 'Product attributes Deleted Successfully!!');
    }

    public function updateAttribute(Request $request, $id=null)
    {
        $data = $request->all();

        foreach($data['attr'] as $key=>$attr)
        {
            ProductsAttributes::where(['id'=>$data['attr'][$key]])->update(['sku'=>$data['sku'][$key], 'size'=>$data['size'][$key], 'price'=>$data['price'][$key], 'stock'=>$data['stock'][$key]]);
        }
        return redirect()->back()->with('working', 'Product attributes Updated Successfully!!');
    }

    public function addImages($id=null)
    {
        $productDetails = Products::where(['id'=>$id])->first();
        $productImages = ProductsImages::where(['product_id'=>$id])->get();
        return view('admin.products.add_images', compact('productDetails', 'productImages'));
    }

    public function storeImages(Request $request,$id = null)
    {
       $data = $request->all();

       if($request->hasFile('image'))
       {
           $files = $request->file('image');

           foreach($files as $file){
                $image = new ProductsImages;
                $extension = $file->getClientOriginalExtension();
                $filename = rand(111, 99999) . '.' . $extension;
                $img_path = 'uploads/product/'.$filename;
                Image::make($file)->save($img_path);
                $image->image = $filename;
                $image->product_id = $data['product_id'];
                $image->save();
           }
       }
       return redirect('/admin/add-images/'.$id)->with('working', 'Products Attributes Image Added Successfully!!');
    }

    public function deleteAltImage($id=null)
    {
        $productImage = ProductsImages::where(['id'=>$id])->first();
        $img_path = 'uploads/product/';
        if(file_exists($img_path.$productImage->image))
        {
            unlink($img_path. $productImage->image);
        }
        ProductsImages::where(['id'=>$id])->delete();
        Alert::success('Deleted Successfully', 'Product Alt Image Deleted!!');
        return redirect()->back();
    }

    public function updateFeatured(Request $request)
    {
        $data = $request->all();
        Products::where('id', $data['id'])->update(['featured_products' => $data['status']]);
    }

    public function getPrice(Request $request)
    {
        $data = $request->all();
        $proArr = explode('-', $data['idSize']);
        $proAttr = ProductsAttributes::where(['product_id'=>$proArr[0], 'size'=>$proArr[1]])->first();
        echo $proAttr->price;
    }

    public function storeCart(Request $request)
    {
        Session::forget('couponAmount');
        Session::forget('couponCode');
        $data = $request->all();
        if (empty(Auth::user()->email)) {
            $data['user_email'] = '';
        } else {
            $data['user_email'] = Auth::user()->email;
        }

        $session_id = Session::get('session_id');
        if(empty($session_id)){
            $session_id = Str::random(40);
            Session::put('session_id', $session_id); 
        }

        $sizeArr = explode('-', $data['size']);

        $countProducts = DB::table('cart')->where([
            'product_id' => $data['product_id'],
            'product_code' => $data['product_code'], 'product_color' => $data['color'],
            'price' => $data['price'],'size' => $sizeArr[1],'session_id' => $session_id
        ])->count();

        if($countProducts>0)
        {
            return redirect()->back()->with('error', 'Product already exists in cart!!!');
        }else{
            DB::table('cart')->insert([
                'product_id' => $data['product_id'], 'product_name' => $data['product_name'],
                'product_code' => $data['product_code'], 'product_color' => $data['color'], 'price' => $data['price'],
                'size' => $sizeArr[1], 'quantity' => $data['quantity'], 'user_email' => $data['user_email'],
                'session_id' => $session_id
            ]);
        }
        return redirect('/cart')->with('working', 'Product has been added to the cart!!');
        
    }

    public function cart()
    {
        if (Auth::check()) {
            $user_email = Auth::user()->email;
            $userCart = DB::table('cart')->where(['user_email' => $user_email])->get();
        } else {
            $session_id = Session::get('session_id');
            $userCart = DB::table('cart')->where(['session_id' => $session_id])->get();
        }
        foreach ($userCart as $key => $products) {
            $productDetails = Products::where(['id' => $products->product_id])->first();
            $userCart[$key]->image = $productDetails->image;
        }
        return view('wayshop.products.cart', compact('userCart'));
    }

    public function deleteCartProduct($id=null)
    {
        Session::forget('couponAmount');
        Session::forget('couponCode');
        DB::table('cart')->where('id', $id)->delete();

        return redirect()->back()->with('error', 'Product deleted from cart!!');

    }

    public function updateCartQuantity($id=null, $quantity=null)
    {
        Session::forget('couponAmount');
        Session::forget('couponCode');
        DB::table('cart')->where('id', $id)->increment('quantity', $quantity);
        return redirect()->back()->with('working', 'Product quantity has been updated!!');
    }

    public function applyCoupon(Request $request)
    {
        Session::forget('couponAmount');
        Session::forget('couponCode');
        $data = $request->all();
        $couponCount = Coupons::where('coupon_code', $data['coupon_code'])->count();
        if($couponCount == 0){
            return redirect()->back()->with('error', 'This coupon code does not exists!!!');
        }else{
            $couponDetails = Coupons::where('coupon_code', $data['coupon_code'])->first();
            //check coupon status
            if($couponDetails->status == 0){
                return redirect()->back()->with('error', 'This coupon code is not active anymore!!!');
            }
            //check coupon expire date
            $expire_date = $couponDetails->expire_date;
            $current_date = date('Y-m-d');
            if($expire_date < $current_date){
                return redirect()->back()->with('error', 'This coupon code is expired!!!');
            }
            //coupon for discount
            $session_id = Session::get('session_id');
            //$userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
            if (Auth::check()) {
                $user_email = Auth::user()->email;
                $userCart = DB::table('cart')->where(['user_email' => $user_email])->get();
            } else {
                $session_id = Session::get('session_id');
                $userCart = DB::table('cart')->where(['session_id' => $session_id])->get();
            }
            $total_amount = 0;

            foreach($userCart as $item){
                $total_amount = $total_amount + ($item->price*$item->quantity);
            }
            //check coupon amount is fixed or perccentage discount
            if($couponDetails->amount_type == "Fixed"){
                $couponAmount = $couponDetails->coupon_amount;
            }else{
                $couponAmount = $total_amount * ($couponDetails->coupon_amount/100);
            }

            //add coupon code in session
            Session::put('couponAmount', $couponAmount);
            Session::put('couponCode', $data['coupon_code']);
            return redirect()->back()->with('working', 'Coupon code applied successfully.You can avail discount now!!!');
        }
        
    }

    public function checkout()
    {
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::find($user_id);
        $countries = Country::all();
        $shippingDetails = DeliveryAddress::where('user_id', $user_id)->first();
        //Update Cart Table With Email 
        // $session_id = Session::get('session_id');
        // DB::table('cart')->where(['session_id' => $session_id])->update(['user_email' => $user_email]);
        return view('wayshop.products.checkout', compact('userDetails', 'countries', 'shippingDetails'));
    }

    public function storeCheckout(Request $request)
    {
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        //check shipping details exist
        $shippingCount = DeliveryAddress::where('user_id', $user_id)->count();
        $shippingDetails = array();
        if($shippingCount > 0)
        {
            $shippingDetails = DeliveryAddress::where('user_id', $user_id)->first();
        }
        
        $data = $request->all();
        //Update Users Details 
        User::where('id', $user_id)->update([
            'name' => $data['billing_name'], 'address' => $data['billing_address'],
            'city' => $data['billing_city'], 'state' => $data['billing_state'], 'pincode' => $data['billing_pincode'],
            'country' => $data['billing_country'], 'mobile' => $data['billing_mobile']
        ]);

        if ($shippingCount > 0) {
            //update Shipping Address
            DeliveryAddress::where('user_id', $user_id)->update([
                'name' => $data['shipping_name'], 'address' => $data['shipping_address'],
                'city' => $data['shipping_city'], 'state' => $data['shipping_state'], 'pincode' => $data['shipping_pincode'],
                'country' => $data['shipping_country'], 'mobile' => $data['shipping_mobile']
            ]);
        } else {
            //New Shipping Address
            $shipping = new DeliveryAddress;
            $shipping->user_id = $user_id;
            $shipping->user_email = $user_email;
            $shipping->name = $data['shipping_name'];
            $shipping->address = $data['shipping_address'];
            $shipping->city = $data['shipping_city'];
            $shipping->state = $data['shipping_state'];
            $shipping->country = $data['shipping_country'];
            $shipping->pincode = $data['shipping_pincode'];
            $shipping->mobile = $data['shipping_mobile'];
            $shipping->save();
        }
        return redirect('/order-review');

    }

    public function orderReview()
    {
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $shippingDetails = DeliveryAddress::where('user_id', $user_id)->first();
        $userDetails = User::find($user_id);
        $userCart = DB::table('cart')->where(['user_email' => $user_email])->get();
        foreach ($userCart as $key => $product) {
            $productDetails = Products::where('id', $product->product_id)->first();
            $userCart[$key]->image = $productDetails->image;
        }
        return view('wayshop.products.order_review')->with(compact('userDetails', 'shippingDetails', 'userCart'));
    }

    public function placeOrder(Request $request)
    {
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;

        $data = $request->all();
        $shippingDetails = DeliveryAddress:: where(['user_email' => $user_email])->first();
        //echo "<pre>"; print_r($data);
        if(empty(Session::get('couponCode')))
        {
            $coupon_code = 'Not Used';
        }else{
            $coupon_code = Session::get('couponCode');
        }
        if (empty(Session::get('couponAmount'))) {
            $coupon_amount = '0';
        }else{
            $coupon_amount = Session::get('couponAmount');
        }
        $order = new Orders;
        $order->user_id = $user_id;
        $order->user_email = $user_email;
        $order->name = $shippingDetails->name;
        $order->address = $shippingDetails->address;
        $order->city = $shippingDetails->city;
        $order->state = $shippingDetails->state;
        $order->pincode = $shippingDetails->pincode;
        $order->country = $shippingDetails->country;
        $order->mobile = $shippingDetails->mobile;
        $order->coupon_code = $coupon_code;
        $order->coupon_amount = $coupon_amount;
        $order->order_status = "New";
        $order->payment_method = $data['payment_method'];
        $order->grand_total = $data['grand_total'];
        $order->save();

        $order_id = DB::getPdo()->lastinsertID();
        $cartProducts = DB::table('cart')->where(['user_email' => $user_email])->get();

        foreach($cartProducts as $cartProduct){
            $cartPro = new OrdersProduct;
            $cartPro->order_id = $order_id;
            $cartPro->user_id = $user_id;
            $cartPro->product_id = $cartProduct->product_id;
            $cartPro->product_code = $cartProduct->product_code;
            $cartPro->product_name = $cartProduct->product_name;
            $cartPro->product_color = $cartProduct->product_color;
            $cartPro->product_size = $cartProduct->size;
            $cartPro->product_price = $cartProduct->price;
            $cartPro->product_qty = $cartProduct->quantity;
            $cartPro->save();
        }   

        Session::put('order_id', $order_id);
        Session::put('grand_total', $data['grand_total']);
        if($data['payment_method'] == "cod"){
        return redirect('/thanks-message');
        }else{
            return redirect('/stripe');
        }
    }

    public function thanks()
    {
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email', $user_email)->delete();
        return view('wayshop.orders.thanks');
    }

    public function stripe()
    {
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email', $user_email)->delete();
        return view('wayshop.orders.stripe');
    }

    public function stripePayment(Request $request)
    {
        $data = $request->all();
        \Stripe\Stripe::setApiKey('sk_test_51GwiB4DahCR9TFgp07Pndx2nAwE3PccPOhBzTZmUx4qQi9CxNhVjkXsUf9tJdNnZ5TEdYH7hqyaeYjA0ESzfGrcD00WA2tgXHz');

        $token = $_POST['stripeToken'];
        $charge = \Stripe\charge::Create([
            'amount' => $request->input('total_amount'),
            'currency' => 'usd',
            'description' => $request->input('name'),
            'source' => $token,
        ]);
        //dd($charge);
        return redirect()->back()->with('working', 'Your Payment Done Successfully!!!');
    }

    public function userOrders()
    {
        $user_id = Auth::user()->id;
        $orders = Orders::with('orders')->where('user_id', $user_id)->orderBy('id', 'DESC')->get();
        return view('wayshop.orders.user_orders', compact('orders'));
    }

    public function userOrderDetails($order_id)
    {
        $orderDetails = Orders::with('orders')->where('id', $order_id)->first();
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id', $user_id)->first();
        return view('wayshop.orders.user_order_details', compact('orderDetails', 'userDetails'));
    }

    public function viewOrders()
    {
        $orders = Orders::with('orders')->orderBy('id', 'DESC')->get();
        return view('admin.orders.view_orders', compact('orders'));
    }

    public function viewOrderDetails($order_id)
    {
        $orderDetails = Orders::with('orders')->where('id', $order_id)->first();
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id', $user_id)->first();
        return view('admin.orders.order_details', compact('orderDetails', 'userDetails'));
    }

    public function updateOrderStatus(Request $request)
    {
        $data = $request->all();
        Orders::where('id', $data['order_id'])->update(['order_status'=>$data['order_status']]);
        return redirect()->back()->with('working', 'Order Status Updated Successfully!!');
    }
}
