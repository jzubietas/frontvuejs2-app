<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Responsability;
use App\Models\Continent;
use Auth;

class ResponsabilityController extends Controller
{
    public function index(){

        $responsabilities = DB::table('responsabilities')
                            ->select(DB::raw('responsabilities.*'))
                            ->get();

        $data = [
            'responsabilities' => $responsabilities,
        ];

        return view('responsability.index', ['data' => $data]);
    }

    public function createIndex(){
        //$categories = Category::all();

        return view('responsability.create',[/*'categories' => $categories*/]);
    }

    public function create(Request $request){
        if($request->file()) {
            $request->validate([
                'image' => 'mimes:jpg,jpeg,png,jfif|max:2048',
            ]);

            $responsability = new Project();
            $responsability->name = $request->name;
            //$product->brand = $request->brand;
            $responsability->description = $request->description;
            //$product->stock = $request->stock;
            //$product->price = $request->price;
            $responsability->image = '';
            //$product->category_id = $request->category_id;

            $responsability->continent_id = $request->continent_id;
            $responsability->country_id = $request->country_id;
            $responsability->sector_id = $request->sector_id;
            $responsability->sector_type_id = $request->sector_type_id;

            //$responsability->seller_id = Auth::user()->seller->id;
            $responsability->save();

            $file_name = $responsability->id.'.'.$request->file('image')->extension();
            $file_path = $request->file('image')->storeAs('img/responsabilities', $file_name, 'public');


            $responsability->image = "/storage/".$file_path;
            $responsability->save();

            return $responsability;
        }
    }

    public function update(Request $request){
        $responsability = Responsability::find($request->id);
        $responsability->name = $request->name;
        //$responsability->brand = $request->brand;
        $responsability->description = $request->description;
        //$responsability->stock = $request->stock;
        //$responsability->price = $request->price;

        if($request->file()) {
            $request->validate([
                'image' => 'mimes:jpg,jpeg,png,jfif|max:2048',
            ]);

            $file_name = $responsability->id.'.'.$request->file('image')->extension();
            $file_path = $request->file('image')->storeAs('img/responsabilities', $file_name, 'public');

            $responsability->image = "/storage/".$file_path;

        }
        $responsability->save();
        return $responsability;
    }

    public function destroy(Request $request){
        $requests = Responsability::destroy($request->project_id);
        return 'Successfully Deleted';
    }

    public function map(){

        $maps = DB::table('responsabilities')
                            ->select(DB::raw('responsabilities.*'))
                            ->get();

        $data = [
            'map' => $maps,
        ];

        return view('map.index', ['data' => $data]);
    }

    public function recent_orders() {
        $projects = Project::get();
        return response()->json($projects);
    }
}
