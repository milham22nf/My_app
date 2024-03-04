@extends('layout.master')

@section('content')
<section class="max-w-screen-md mx-auto mt-10">
    <div class="flex flex-wrap justify-between flex-container">
        <form action="/upgambar" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col items-center w-2/6 bg-white rounded-md shadow-md max-[480px]:w-full">
            <img src="/foto/{{ $dataprof->picture }}" alt="" class="rounded-full w-36 h-36">
            <input type="file" name="Filefoto" class="items-center w-48 h-10 mt-4 border rounded-md">
            <button class="w-48 py-1 mt-4 text-white rounded-md bg-sky-900">Ubah Photo</button>
        </div>        
        </form>
        <div class="w-3/5 max-[480px]:w-full">
            <div class="bg-white rounded-md shadow-md ">
                <form action="/upprofil" method="post">
                    @csrf
                    <div class="flex flex-col px-4 py-4 ">
                        <div class="flex items-center justify-center gap-2">
                            <h5 class="text-3xl text-center font-jsmath">Change</h5>
                            <h5 class="text-3xl text-center font-jsmath">Your</h5>                    
                            <h5 class="text-3xl text-center font-jsmath"> Profile</h5>
                        </div>
                        <h5>Nama Lengkap</h5>
                        <input type="text" name="name" class="py-1 rounded-md" value="{{ $dataprof->name }}">
                        <h5>User Name</h5>
                        <input type="text" name="user_name" class="py-1 rounded-md" value="{{ $dataprof->user_name }}">
                        <h5>No Telepon</h5>
                        <input type="text" name="no_telp" class="py-1 rounded-md" value="{{ $dataprof->no_telp }}">
                        <h5>Bio</h5>
                        <textarea name="bio" class="py-1 rounded-md">{{ $dataprof->bio }}</textarea>
                        <h5>Alamat</h5>
                        <textarea name="alamat" class="py-1 rounded-md">{{ $dataprof->alamat }}</textarea>
  
                        <button type="submit" class="py-2 mt-4 text-white rounded-md bg-sky-900">Perbaharui</button>
                    </div>        
                </form>  
            </div>
        </div>
    </div>
</section> 
@endsection
