<?php

namespace App\Http\Controllers;

use DB;
use App\Petition;
use Illuminate\Http\Request;

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
        return view('admin_petition', [
            'petition' => $petition,
            'quantity' => $this->getProductQuantity($petition->product_id)
        ]);
    }

    public function handlePetition(Request $request, $id)
    {
        $petition = Petition::find($id);
        switch ($request->input('action')) {
            case 'accept':
                if (!$petition->type && $this->getProductQuantity($petition->product_id) <= 0) {
                } else {
                    $this->acceptPetition($petition);
                }
                break;
            case 'refuse':
                $petition->status = 0;
                break;
            case 'return':
                $petition->type = 1;
                $this->acceptPetition($petition);
                break;
        }
        $petition->save();
        return back();
    }

    public function sendExchangeRequest($order_id)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->post('https://sp-05-backend.onrender.com/api/confirm/exchange/' . $order_id);
        $response = json_decode($request->getBody(), true);
        return $response['status'];
    }

    public function sendReturnRequest($order_id)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->post('https://sp-05-backend.onrender.com/api/confirm/return/' . $order_id);
        $response = json_decode($request->getBody(), true);
        return $response['status'];
    }

    public function getProductQuantity($product_id)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->request('GET', 'https://ltct-warehouse-backend.onrender.com/api/product/item/' . $product_id);
        $response = json_decode($request->getBody(), true);
        return $response['quantity'];
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
            toastr()->error("Couldn't connect to Accounting Module");
        }
    }
}
