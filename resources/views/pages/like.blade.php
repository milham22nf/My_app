@extends('layout.master')
@push('cssexternal')
    <script src="https://code.jquery.com/jquery-3.7.0.js" rel="script"></script>
@endpush
@section('content')
    <section class="mt-10">
        @csrf
        <div class="max-w-screen-md mx-auto">
            <div class="flex flex-wrap items-center flex-container" id="likedfoto">

            </div>
        </div>
    </section>
@endsection
@push('footerjsexternal')
    <script src="javascript/like.js" rel="script"></script>
@endpush


