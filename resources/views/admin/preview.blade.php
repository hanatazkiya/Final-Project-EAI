<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>{{ $place->name }}</title> --}}
    <script src="https://sandbox.doku.com/jokul-checkout-js/v1/jokul-checkout-1.0.0.js"></script>
    @vite('resources/css/app.css')
</head>
<body class="m-0 p-0 bg-black/10">
    <x-admin.navbar>
        {{-- navbar --}}
    </x-admin.navbar>

    <div class="header-image container mx-auto px-6 rounded-lg mt-10 flex gap-5">
        <div class="{{ ($place->place_images->count() >= 4) ? 'w-1/2' : 'w-full' }}">
            <img src="/{{ $place->header_image }}" alt="Header Image" class="w-full h-auto rounded-lg">
        </div>

        @if ($place->place_images->count() >= 4)
        <div class="w-1/2 grid grid-cols-2 gap-x-4 gap-y-2">
            @foreach ($place->place_images as $image)
                @if (!($loop->iteration > 4))
                    <div class="relative">
                        {{-- demo : https://asset.kompas.com/crops/5HTgtdqk1nAd9g8oj9lPHQyNUlU=/0x0:750x500/1200x800/data/photo/2023/07/13/64af70ba9e5c5.jpeg --}}
                        <img src="/{{ $image->filename }}" alt="Image" class="w-full h-auto rounded-lg transition-transform duration-300 hover:scale-105 hover:cursor-pointer">
                    </div>
                @endif
            @endforeach
        </div>
        @endif
    </div>

    <div class="w-[97%] mx-auto px-6 py-3 mt-6 bg-white rounded-lg flex justify-between items-center">
        <div>
            <div class="text-xl font-semibold">
                {{ $place->name }}
            </div>
            <div class="text-sm text-gray-500">
                {{ $place->place_details->city }}
            </div>
        </div>
        <div class="text-right">
            <div class="text-lg font-semibold text-green-500">
                {{ $place->price }}
            </div>
            
            <button class="mt-1 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-white/70 hover:text-blue-600 transition-colors duration-300">
                <a>Pesan Tiket</a>
            </button>
        </div>
    </div>

    <div class="w-[97%] mx-auto px-6 py-6 mt-6 bg-white rounded-lg flex gap-6">
        <div class="w-1/2">
            <div class="text-xl font-semibold mb-4">
                Deskripsi
            </div>
            <div class="text-sm text-gray-500 mb-6">
                {{ $place->short_description }}
            </div>
            <div class="grid gap-4">
                @foreach ($place->place_images as $image)
                <div>
                    <img src="/{{ $image->filename }}" alt="Deskripsi Image" class="w-full h-auto rounded-lg">
                </div>
                @endforeach
            </div>
        </div>

        <div class="w-1/2 bg-gray-100 drop-shadow-xl p-6 rounded-lg flex flex-col justify-between sticky top-24 h-fit">
            <div>
                <div class="text-lg font-semibold text-gray-700">
                    Tiket Masuk
                </div>
                <div class="text-2xl font-bold text-green-500 mt-2">
                    <input type="hidden" name="price" value="{{ $place->price }}">
                    {{ $place->price }}
                </div>
            </div>
            <a class="mt-4 px-4 py-2 bg-blue-500 text-white text-center rounded-lg hover:bg-white/70 hover:text-blue-600 ease-in-out transition-all duration-300">
            Pesan Sekarang
            </a>
        </div>
    </div>
    
    <div class="w-[97%] mx-auto px-6 py-6 mt-6 bg-white rounded-lg flex gap-6">
        <div class="w-1/3">
            <div class="text-xl font-semibold mb-4">
                Fasilitas Tempat Wisata
            </div>
            <div class="grid grid-cols-2 gap-x-10 gap-y-2 w-fit">
                @foreach ($place->place_features as $feature)
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="text-gray-700">{{ $feature->feature }}</span>
                </div>
                @endforeach
            </div>
        </div>
        <div class="w-1/3">
            <div class="text-xl font-semibold mb-4">
                Yang Unik dari Tempat Ini
            </div>
            <div class="grid grid-cols-2 gap-x-10 gap-y-2 w-fit">
                @foreach ($place->places_uniquenesses as $unique)
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="text-gray-700">{{ $unique->uniqueness }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="w-[97%] mx-auto px-6 py-6 mt-6 bg-white rounded-lg flex gap-6">
        <div class="w-full">
            {!! $place->place_details->maps !!}
        </div>
    </div>

    <div class="w-[97%] mx-auto px-6 py-6 mt-6 bg-white rounded-lg">
        <div class="text-xl font-semibold mb-4">
            Rekomendasi Tempat Lainnya
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
            @php
            $recommendations = $places->count() > 7 ? $places->random(5) : $places->take(5);
            @endphp
            
            @foreach ($recommendations as $place)
                <a href="/detail/{{ $place->slug }}" class="block bg-gray-100 rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105">
                <img src="/{{ $place->header_image }}" alt="Rekomendasi {{ $place->name }}" class="w-full h-32 object-cover">
                <div class="p-4">
                    <div class="text-lg font-semibold">
                        {{ $place->name }}
                    </div>
                    <div class="text-sm text-gray-500 mb-2">
                        {{ Str::limit($place->short_description, 50) }}
                    </div>
                    <div class="text-lg font-semibold text-green-500">
                        {{ $place->price }}
                    </div>
                </div>
                </a>
            @endforeach
        </div>
    </div>

    <div class="w-[97%] mx-auto px-6 py-6 mt-6 bg-white rounded-lg">
        <div class="text-xl font-semibold mb-4">
            Deskripsi Lengkap
        </div>
        <div class="text-sm text-gray-500">
            {{ $place->place_details->description }}
        </div>
    </div>

    <x-footer>
        {{-- footer here --}}
    </x-footer>

    {{-- embedded maps script --}}
    <script>
        window.onload = ()=> {
            document.querySelectorAll('iframe').forEach((iframe) => {
                iframe.setAttribute('height', '');
                iframe.setAttribute('width', '');
                iframe.classList.add('w-full');
                iframe.classList.add('h-72');
            });
        }
    </script>
</body>
</html>
