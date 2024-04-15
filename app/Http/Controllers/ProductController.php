<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Category;
use App\Models\Country;
use App\Models\Age;
use App\Requests\StoreProductRequest;
use App\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //show all products
    public function index(Request $request)
    {
        //search
        $search = "";
        if (isset($request->search)) {
            $search = $request->search;
        }
        //filter
        $price_1 = 0;
        $price_2 = 9999;
        if ($request->price_1 != null) {
            $price_1 = $request->price_1;
        }
        if ($request->price_2 != null) {
            $price_2 = $request->price_2;
        }
        if ($price_1 > $price_2) {
            $bigger = $price_1;
            $price_1 = $price_2;
            $price_2 = $bigger;
        }

        $brand = Brand::all('id')->toArray();
        if (isset($request->brand)) {
            $brand = $request->brand;
        }

        $category = Category::all('id')->toArray();
        if (isset($request->category)) {
            $category = $request->category;
        }

        $age = Age::all('id')->toArray();
        if (isset($request->age)) {
            $age = $request->age;
        }

        $country = Country::all('id')->toArray();
        if (isset($request->country)) {
            $country = $request->country;
        }

        //sorting
        $sorting = 'default';
        if (isset($request->sorting)) {
            $sorting = $request->sorting;
        }
        $orderBy = "id";
        $orderDirection = "asc";
        switch ($sorting) {
            case 'newest':
                $orderDirection = "desc";
                break;
            case 'bestseller':
                //bestseller de lai khi nao lam xong order tinh sau
                break;
            case 'low_to_high':
                $orderBy = "price";
                break;
            case 'high_to_low':
                $orderBy = "price";
                $orderDirection = "desc";
                break;
        }

        $products = Product::with('age')
            ->whereBetween('price', [$price_1, $price_2])
            ->whereIn('brand_id', $brand)
            ->whereIn('category_id', $category)
            ->whereIn('age_id', $age)
            ->whereIn('country_id', $country)
            ->where('product_name', 'like', '%' . $search . '%')
            ->orderBy($orderBy, $orderDirection)
            ->paginate(6)
            ->withQueryString();

        $categories = Category::all();
        $brands = Brand::all();
        $countries = Country::all();
        $ages = Age::all();

        return view('customers.products.index', [
            'products' => $products,
            'brands' => $brands,
            'categories' => $categories,
            'countries' => $countries,
            'ages' => $ages,
            'search' => $search,
            'sorting' => $sorting,
            'f_price_1' => $price_1,
            'f_price_2' => $price_2,
            'f_brand' => $brand,
            'f_category' => $category,
            'f_country' => $country,
            'f_age' => $age
        ]);
    }

    public function show(int $id)
    {
        $product = Product::with('brand')
            ->with('category')
            ->with('age')
            ->with('country')
            ->where('id', $id)
            ->first();

        return view('customers.products.show', [
            'product' => $product
        ]);
    }

    public function cart()
    {
        return view('customers.carts.cart');
    }

    public function addToCart(int $id)
    {
        $product = Product::with('brand')
            ->with('category')
            ->with('age')
            ->with('country')
            ->where('id', $id)
            ->first();

//        neu da co cart
        if (Session::exists('cart')) {
//            lay cart hien tai
            $cart = Session::get('cart');
//            neu san pham da co trong cart => +1 so luong
            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity']++;
            } else {
//                them sp vao cart
                $cart = Arr::add($cart, $product->id, [
                    'image' => $product->image,
                    'product_name' => $product->product_name,
                    'price' => $product->price,
                    'quantity' => 1,
                ]);
            }
        } else {
//            tao cart moi
            $cart = array();
            $cart = Arr::add($cart, $product->id, [
                'image' => $product->image,
                'product_name' => $product->product_name,
                'price' => $product->price,
                'quantity' => 1,
            ]);
        }
