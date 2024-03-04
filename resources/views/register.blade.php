<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/build.css">
    <link href="https://fonts.cdnfonts.com/css/jsmath-cmti10" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>MyGallery | Register</title>
                
</head>

<body>


    <nav class="bg-white border-gray-200 shadow-md dark:bg-gray-900">
        <div class="flex flex-wrap items-center justify-between max-w-screen-md p-4 mx-auto">
            <h3 class="text-3xl font-medium font-jsmath">Mygallery</h3>
            <div class="flex gap-1">
                <a href="{{ url("login") }}"><button class="px-5 py-1 text-white rounded-full bg-blue-900">Login</button></a>
                <a href="{{ url("register") }}"><button class="px-5 py-1 text-white rounded-full bg-blue-900">Register</button></a>
            </div>
        </div>
    </nav>

    <section class="mt-14">
        <div class="max-w-[364px] bg-white rounded-md shadow-md mx-auto px-6 py-4">
                <form action="/register" method="post">
                    @csrf
            <div class="flex flex-col">
                <h3 class="mx-auto text-3xl font-jsmath">Mygallery</h3>
                <h4 class="mt-3">Email</h4>
                <input type="email" name="email" class="py-1 border border-black rounded-md text-slate-700">
                @error('email')
                  <small class="italic text-red-800">{{ $message }}</small>
                @enderror
                <h4 class="mt-3">Password</h4>
                <input type="password" name="password" class="py-1 border border-black rounded-md text-slate-700">
                @error('password')
                <small class="italic text-red-800">{{ $message }}</small>     
                @enderror
                <h4 class="mt-3">No. Telepon</h4>
                <input type="number" name="no_telp" class="py-1 border border-black rounded-md text-slate-700">
                @error('no_telp')
                <small class="italic text-red-800">{{ $message }}</small>                        
                @enderror
                <button type="submit" class="py-1 mt-4 text-white rounded-full bg-sky-700">REGISTER</button>
                <h5 class="mx-auto mt-4 text-xs">Sudah memiliki akun? <a class="text-sky-900" href="{{ url("login") }}">Log in</a></h5>
            </div>
                </form>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>

</html>

