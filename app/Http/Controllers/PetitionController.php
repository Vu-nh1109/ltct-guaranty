<?php

namespace App\Http\Controllers;

use App\Petition;
use Illuminate\Http\Request;

class PetitionController extends Controller
{
    public function viewPetitions(){
        $petitionData = Petition::all();
        return view('view_petitions', compact('petitionData'));
    }

    public function showPetition($id){
        $petition = Petition::findOrFail($id);
        return view('admin_petition', [
            'petition' => $petition
        ]);
    }

    public function handlePetition(Request $request,$id){
        $petition = Petition::find($id);
        switch($request->input('action')) {
            case 'accept':
                acceptPetition($petition);
                break;
            case 'refuse':
                $petition->status=0;
                break;
            case 'return':
                $petition->type=1;
                acceptPetition($petition);
                break;
        }
        $petition->save();
        return back();
    }
}

function acceptPetition (Petition $petition){
    if(!$petition->type){
        $result = (new ApiController)->sendExchangeRequest($petition->order_id);
    } else {
        $result = (new ApiController)->sendReturnRequest($petition->order_id);
    }

    if($result='success'){
        $petition->status=1;
    }
}