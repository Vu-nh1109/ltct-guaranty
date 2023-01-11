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
        return view('show_petition', [
            'petition' => $petition
        ]);
    }

    public function handlePetition(Request $request,$id){
        $petition = Petition::find($id);
        if($request->input('action')=='accept')
            acceptPetition($petition);
        else if($request->input('action')=='refuse')
            $petition->status=0;
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