<?php

namespace App\Http\Controllers;

use App\Petition;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function show($order_id,$product_id){
        if($petition = Petition::where([
            ['order_id', '=', $order_id],
            ['product_id', '=', $product_id],
        ])->first()){
            return view('show_petition', [
                'petition' => $petition
            ]);
        } else {
            return view('add_petition',['order_id' => $order_id,'product_id' => $product_id] );
        }
    }

    public function store(Request $request, $order_id, $product_id){
        $request->validate([
            'reason' => 'required',
            'image1' => 'required|image|mimes:jpg,png,jpeg,gif,svg,webp|max:4096',
            'image2' => 'image|mimes:jpg,png,jpeg,gif,svg,webp|max:4096',
            'image3' => 'image|mimes:jpg,png,jpeg,gif,svg,webp|max:4096',
        ]);

        $data = new Petition();

        $data['order_id'] = $order_id;
        $data['product_id'] = $product_id;
        $data['reason'] = $request->input('reason');
        
        $data['image1'] = hasImage($request,'image1');
        $data['image2'] = hasImage($request,'image2');
        $data['image3'] = hasImage($request,'image3');

        $data['type'] = $request->input('type');
        $data->save();
        
        return back();
        
    }

    public function sendExchangeRequest($order_id){
        $client = new \GuzzleHttp\Client();
        $request = $client->post('https://sp-05-backend.onrender.com/api/confirm/exchange/'.$order_id);
        $response = json_decode($request->getBody(), true);
        return $response['status'];
    }

    public function sendReturnRequest($order_id){
        $client = new \GuzzleHttp\Client();
        $request = $client->post('https://sp-05-backend.onrender.com/api/confirm/return/'.$order_id);
        return $response = $request->getBody();
    }

    public function getProductQuantity($product_id){
        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://ltct-warehouse-backend.onrender.com/api/product/item/'.$product_id);
        return $response = $request->getBody();
    }
}

function hasImage($request,$image){
    if($request->file($image)){
        $file= $request->file($image);
        $filename = date('YmdHi').$file->getClientOriginalName();
        $file-> move(public_path('Image'), $filename);
        return $filename;
    } else {
        return null;
    }
}