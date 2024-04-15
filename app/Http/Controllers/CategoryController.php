<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Requests\CategoryFormRequest;
use App\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request, Category $categories){

        if (!empty($request->get('keyword'))){
            $categories = $categories->where('category_name', 'like', '%'.$request->get('keyword').'%');
        }
        $categories = $categories->paginate(6);
        return view('admins.category_manager.index', [
            "categories" => $categories
        ]);
    }

    public function showDetail(Category $category)
    {
//        $category = Category::where('id', '=', $category->category_id)->first();
//        $category = Category::all();
//        $age = Age::all();
//        $country = Country::all();
        return view('admins.category_manager.category-detail', [
            'category' => $category,
//            'category' => $category,
//            'age' => $age,
//            'country' => $country
        ]);
    }

    public function create()
    {
        return view('admins.category_manager.create');
    }

    public function store(CategoryFormRequest $request)
    {
        if($request->validated()){
//            $image_name = $request->file('image')->getClientOriginalName();
            if ($request->has('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = 'images/categories/';
                $file->move($path, $filename);
            }
            $array = [];
            $array = Arr::add($array, 'category_name', $request->category_name);
            $array = Arr::add($array, 'description', $request->description);
            $array = Arr::add($array, 'image', $path . $filename);
            //Lấy dữ liệu từ form và lưu lên db
            Category::create($array);

            //Quay lại danh sá ch
            return Redirect::route('category.index')->with('success', 'Add a category successfully!');
        } else {
            return Redirect::back()->with('unsuccessfully', 'Add a category unsuccessfully!');
        }
    }

    public function edit(Category $category)
    {
        return view('admins.category_manager.edit', [
            "category" => $category
        ]);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //Lấy dữ liệu trong form và update lên db
        $array = [];
        $array = Arr::add($array, 'category_name', $request->category_name);
        $array = Arr::add($array, 'description', $request->description);

        //Kiểm tra nếu file chưa tồn tại thì lưu vào trong folder code
        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'images/categories/';
            $file->move($path, $filename);
            if (file_exists($category->image)) {
                unlink($category->image);
            }
            $array = Arr::add($array, 'image', $path. $filename);
        }
        $category->update($array);
        //Quay về danh sách
        return Redirect::route('category.index')->with('success', 'Edit a category successfully!');
    }

    public function destroy(Category $category)
    {
        //Xóa bản ghi được chọn
        $category->delete();
        //Quay về danh sách
        return Redirect::route('category.index')->with('success', 'Delete a category successfully!');
    }
}
