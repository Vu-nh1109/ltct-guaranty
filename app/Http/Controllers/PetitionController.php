<?php

namespace App\Http\Controllers;

use App\Models\Petition;
use Illuminate\Http\Request;

class PetitionController extends Controller
{
    public function viewPetition(){
        $petitionData = Petition::all();
        return view('view_petitions', compact('petitionData'));
    }
}
