<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Requests\CountryFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CountryController extends Controller
{
    public function index(Request $request, Country $countries){
        if (!empty($request->get('keyword'))){
            $countries = $countries->where('country_name', 'like', '%'.$request->get('keyword').'%');
        }
        $countries = $countries->paginate(6);
        return view('admins.country_manager.index', [
            "countries" => $countries
        ]);
    }
    public function create()
    {
        return view('admins.country_manager.create');
    }

    public function store(CountryFormRequest $request)
    {
        Country::create($request->all());
        return Redirect::route('country.index')->with('success', 'Add a country successfully!');

    }

    public function edit(Country $country)
    {
        return view('admins.country_manager.edit', [
            "country" => $country
        ]);
    }

    public function update(CountryFormRequest $request, Country $country)
    {
        //Lấy dữ liệu trong form và update lên db
        $country->update($request->all());
        return Redirect::route('country.index')->with('success', 'Edit a country successfully!');
    }

//    public $delete_id;
//
//    public function deleteEmp()
//    {
//        $country = Country::where('id', $this->delete_id)->first();
//        $country->delete();
//        $this->dispatchBrowserEvent('hide:delete-modal');
//        return Redirect::route('country.index')->with('success', 'Delete a country successfully!');
//    }

    public function destroy(Country $country)
    {
        //Xóa bản ghi được chọn
        $country->delete();
        //Quay về danh sách
        return Redirect::route('country.index')->with('success', 'Delete a country successfully!');
    }
}
