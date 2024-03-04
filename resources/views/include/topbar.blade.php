
<nav class="fixed top-0 z-20 w-full bg-white shadow-md">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-3">
          <div class="flex flex-wrap items-center justify-center max-w-screen-xl p-3 mx-auto">
            <button data-collapse-toggle="navbar-hamburger" type="button" class="inline-flex items-center justify-center p-2 w-15 h-15 text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation" aria-controls="drawer-navigation">
                <span class="sr-only">Open main menu</span>
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
              </button>
            <a href="{{ url("explore") }}" class="mr-4">JELAJAHI</a>
            <a href="{{ url("like") }}" class="mr-4">SUKA</a>
            <form action="/explore" method="GET">
            <input type="text" class="px-4 py-1 mr-4 rounded-full" placeholder="Search ..." name="cari">
            </form>
            <a href="{{ url("upload") }}" class="mr-4">UPLOAD</a>
            <!-- Tampilkan foto pengguna jika tersedia -->         
        </div>
      </div>
</nav>