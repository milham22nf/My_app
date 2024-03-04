@extends('layout.master')
@push('cssexternal')
    <script src="https://code.jquery.com/jquery-3.7.0.js" rel="script"></script>
@endpush
@section('content')
<section>
    <div class="flex flex-col items-center max-w-screen-md px-2 mx-auto mt-4">
        <div>
            <img src="/assets/users.png" alt="" class="w-24" id="imageuser">
        </div>
        <h3 class="text-xl font-semibold" id="namauser">
            ilham
        </h3>
        <small class="text-xs " id="bio">bla bala bla</small>
        <div class="flex flex-row mt-3">
                <small class="mr-4 text-abuabu" id="nama"></small> |
                <small class="text-abuabu" id="nomtel"></small>
        </div>
    </div>
</section>
<section class="mt-10">
    <div class="max-w-screen-md mx-auto">
        <div class="flex flex-wrap items-center flex-container" id="exploredataprouser">
        </div>
    </div>
</section>
@endsection
@push('footerjsexternal')
    <script src="/javascript/album.js" rel="script"></script>
@endpush