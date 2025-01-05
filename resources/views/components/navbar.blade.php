@props(['user'])

<nav class="bg-white/50 backdrop-blur-sm shadow-md fixed w-full z-10 transition duration-300 ease-in-out" id="navbar">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-between">
                <div class="flex-shrink-0 flex items-center">
                    <a class="m-auto" href="/">
                        Flytigera e-Ticket
                    </a>
                </div>
                <div class="hidden sm:block sm:ml-6">
                    @if (Session::has('username'))
                    <div class="flex space-x-4 justify-center">
                        <a href="/" class="text-black/70 transition-500 ease-in-out duration-500 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Beranda</a>
                        <a href="/history" class="text-black/70 transition-500 ease-in-out duration-500 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Histori Tiket</a>
                        <a href="/#contact" class="text-black/70 transition-500 ease-in-out duration-500 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Contact</a>
                    </div>

                    @else
                    <div class="flex space-x-4 justify-center">
                        <a href="/login" class="transition-500 ease-in-out duration-500 bg-blue-400/90 text-white/80 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Masuk Akun</a>
                        <a href="/register" class="transition-500 ease-in-out duration-500 bg-blue-400/90 text-white/80 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Daftar Sekarang</a>
                    </div>
                    @endif
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center space-x-4 pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                @if (Session::has('username'))
                <div class="relative">
                    <button type="button" class="p-1" id="notification-button">
                        <span class="sr-only">View notifications</span>
                        <svg class="w-6 h-6" fill="#000000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M10,21h4a2,2,0,0,1-4,0ZM3.076,18.383a1,1,0,0,1,.217-1.09L5,15.586V10a7.006,7.006,0,0,1,6-6.92V2a1,1,0,0,1,2,0V3.08A7.006,7.006,0,0,1,19,10v5.586l1.707,1.707A1,1,0,0,1,20,19H4A1,1,0,0,1,3.076,18.383ZM6.414,17H17.586l-.293-.293A1,1,0,0,1,17,16V10A5,5,0,0,0,7,10v6a1,1,0,0,1-.293.707Z"></path></g></svg>
                    </button>
                    <div id="notification-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="notification-button">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Notifikasi Kosong</a>
                    </div>
                </div>
                <div class="relative">
                    <button type="button" class="p-1" id="order-button">
                        <span class="sr-only">Order</span>
                        <svg class="w-6 h-6" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#000000;} </style> <g> <path class="st0" d="M193.845,405.991c-6.248,0-11.324,5.062-11.324,11.318c0,6.255,5.077,11.325,11.324,11.325 c6.256,0,11.325-5.07,11.325-11.325C205.17,411.053,200.101,405.991,193.845,405.991z"></path> <path class="st0" d="M193.845,363.678c-6.248,0-11.324,5.069-11.324,11.325c0,6.248,5.077,11.318,11.324,11.318 c6.256,0,11.325-5.07,11.325-11.318C205.17,368.746,200.101,363.678,193.845,363.678z"></path> <path class="st0" d="M491.425,227.51H205.17h-2.075h-20.575h-79.706H82.241v20.567v211.537v20.575h20.574h79.706h20.575h2.075 h286.254H512v-20.575V248.077V227.51H491.425z M491.425,459.614H205.17c0-6.255-5.069-11.318-11.325-11.318 c-6.248,0-11.324,5.062-11.324,11.318h-79.706V248.077h79.706c0,6.255,5.077,11.318,11.324,11.318 c6.256,0,11.325-5.062,11.325-11.318h286.254V459.614z"></path> <path class="st0" d="M193.845,321.372c-6.248,0-11.324,5.069-11.324,11.324c0,6.248,5.077,11.318,11.324,11.318 c6.256,0,11.325-5.07,11.325-11.318C205.17,326.441,200.101,321.372,193.845,321.372z"></path> <path class="st0" d="M193.845,279.065c-6.248,0-11.324,5.062-11.324,11.318c0,6.256,5.077,11.325,11.324,11.325 c6.256,0,11.325-5.069,11.325-11.325C205.17,284.127,200.101,279.065,193.845,279.065z"></path> <polygon class="st0" points="117.846,196.225 369.458,59.702 449.357,206.934 472.755,206.934 387.535,49.881 377.73,31.811 359.638,41.61 108.048,178.148 106.224,179.133 88.14,188.939 18.084,226.961 0,236.774 9.813,254.859 61.673,350.425 61.673,307.289 27.898,245.046 61.673,226.709 "></polygon> </g> </g></svg>
                    </button>
                    <div id="order-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="order-button">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Tiket Terakhir Kosong</a>
                    </div>
                </div>
                <div class="relative">
                    <button type="button" class="flex text-sm rounded-full drop-shadow-2xl outline outline-1 outline-black/20" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                        <span class="sr-only">Open user menu</span>
                        <img class="object-cover h-8 w-8 rounded-full" src="/{{ $user->profile_image }}" alt="User Profile">
                    </button>
                    <div id="user-menu" class="hidden absolute right-0 mt-2 w-32 bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button">
                        <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Profil</a>
                        <a href="/refund" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Pengembalian</a>
                        <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Keluar</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</nav>

@if(request()->path() == '/') <div class="spacer pt-16 w-full"></div>
@else <div class="spacer pt-24 w-full"></div>
@endif

{{-- scroll feature --}}
<script>
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('bg-white/90');
        } else {
            navbar.classList.remove('bg-white/90');
        }
    });

    document.getElementById('user-menu-button').addEventListener('click', function() {
        const userMenu = document.getElementById('user-menu');
        userMenu.classList.toggle('hidden');
    });

    document.getElementById('notification-button').addEventListener('click', function() {
        const notificationMenu = document.getElementById('notification-menu');
        notificationMenu.classList.toggle('hidden');
    });

    document.getElementById('order-button').addEventListener('click', function() {
        const orderMenu = document.getElementById('order-menu');
        orderMenu.classList.toggle('hidden');
    });

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');
        const notificationButton = document.getElementById('notification-button');
        const notificationMenu = document.getElementById('notification-menu');
        const orderButton = document.getElementById('order-button');
        const orderMenu = document.getElementById('order-menu');
        if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
            if (!userMenu.classList.contains('hidden')) {
                userMenu.classList.add('hidden');
            }
        }
        if (!notificationButton.contains(event.target) && !notificationMenu.contains(event.target)) {
            if (!notificationMenu.classList.contains('hidden')) {
                notificationMenu.classList.add('hidden');
            }
        }
        if (!orderButton.contains(event.target) && !orderMenu.contains(event.target)) {
            if (!orderMenu.classList.contains('hidden')) {
                orderMenu.classList.add('hidden');
            }
        }
    }
</script>