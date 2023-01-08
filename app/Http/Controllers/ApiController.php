<?php

namespace App\Http\Controllers;

use App\Petition;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function show($order_id){
        return view('add_petition',['order_id' => $order_id] );
    }

    public function store(Request $request, $order_id){
        $request->validate([
            'reason' => 'required',
            'image1' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:4096',
            'image2' => 'image|mimes:jpg,png,jpeg,gif,svg|max:4096',
            'image3' => 'image|mimes:jpg,png,jpeg,gif,svg|max:4096',
        ]);
        
        $data = new Petition();

        $data['order_id'] = $order_id;
        $data['reason'] = $request->input('reason');
        
        $data['image1'] = hasImage($request,'image1');
        $data['image2'] = hasImage($request,'image2');
        $data['image3'] = hasImage($request,'image3');

        $data['type'] = $request->input('type');

        return view('success',['success' => $data->save()]);
        
    }
}
