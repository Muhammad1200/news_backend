<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\AddInterestRequest;
use App\Models\Interest;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterestController extends Controller
{
    public function index()
    {
        try {
            $interests = Source::where('user_id',Auth::id())->get();
            return $this->respond($interests,[],false,'successfully reterived!');
        }catch (\Exception $e){
            return $this->respondWithError([],false,$e->getMessage());
        }
    }

    public function add(AddInterestRequest $request)
    {
        try {
            $sources = Source::where('user_id',Auth::id())->where('name',$request->name)->first();
            if(!empty($sources)){
                $sources->delete();
            }else{
                $sources = Source::create([
                    'user_id' => Auth::id(),
                    'name'    => $request->name
                ]);
            }
            $sources = Source::where('user_id',Auth::id())->get();
            return $this->respond($sources,[],false,'successfully retrieved!');
        }catch (\Exception $e){
            return $this->respondWithError([],false,$e->getMessage());
        }
    }
}
