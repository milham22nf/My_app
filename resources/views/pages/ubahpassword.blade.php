@extends('layout.master')

@section('content')
<section class="max-w-[500px] mx-auto mt-5 ">
    <div class="max-[480px]:w-full">
        <div class="bg-white rounded-md shadow-md ">
            <div class="flex flex-col px-4 py-5">
                <div class="flex items-center justify-center gap-2 py-5">
                    <h5 class="text-3xl text-center font-jsmath">Change</h5>
                    <h5 class="text-3xl text-center font-jsmath">Your</h5>                    
                    <h5 class="text-3xl text-center font-jsmath">Password</h5>
                </div>
                <form action="/updapass" method="POST">
                @csrf 
                <div class="flex flex-col px-4 py-5">
                <h5>Password Lama</h5>
                <input name="password" type="password" class="py-1 rounded-md" value="(hash) : {{ $datapass->password }}">
                

                <button type="submit" class="py-2 mt-4 text-white rounded-md bg-sky-900">Perbaharui</button>
                                       
                </div>
     </form>
            </div>
        </div>
    </div>
</section>
@endsection