<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ayo Piknik!</title>
    @vite('resources/css/app.css')
</head>
<body class="m-0 p-0 bg-black/10">
    <x-navbar :user="$user">
        {{-- navbar here --}}
    </x-navbar>
    
    <form method="POST" action="/find" class="mx-auto h-[36rem] flex relative drop-shadow-2x">
        @csrf
        <img class="absolute inset-0 w-full h-full object-cover -z-10" src="images/background/main-search.png" alt="Background Image">
        <div class="flex flex-col mx-auto mt-[13rem] w-96 text-black/70 drop-shadow-2xl">
            <span class="mb-2 text-3xl text-white/80 text-center font-semibold">Yuk, Mau Ke Mana Kita?</span>
            <input type="text" id="search-input" name="search" class="w-full max-w-md py-2 px-4 border border-gray-300 rounded focus:outline-none focus:border-transparent" placeholder="Contoh : Tempat Sejuk di Baturaden">
            <div id="recommendations" class="mt-2 bg-white border border-gray-300 rounded shadow-lg hidden"></div>
        </div>
    </form>

    <div class="w-10/12 mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-4 text-left">Rekomendasi Destinasi</h2>
        <div class="drop-shadow-md grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @php $counter = 0;
                $placesToShow = $places->count() > 7 ? $places->random(8) : $places->random(4);
            @endphp

            @foreach ($placesToShow as $place)
                @php $counter++; @endphp
                <a href="/detail/{{ $place->slug }}" class="relative cursor-pointer bg-white rounded shadow h-48 drop-shadow-2xl overflow-hidden">
                    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $place->header_image }}');"></div>
                    <div class="relative w-full h-full p-4 text-white/0 duration-500 ease-in-out hover:bg-black/50 hover:text-white">
                        <h3 class="text-xl font-semibold mb-2">{{ $place->name }}</h3>
                        <p class="hover:text-gray-200">{{ $place->place_details->city }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <div class="w-10/12 mx-auto mt-16" id="contact">
        <h2 class="text-2xl font-bold text-left">Hiburan dan Akses Informasi</h2>
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/3 py-4 drop-shadow-2xl">
                <div class="rounded h-full">
                    <iframe style="border-radius:12px" src="https://open.spotify.com/embed/episode/1zusmEevmKA2UR6q9qC2eY?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
                </div>
            </div>
            
            <div class="w-full md:w-2/3 pl-4 py-4 flex items-stretch">
                <div class="bg-white rounded shadow p-4 flex-grow">
                    <h3 class="px-2 h-fit text-xl font-semibold mb-1">Akses Informasi Publik</h3>
                    <p class="px-2 h-fit">Dukungan konsumen dan informasi publik dapat diakses melalui link ini</p>
                    <div class="flex h-64">
                        <div class="w-full p-2">
                            <iframe class="w-full h-full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15825.187071887156!2d109.22881134400622!3d-7.432375981252802!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655ea49d9f9885%3A0x62be0b6159700ec9!2sTelkom%20Purwokerto%20University!5e0!3m2!1sid!2sid!4v1735100339444!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer>
        {{-- footer --}}
    </x-footer>

    <script>
        function scrollToQNA() {
            document.querySelector('#qna-section').scrollIntoView({ behavior: 'smooth' });
        }
    </script>

    {{-- search input feature --}}
    <script>
        document.getElementById('search-input').addEventListener('input', function() {
            const recommendations = document.getElementById('recommendations');
            const query = this.value;

            if (query.length > 0) {
                // Simulate fetching recommendations
                const sampleRecommendations = [
                    'Tempat Sejuk di Baturaden',
                    'Pantai Indah di Bali',
                    'Wisata Kuliner di Bandung',
                    'Tempat Bersejarah di Yogyakarta'
                ];

                const filteredRecommendations = sampleRecommendations.filter(item => item.toLowerCase().includes(query.toLowerCase()));

                recommendations.innerHTML = filteredRecommendations.map(item => `<div class="px-4 py-2 hover:bg-gray-200 cursor-pointer">${item}</div>`).join('');
                recommendations.classList.remove('hidden');
            } else {
                recommendations.classList.add('hidden');
            }
        });

        document.getElementById('recommendations').addEventListener('click', function(e) {
            if (e.target && e.target.nodeName === "DIV") {
                const searchInput = document.getElementById('search-input');
                searchInput.value = e.target.textContent;
                this.classList.add('hidden');
                searchInput.form.submit();
            }
        });
    </script>
</body>
</html>
