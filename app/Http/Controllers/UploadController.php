<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\foto;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function uploadf()
    {
        $data = [
            'datalbum' => Album::with(['User'])->where('id_user',auth()->user()->id)->get()
        ];
        return view('pages.upload', $data);
    }

    public function upalbum(Request $request)
    {
        $request->validate([
            'judul_album' => 'required',
            'deskripsi_album' => 'required',
        ]);
        $simpandata = [
            'id_user'   => auth()->user()->id,
            'judul_album' => $request->judul_album,
            'deskripsi_album' => $request->deskripsi_album,
        ];
        Album::create($simpandata);
        return redirect('/upload');
    }

    public function save(Request $request)
    {
        $request-> validate([
            'filefoto' => 'required|mimes:png,jpg|max:1024',
            'judul_foto' => 'required',
            'deskripsi' => 'required'
            ]);

        // Logika penyimpanan foto sesuai kebutuhan Anda
        $filename = pathinfo($request->filefoto, PATHINFO_FILENAME);

        $extension = $request->filefoto->getClientOriginalExtension();
        $namafoto = 'foto' . time() . '.' . $extension;
        $request->filefoto->move('foto', $namafoto);

        $datasimpan = [
            'id_user' => auth()->user()->id,
            'id_album' => $request->albumuser,
            'judulfoto' => $request->judul_foto,
            'deskripsifoto' => $request->deskripsi,
            'url' => $namafoto
        ];
        foto::create($datasimpan);
        return redirect('/explore');
    }
}
