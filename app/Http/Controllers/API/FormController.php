<?php

namespace App\Http\Controllers\API;

use App\Models\Dinosaur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormController extends Controller
{
    public function index() {

        $user_id = auth()->user()->id; 
        // dd($user_id);

        $data = Dinosaur::where('user_id', $user_id)->get();
        // dd($data);

         return response()->json([
                'message'=>'Success! Ini adalah halaman index',
                'data'=> $data
         ], 200);
    }

    public function retrieve($id) {

        // $user_id = auth()->user()->id; 
        // dd($user_id);

        $data = Dinosaur::find($id);
        // dd($data);

         return response()->json([
                'message'=>'Success! Ini adalah halaman index',
                'data'=> $data
         ], 200);
    }

    public function create(Request $request) {
        $request->validate([
            'name' => 'required',
            'living_era' => 'required',
            'type_of_eat' => 'required',
            'best_known' => 'required'
        ]);

        // dd($request->all());

        $model = new Dinosaur();

        $model->user_id = auth()->user()->id;
        $model->name = $request->name;
        $model->living_era = $request->living_era;
        $model->type_of_eat = $request->type_of_eat;
        $model->best_known = $request->best_known;
        $model->save();

        return response()->json([
                'message'=>'Success! Data berhasil dibuat',
         ], 200);
    }

    public function update(Request $request, $id) {
        $model = Dinosaur::find($id);

        $request->validate([
            'name' => 'required',
            'living_era' => 'required',
            'type_of_eat' => 'required',
            'best_known' => 'required'
        ]);

        // $model::update([
        $model->name = $request->name;
        $model->living_era = $request->living_era;
        $model->type_of_eat = $request->type_of_eat;
        $model->best_known = $request->best_known;
        // ]);
        $model->save();

        return response()->json([
                'message'=>'Success! Data berhasil diubah',
         ], 200);
    }

    public function destroy($id){
        $model = Dinosaur::find($id);
        $model->delete();

        return response()->json([
                'message'=>'Success! Data berhasil dihapus',
         ], 200);
    }
}
