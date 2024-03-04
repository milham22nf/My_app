<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/build.css">
    <link href="https://fonts.cdnfonts.com/css/jsmath-cmti10" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>MyGallery | Index</title>
</head>

<body>


    <nav class="bg-white border-gray-200 shadow-md dark:bg-gray-900">
        <div class="flex flex-wrap items-center justify-between max-w-screen-md p-4 mx-auto">
            <h3 class="text-3xl font-medium font-jsmath">Mygallery</h3>
            <div class="flex gap-1">
                <a href="{{ url("login") }}"><button class="px-5 py-1 text-white rounded-full bg-sky-900">Login</button></a>
                <a href="{{ url("register") }}"><button class="px-5 py-1 text-white rounded-full bg-sky-900">Register</button></a>
            </div>
        </div>
    </nav>

    <section>
        <div class="mx-auto justify-center items-center">
            <div class="justify-center flex flex-wrap">
            <span class="py-5 m-2 text-5xl text-center font-jsmath">The</span>
            <span class="py-5 m-2 text-5xl text-center font-jsmath">Memory</span>
            <span class="py-5 m-2 text-5xl text-center font-jsmath">Storage</span>                
            </div>
        </div>
        <div class=" mt-9">
            <div class="max-w-screen-md mx-auto">
               <div class="flex gap-3 px-3 sm:flex-wrap">
                    <div class=" flex flex-wrap gap-3 px-2">
                        <img src="/assets/download1.jpg" alt="" class="rounded-md w-[425px] h-[407px] lg:w-[290px] transition duration-500 ease-in-out hover:scale-105">
                        <img src="/assets/download3.jpg" alt="" class="rounded-md w-[425px] h-[407px] transition duration-500 ease-in-out hover:scale-105">
                    </div>
                </div> 
                <div class="flex gap-3 px-3 mt-3 sm:flex-wrap">
                    <div class=" flex flex-wrap gap-3 px-2">
                        <img src="/assets/download2.jpg" alt="" class="rounded-md w-[425px] h-[407px]  transition duration-500 ease-in-out hover:scale-105">
                        <img src="/assets/download.jpg" alt="" class="rounded-md w-[425px] h-[407px] lg:w-[290px] transition duration-500 ease-in-out hover:scale-105">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>

</html>