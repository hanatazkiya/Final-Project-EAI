<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ayo Piknik Yuk!</title>
    <link rel="stylesheet" href="custom/plane.css">
    @vite('resources/css/app.css')
</head>
<body class="m-0 p-0 bg-black/10 overflow-x-hidden">
    <x-navbar>
        {{-- navbar here --}}
    </x-navbar>

    <div class="relative flex w-full h-[30rem] justify-between mt-7">
        <div class="w-28 absolute animate-bounce">
            <img class="w-full plane-content" src="images/header/plane.png" alt="">
        </div>

        <div class="flex left-element w-full h-full">
            <div class="image-content m-auto h-full">
                <img class="m-auto h-full scale-110" src="images/header/header-image.png">
            </div>
        </div>

        <div class="flex right-element w-full mx-10 h-full -translate-x-16">
            <div class="contextor my-auto">
                <h1 class="text-5xl font-bold text-blue-500/90">
                    Dunia Itu Luas, Ayo Berwisata!
                </h1>

                <p class="text-xl mt-5 text-justify text-black/60">
                    Nikmati liburan seru bersama keluarga dan teman-teman! Pesan tiket sekarang dan jelajahi destinasi impian Anda dengan harga terjangkau. Jangan lewatkan kesempatan untuk menciptakan kenangan indah di tempat-tempat eksotis. Ayo, rencanakan liburan Anda hari ini!
                </p>

                <div class="flex w-full button-contextor mt-5">
                    <a href="/login" class="bg-blue-400 text-white/80 hover:scale-110 hover:bg-blue-600 drop-shadow-xl transition-all duration-300 px-6 py-3 rounded-xl text">
                        Pesan Tiket Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden w-[80%] mx-auto content-container bg-blue-400 rounded-3xl mt-28">
        <div class="bg-white rounded-xl mx-auto w-fit flex -translate-y-[50%]">
            <h1 class="text-xl font-bold text-blue-500/80 w-fit h-fit m-auto px-28 py-4">
                KEUNGGULAN KAMI
            </h1>
        </div>
        
        <div class="mx-auto w-[80%] h-96">

        </div>
    </div>

    <div class="m-auto w-[80%] mt-28">
        <h1 class="text-3xl text-blue-500 font-bold">
            WISATA SEDANG RAMAI
        </h1>

        <div class="mt-5 w-full flex justify-around gap-5">
            @php $counter = 0; @endphp
            @foreach ($places as $place)
                @php if($counter == 4) break @endphp
                <a href="/login" class="h-80 w-full bg-black/10 rounded-xl relative group drop-shadow-2xl">
                    <img class="w-full h-full object-cover rounded-xl" src="{{ $place->place_images->first()->filename }}" alt="Highlight Image {{ $place->name }}">
                    <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl flex items-end">
                        <p class="text-white text-2xl font-bold p-4">{{ $place->name }}</p>
                    </div>
                </a>
                @php $counter++; @endphp
            @endforeach
        </div>

        @php $selected = $places->where('id', 5)->first(); @endphp
        @if($selected)
            <div class="w-full mt-5 h-96 bg-black/10 rounded-xl relative group">
                <a href="/login" class="w-full h-full drop-shadow-xl">
                    <img class="w-full h-full object-cover rounded-xl" src="/{{ $selected->header_image }}" alt="Highlight Image">
                    <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl flex items-end">
                    <p class="text-white text-2xl font-bold px-10 py-5">{{ $selected->name }}</p>
                    </div>
                </a>
            </div>

        @else
            <div class="w-full mt-5 h-96 bg-black/10 rounded-xl relative group">
                <a href="/login" class="w-full h-full drop-shadow-xl">
                    <img class="w-full h-full object-cover rounded-xl" src="images/body/highlight-image-5.png" alt="Highlight Image">
                    <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl flex items-end">
                    <p class="text-white text-2xl font-bold px-10 py-5">Widuri, Pemalang</p>
                    </div>
                </a>
            </div>
        @endif
    </div>

    <div class="m-auto w-[80%] mt-24">
        <h1 class="text-3xl text-blue-500 font-bold">
            REKOMENDASI UNTUK ANDA
        </h1>

        <div class="mt-5 w-full flex justify-around gap-5">
            @php $counter = 0;
                $placesToShow = $places->count() > 7 ? $places->random(4) : $places->take(4);
            @endphp

            @foreach ($placesToShow as $place)
                <a href="/login" class="h-40 w-full bg-black/10 rounded-xl drop-shadow-2xl">
                    <div class="relative group h-full w-full">
                        <img class="w-full h-full object-cover rounded-xl" src="{{ $place->place_images->first()->filename }}" alt="Highlight Image {{ $place->name }}">
                        <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl flex items-end">
                            <p class="text-white text-2xl font-bold p-4">{{ $place->name }}</p>
                        </div>
                    </div>
                </a>
                @php $counter++; @endphp
            @endforeach
        </div>
    </div>

    <x-footer>
        {{-- footer here --}}
    </x-footer>
</body>
</html>