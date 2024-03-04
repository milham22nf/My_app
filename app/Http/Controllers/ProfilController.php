<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Foto;
use App\Models\komentar;
use App\Models\User;
use Faker\Guesser\Name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function getDataprofil(Request $request)
    {
        // Mengambil pengguna yang sedang masuk
        $user = Auth::user();

        // Memeriksa apakah pengguna sedang masuk
        if (!$user) {
            return response()->json(['error' => 'Pengguna tidak ditemukan'], 404);
        }

        // Mengambil data profil pengguna
        $dataUser = [
            'user_name' => $user->user_name,
            'bio' => $user->bio,
            'picture' => $user->picture,
            'no_telp' => $user->no_telp,
            'name'  => $user->name,
        ];

        return response()->json([
            'dataUser' => $dataUser,
        ], 200);
    }

    public function getData(){
        $explore = Foto::with(['Like'])->withCount(['Like','Komentar'])->where('id_user', auth()->user()->id)->paginate(4);
        return response()->json([
            'data'  => $explore,
            'statuscode'    => 200,
            'idUser'        => auth()->user()->id 
        ]);
    }

    // public function deletefoto(Request $request){

    //     Foto::where('id_foto', $request->idfoto)
    //     ->where('id_user', auth()->user()->id)
    //     ->delete();

    // return response()->json(['message' => 'Foto berhasil dihapus'], 200);
    // }

    public function ubprof() {
        // Mengambil data profil dari database berdasarkan ID pengguna yang sedang login
        $dataprof = User::where('id', auth()->user()->id)->first();

        return view('pages.ubahprofil', compact('dataprof'));
    }

    public function upfoto(Request $request){
        $filename = pathinfo($request->Filefoto, PATHINFO_FILENAME);

        $extension = $request->Filefoto->getClientOriginalExtension();
        $namafoto = 'foto' . time() . '.' . $extension;
        $request->Filefoto->move('foto', $namafoto);

        $dataupdate = [
            'picture' => $namafoto
        ];
        User::where('id', auth()->user()->id)->update($dataupdate);
        return redirect('/ubah-profile');
    }

    public function updataprof(Request $request){
        $dataupprof = [
            'name' => $request->name,
            'user_name' => $request->user_name,
            'no_telp' => $request->no_telp,
            'bio' => $request->bio,
            'alamat' => $request->alamat,
        ];
        User::where('id', auth()->user()->id)->update($dataupprof);
        return redirect('/ubah-profile');
    }

    public function ubpass() {
        // Mengambil data profil dari database berdasarkan ID pengguna yang sedang login
        $datapass = User::where('id', auth()->user()->id)->first();

        return view('pages.ubahpassword', compact('datapass'));
    }

    public function updatapass(Request $request)
    {
        $datauppassword = [
            'password' => Hash::make($request->name),
        ];
        User::where('id', auth()->user()->id)->update($datauppassword);
        return redirect('/ubah-profile');
    }

    public function getDatapAlbumprofil(Request $request)
    {
        // Mengambil pengguna yang sedang masuk
        $user = Auth::user();

        // Memeriksa apakah pengguna sedang masuk
        if (!$user) {
            return response()->json(['error' => 'Pengguna tidak ditemukan'], 404);
        }

        // Mengambil data profil pengguna
        $dataUser = [
            'user_name' => $user->user_name,
            'bio' => $user->bio,
            'picture' => $user->picture,
            'no_telp' => $user->no_telp,
            'name'  => $user->name,
        ];

        return response()->json([
            'dataUser' => $dataUser,
        ], 200);
    }

    public function getDataalbum()
    {
        $explore = Album::with('Foto')->where('id_user', auth()->user()->id)->paginate(4);
        return response()->json([
            'data'  => $explore,
            'statuscode'    => 200,
            'idUser'        => auth()->user()->id 
        ]);
    }
}
