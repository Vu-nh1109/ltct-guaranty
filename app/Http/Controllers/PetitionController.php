<?php

namespace App\Http\Controllers;

use DB;
use App\Petition;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\ServerException;

class PetitionController extends Controller
{
    public function viewPetitions(Request $request)
    {
        $query = DB::table('petitions')->orderBy('created_at', 'desc');
        if ($request->input('id')) {
            $query = $query->where('id', $request->input('id'));
        }
        if ($request->input('order_id')) {
            $query = $query->where('order_id', $request->input('order_id'));
        }
        if ($request->input('product_id')) {
            $query = $query->where('product_id', $request->input('product_id'));
        }
        if ($request->input('reason')) {
            $query = $query->where('reason', 'like', '%' . $request->input('reason') . '%');
        }
        if ($request->input('type') != '') {
            $query = $query->where('type', $request->input('type'));
        }
        if ($request->input('status') != '') {
            $query = $query->where('status', $request->input('status'));
        }

        $petitionData = $query->paginate(10);
        return view('view_petitions', compact('petitionData'),);
    }

    public function showPetition($id)
    {
        $petition = Petition::findOrFail($id);
        $apiController = app(ApiController::class);
        $product = $apiController->productExist($petition->order_id, $petition->product_id);
        if ($product == 502) {
            Session::flash('toastr_message', "Couldn't connect to Payment Moldule SP_01!");
            return view('admin_petition', [
                'petition' => $petition,
                'warehouse_quantity' => $this->getProductQuantity($petition->product_id),
                'toastr_message' => Session::get('toastr_message')
            ]);
        } else {
            return view('admin_petition', [
                'petition' => $petition,
                'warehouse_quantity' => $this->getProductQuantity($petition->product_id),
                'product_name' => $product['productName'],
                'order_quantity' => $product['quantity']
            ]);
        }
    }

    public function handlePetition(Request $request, $id)
    {
        $petition = Petition::find($id);
        $apiController = app(ApiController::class);
        $product = $apiController->productExist($petition->order_id, $petition->product_id);
        switch ($request->input('action')) {
            case 'accept':
                if (!$petition->type && $this->getProductQuantity($petition->product_id) < $product['quantity']) {
                } else {
                    $this->acceptPetition($petition);
                }
                break;
            case 'refuse':
                $petition->status = 0;
                toastr()->success('Petition Request Refused Successfully!');
                break;
            case 'return':
                $petition->type = 1;
                $this->acceptPetition($petition);
                break;
        }
        $petition->save();
        return back();
    }

    protected function acceptPetition(Petition $petition)
    {
        if (!$petition->type) {
            $result = $this->sendExchangeRequest($petition->order_id);
        } else {
            $result = $this->sendReturnRequest($petition->order_id);
        }

        if ($result = 'success') {
            $petition->status = 1;
            toastr()->success('Petition Request Accepted Successfully!');
        } else {
            toastr()->error("Couldn't connect to Accounting Module SP_05!");
        }
    }

    public function sendExchangeRequest($order_id)
    {
        $client = new Client();
        try {
            $request = $client->post('https://sp-05-backend.onrender.com/api/confirm/exchange/' . $order_id);
        } catch (ServerException $e) {
            return null;
        }
        $response = json_decode($request->getBody(), true);
        if ($response != null) {
            return $response['status'];
        } else {
            return null;
        }
    }

    public function sendReturnRequest($order_id)
    {
        $client = new Client();
        try {
            $request = $client->post('https://sp-05-backend.onrender.com/api/confirm/return/' . $order_id);
        } catch (ServerException $e) {
            return null;
        }
        $response = json_decode($request->getBody(), true);
        if ($response != null) {
            return $response['status'];
        } else {
            return null;
        }
    }

    public function getProductQuantity($product_id)
    {
        $client = new Client();
        try {
            $request = $client->request('GET', 'https://ltct-warehouse-backend.onrender.com/api/product/item/' . $product_id);
        } catch (ServerException $e) {
            return null;
        }
        $response = json_decode($request->getBody(), true);
        if ($response != null) {
            return $response['quantity'];
        } else {
            return null;
        }
    }
}
