<?php

namespace App\Http\Controllers;

use App\Models\foto;
use App\Models\User;
use App\Models\Album;
use Illuminate\Http\Request;

class OtherprofController extends Controller
{
    public function getOtherprof(Request $request, $id){
        $dataUser = Album::with(['User'])->where('id', $id)->first();
        return response()->json([
            'dataUser' => $dataUser,
        ], 200);
    }

    public function getData(Request $request){
        $explore = Foto::with(['Like'])->withCount(['Like','Komentar'])->where('id_user', $request->idUser)->paginate(4);
        return response()->json([
            'data'  => $explore,
            'statuscode'    => 200,
            'idUser'        => auth()->user()->id 
        ]);
    }

    public function getOtherprofalbum(Request $request, $id){
        $dataUser = User::with(['Album'])->where('id', $id)->first();
        return response()->json([
            'dataUser' => $dataUser,
        ], 200);
    }
}
