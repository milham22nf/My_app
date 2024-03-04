<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\komentar;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use PhpParser\Node\Stmt\TryCatch;

class ExploreController extends Controller
{
    public function getData(Request $request){
        $cari = $request->cari;
        if($cari !== null){
            $explore = Foto::with(['Like', 'User'])
                    ->withCount(['Like','Komentar'])
                    ->where('judul_foto', 'like', '%'.$cari.'%')
                    ->orderBy('id', 'desc')
                    ->paginate(4);
        } else {
        $explore = Foto::with(['Like', 'User'])
                ->withCount(['Like','Komentar'])
                ->orderBy('id', 'desc')
                ->paginate(4);
        }
        return response()->json([
            'data'  => $explore,
            'statuscode'    => 200,
            'idUser'        => auth()->user()->id 
        ]);
    }

    public function likefoto(Request $request){
        try {
            $request->validate([
                'idfoto' => 'required'
            ]);

            $existingLike = Like::where('id_foto', $request->idfoto)->where('id_user', auth()->user()->id)->first();
            if(!$existingLike){
                $dataSimpan = [
                    'id_foto'   => $request->idfoto,
                    'id_user'   => auth()->user()->id
                ];
                Like::create($dataSimpan);
            } else {
                like::where('id_foto', $request->idfoto)->where('id_user', auth()->user()->id)->delete();
            }

            return response()->json('Data berhasil disimpan', 200);
        } catch (\Throwable $th) {
            return response()->json('Something went wrong', 500);
        }
    }

    public function getDataLike(Request $request){
        $likeuserid = auth()->user()->id;
        $explore = Foto::with(['Like', 'User'])->withCount(['Like','Komentar'])->whereHas('Like', function($query) use($likeuserid){$query->where('id_user', $likeuserid);})->paginate(4);
        return response()->json([
            'data'  => $explore,
            'statuscode'    => 200,
            'idUser'        => auth()->user()->id 
        ]);
    }

    public function getdatadetail(Request $request, $id){
        $dataDetailFoto = Foto::with(['User'])->where('id', $id)->firstOrFail();
        return response()->json([
            'dataDetailFoto' => $dataDetailFoto
        ], 200);
    }

    public function ambilDataKomentar(Request $request, $id){
        $ambilkomentar = komentar::with(['User'])->where('id_foto', $id)->get();
        return response()->json([
            'data'   => $ambilkomentar
        ], 200);
    }

    public function kirimkomentar(Request $request){
        try {
            $request->validate([
                'idfoto'    => 'required',
                'isi_komentar'  => 'required'
            ]);
            $dataStoreKomentar = [
                'id_user'   => auth()->user()->id,
                'id_foto'   => $request->idfoto,
                'isi_komentar'  => $request->isi_komentar
            ];
            komentar::create($dataStoreKomentar);
            return response()->json([
                'data'  => 'Data Berhasil Di simpan'
            ], 200);
        } catch (\Throwable $th) {
            return response('Data komentar gagal disimpan', 500);
        }
    }

    public function getDetailData(Request $request){
        $explore = Foto::with(['Like', 'User'])->withCount(['Like','Komentar'])->paginate(4);
        return response()->json([
            'data'  => $explore,
            'statuscode'    => 200,
            'idUser'        => auth()->user()->id 
        ]);
    }

}
