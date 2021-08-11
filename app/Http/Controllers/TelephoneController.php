<?php

namespace App\Http\Controllers;

use App\Models\telephone;
use Illuminate\Http\Request;

class TelephoneController extends Controller
{
    public function index(){
        return telephone::all();
    }

    public function store(Request $request){
        $request->validate([
            'name'=>['required'],
            'telephone'=>['required']
        ]);
        
        telephone::create([
            'name'=> $request->name,
            'phone' => $request->telephone
        ]);

        return  telephone::create([
            'name'=> $request->name,
            'phone' => $request->telephone
        ])->fresh();


    }

    public function show(telephone $telephone){

        return $telephone;

    }

    public function update(Request $request,telephone $telephone){
        $request->validate([
            'name'=>['required'],
            'telephone'=>['required']
        ]);

        $telephone->update([
            'name' => $request->name,
            'phone' => $request->telephone
        ]);

        return response('success');
    }
    
    public function delete(telephone $telephone){
        $telephone->delete();
        return response('success',204);

    }
}