//        nem cart len session
        Session::put(['cart' => $cart]);

        return Redirect::route('product.cart');
    }

    public function addToCartAjax(int $id)
    {
        if (!Auth::guard('customer')->check()) {
            return Redirect::route('customer.login');
        } else {
            $product = Product::with('brand')
                ->with('category')
                ->with('age')
                ->with('country')
                ->where('id', $id)
                ->first();

//        neu da co cart
            if (Session::exists('cart')) {
//            lay cart hien tai
                $cart = Session::get('cart');
//            neu san pham da co trong cart => +1 so luong
                if (isset($cart[$product->id])) {
                    $cart[$product->id]['quantity']++;
                } else {
//                them sp vao cart
                    $cart = Arr::add($cart, $product->id, [
                        'image' => $product->image,
                        'product_name' => $product->product_name,
                        'price' => $product->price,
                        'quantity' => 1,
                    ]);
                }
            } else {
//            tao cart moi
                $cart = array();
                $cart = Arr::add($cart, $product->id, [
                    'image' => $product->image,
                    'product_name' => $product->product_name,
                    'price' => $product->price,
                    'quantity' => 1,
                ]);
            }
//        nem cart len session
            Session::put(['cart' => $cart]);

            return Redirect::route('product.cart');
        }
    }

    public function updateCartQuantity(int $id, Request $request)
    {
        //        lay cart hien tai
        $cart = Session::get('cart');
//        cap nhat so luong
        $cart[$id]['quantity'] = $request->buy_quantity;
        //        cap nhat cart moi
        Session::put(['cart' => $cart]);
        return Redirect::back();
    }

    public function deleteFromCart(Request $request)
    {
//        lay cart hien tai
        $cart = Session::get('cart');
//        xoa id cua product can xoa
        Arr::pull($cart, $request->id);
//        cap nhat cart moi
        Session::put(['cart' => $cart]);

        return Redirect::back();
    }

    public function deleteAllFromCart()
    {
//       xoa cart
        Session::forget('cart');

        return Redirect::back();
    }

    public function checkout()
    {
        $customer_id = Auth::guard('customer')->id();
        $customer = Customer::find($customer_id);
        return view('customers.carts.checkout', [
            'customer' => $customer
        ]);
    }
//    ADMIN
    public function show2(Request $request)
    {
        $products = Product::with('brand');
        if (!empty($request->get('keyword'))){
            $products = $products->where('product_name', 'like', '%'.$request->get('keyword').'%');
        }
        $products = $products->paginate(6);
        return view("admins.product_manager.index", [
            "products" => $products
        ]);
    }

    public function showDetail(Product $product)
    {
        $brand = Brand::where('id', '=', $product->brand_id)->first();

        return view('admins.product_manager.product-detail', [
            'product' => $product,
            'brand' => $brand,

        ]);
    }

    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $ages = Age::all();
        $countries = Country::all();
        return view('admins.product_manager.create', [
            'brands' => $brands,
            'categories' => $categories,
            'ages' => $ages,
            'countries' => $countries
        ]);

    }

    public function store(StoreProductRequest $request)
    {
        if($request->validated()){
//            $image_name = $request->file('image')->getClientOriginalName();
            if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'images/products/';
            $file->move($path, $filename);
            }
            $array = [];
            $array = Arr::add($array, 'product_name', $request->product_name);
            $array = Arr::add($array, 'price', $request->price);
            $array = Arr::add($array, 'description', $request->description);
            $array = Arr::add($array, 'quantity', $request->quantity);
            $array = Arr::add($array, 'brand_id', $request->brand_id);
            $array = Arr::add($array, 'age_id', $request->age_id);
            $array = Arr::add($array, 'category_id', $request->category_id);
            $array = Arr::add($array, 'country_id', $request->country_id);
            $array = Arr::add($array, 'image', $path . $filename);
            //Lấy dữ liệu từ form và lưu lên db
            Product::create($array);
            //Hiển thị thông báo thêm không thành công (error)

            //Quay lại danh sá ch
            return Redirect::route('admin.product')->with('success', 'Add a product successfully!');
        } else {
            return Redirect::back()->with('unsuccessfully', 'Add a product unsuccessfully!');
        }
    }

    public function edit(Product $product)
    {
        $brands = Brand::all();
        $categories = Category::all();
        $ages = Age::all();
        $countries = Country::all();
        return view('admins.product_manager.edit', [
            'product' => $product,
            'brands' => $brands,
            'categories' => $categories,
            'ages' => $ages,
            'countries' => $countries
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        //Lấy dữ liệu trong form và update lên db
        $array = [];
        $array = Arr::add($array, 'product_name', $request->product_name);
        $array = Arr::add($array, 'price', $request->price);
        $array = Arr::add($array, 'description', $request->description);
        $array = Arr::add($array, 'quantity', $request->quantity);
        $array = Arr::add($array, 'brand_id', $request->brand_id);
        $array = Arr::add($array, 'age_id', $request->age_id);
        $array = Arr::add($array, 'category_id', $request->category_id);
        $array = Arr::add($array, 'country_id', $request->country_id);
        //Kiểm tra nếu file chưa tồn tại thì lưu vào trong folder code
        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'images/products/';
            $file->move($path, $filename);
            if (file_exists($product->image)) {
                unlink($product->image);
            }
            $array = Arr::add($array, 'image', $path. $filename);
        }
        $product->update($array);
        //Quay về danh sách
        return Redirect::route('admin.product')->with('success', 'Edit a product successfully!');
    }

    public function destroy(Product $product)
    {
        //Xóa bản ghi được chọn
        $product->delete();
        //Quay về danh sách
        return Redirect::route('admin.product')->with('success', 'Delete a product successfully!');
    }
}
