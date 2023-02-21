<?php

namespace App\Http\Controllers;

use App\Petition;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    public function show($order_id, $product_id)
    {
        $data = self::productExist($order_id, $product_id);
        if ($data == null) {
            return view('error', [
                'code' => 404,
                'message' => "Order or Product doesn't exist!"
            ]);
        } elseif ($data == 502) {
            return view('error', [
                'code' => 502,
                'message' => "Couldn't connect to Payment Moldule SP_01!"
            ]);
        } else {
            if ($petition = Petition::where([
                ['order_id', '=', $order_id],
                ['product_id', '=', $product_id],
            ])->first()) {
                return view('show_petition', [
                    'petition' => $petition,
                    'product_name' => $data['productName']
                ]);
            } else {
                return view('add_petition', [
                    'order_id' => $order_id,
                    'product_id' => $product_id,
                    'product_name' => $data['productName']
                ]);
            }
        }
    }

    public function store(Request $request, $order_id, $product_id)
    {
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

        $data['image1'] = $this->hasImage($request, 'image1');
        $data['image2'] = $this->hasImage($request, 'image2');
        $data['image3'] = $this->hasImage($request, 'image3');

        $data['type'] = $request->input('type');
        $data->save();

        return back();
    }

    public function productExist($order_id, $product_id)
    {
        $client = new Client();
        $request = $client->request('GET', 'http://103.179.173.95:81/api/getOrderById/' . $order_id);
        $response = json_decode($request->getBody(), true);
        if ($response != null) {
            foreach ($response[0]['products'] as $product) {
                if ($product['productId'] == intval($product_id)) {
                    return $product;
                }
            }
            return null;
        } else {
            return 502;
        }
    }

    protected function hasImage($request, $image)
    {
        if ($request->file($image)) {
            $file = $request->file($image);
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('Image'), $filename);
            return $filename;
        } else {
            return null;
        }
    }
}
