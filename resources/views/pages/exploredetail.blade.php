@extends('layout.master')
@push('cssexternal')
    <script src="https://code.jquery.com/jquery-3.7.0.js" rel="script"></script>
@endpush
@section('content')
<section class="mt-10">
    <div class="max-w-screen-md mx-auto">
        <div class="flex flex-wrap px-2 flex-container shadow-md"> 
            <div class="w-3/5 max-[350px]:w-full"> 
                <div class="flex justify-center overflow-hidden"> 
                    <img src="" alt="" class="w-full h-auto max-w-xl px-2 transition duration-500 ease-in-out hover:scale-105" id="fotodetail">
                </div> 
                <div class="flex flex-col px-2"> 
                    <div class="font-semibold" id="judulfoto">
                         Judul Foto 
                    </div> 
                    <div> 
                        <small class="text-gray" id="deskripsi"> Bawah </small> 
                    </div>
                </div> 
            </div> 
            <div class="w-2/5 max-[480px]:w-full"> 
                <div class="flex flex-wrap items-center justify-between "> 
                    <div class="flex flex-row items-center gap-2"> 
                        <div> 
                            <img src="/foto/" class="w-10" alt="" id="userfoto"> 
                        </div> 
                        <div class="flex flex-col" >
                            <a href="/other-profile/" class="text-md" id="username">
                                Ilham
                            </a> 
                            <small class="text-xs"></small> 
                        </div>
                    </div> 
                    <div> </div>
                </div> 
                <div class="mt-[33px]"> Comments </div> 
                <div class="relative flex flex-col overflow-y-auto h-[200px] scrollbar-hidden" id="listkomentar"> 
                    <div class="flex flex-row justify-start mt-4"> 
                        <div class="w-1/4">
                            <img src="/assets/users.png" class="w-8 h-auto" alt=""> 
                        </div> 
                        <div class="flex flex-col mr-2"> 
                            <h5 class="text-sm">Atas</h5> 
                            <small class="text-xs text-gray">Bawah</small> 
                        </div> 
                        <h5 class="text-sm">Fotonya sangat Bagus Sekali, apakah saya bisa memintanya</h5> 
                    </div> 
                    <div class="flex flex-row justify-start mt-4"> 
                        <div class="w-1/4"> 
                            <img src="/assets/users.png" class="w-8 h-auto" alt=""> 
                        </div> <div class="flex flex-col mr-2"> 
                            <h5 class="text-sm">Atas</h5> 
                            <small class="text-xs text-gray">Bawah</small> 
                        </div> 
                        <h5 class="text-sm">Fotonya sangat Bagus Sekali, apakah saya bisa memintanya</h5> 
                    </div> 
                </div> 
                <div class="flex gap-2 mt-2">
                    @csrf
                    <div class="w-3/4"> 
                        <input type="text" name="textkomentar" id="" 
                        class="w-full px-2 py-1 rounded-full border border-black"> 
                    </div> 
                    <button class="px-4 rounded-full bg-sky-900" onclick="kirimkomentar()">
                        <span class="text-white bi bi-send"></span>
                    </button> 
                </div> 
            </div> 
        </div>
        @csrf
        <div class="max-w-screen-md mx-auto">
            <div class="flex flex-wrap items-center flex-container" id="exploreDetaildata">

            </div>
        </div>
    </section>          
@endsection
@push('footerjsexternal')
    <script src="\javascript\exploredetail.js" rel="script"></script>
@endpush