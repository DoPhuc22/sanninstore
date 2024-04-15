<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Requests\BrandFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
    public function index(Request $request , Brand $brands){
        if (!empty($request->get('keyword'))){
            $brands = $brands->where('brand_name', 'like', '%'.$request->get('keyword').'%');
        }
        $brands = $brands->paginate(6);
        return view('admins.brand_manager.index', [
            "brands" => $brands
        ]);
    }
    public function create()
    {
        return view('admins.brand_manager.create');
    }

    public function store(BrandFormRequest $request)
    {

        Brand::create($request->all());

            return Redirect::route('brand.index')->with('success', 'Add a brand successfully!');
    }

    public function edit(Brand $brand)
    {
        return view('admins.brand_manager.edit', [
            "brand" => $brand
        ]);
    }

    public function update(BrandFormRequest $request, Brand $brand)
    {
        $brand->update($request->all());
        return Redirect::route('brand.index')->with('success', 'Edit a brand successfully!');
    }

    public function destroy(Brand $brand)
    {
        //Xóa bản ghi được chọn
        $brand->delete();
        //Quay về danh sách
        return Redirect::route('brand.index')->with('success', 'Delete a brand successfully!');
    }
}
