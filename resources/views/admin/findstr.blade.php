<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Penyedia Wisata</title>
    @vite('resources/css/app.css')
</head>
<body class="m-0 p-0 bg-black/30">
    <x-admin.navbar>    
        {{-- navbar --}}
    </x-admin.navbar>

    <div class="flex justify-center mt-10">
        <div class="w-11/12">
            <div class="flex">
                <!-- Sidebar -->
                <div class="w-1/4 p-4 bg-white/80 rounded-xl drop-shadow-xl self-start">
                    <h2 class="text-xl font-bold mb-4">Cari Tempat Wisata</h2>
                    <form method="post" action="/find">
                        @csrf
                        <div class="mb-7 relative">
                            <label for="search" class="block text-sm font-medium text-gray-700">Mau Cari Apa Nih?</label>
                            <input type="text" id="search" name="search" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" oninput="showRecommendations(this.value)">
                            <div id="search-recommendations" class="absolute z-10 w-full bg-white border border-gray-300 rounded-md mt-1"></div>
                        </div>
                        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-md">
                            Cari Sekarang
                        </button>
                    </form>
                </div>

                <script>
                    function showRecommendations(keyword) {
                        const recommendations = [
                            'Tempat Sejuk di Baturaden',
                            'Pantai di Bali',
                            'Target Wisata Pemalang',
                            'Apa Saja di Yogyakarta',
                            'Wisata Masa Lalu'
                        ];

                        const filtered = recommendations.filter(search => search.toLowerCase().includes(keyword.toLowerCase()));
                        const recommendationsDiv = document.getElementById('search-recommendations');
                        recommendationsDiv.innerHTML = '';

                        filtered.forEach(search => {
                            const div = document.createElement('div');
                            div.textContent = search;
                            div.classList.add('p-2', 'border-b', 'border-gray-300', 'cursor-pointer', 'hover:bg-gray-100');
                            div.onclick = () => {
                                document.getElementById('search').value = search;
                                recommendationsDiv.innerHTML = '';
                            };
                            recommendationsDiv.appendChild(div);
                        });

                        if (filtered.length === 0) {
                            const div = document.createElement('div');
                            div.textContent = 'No recommendations found';
                            div.classList.add('p-2', 'text-gray-500');
                            recommendationsDiv.appendChild(div);
                        }
                    }

                    document.addEventListener('click', function(event) {
                        const recommendationsDiv = document.getElementById('search-recommendations');
                        const searchInput = document.getElementById('search');
                        if (!searchInput.contains(event.target) && !recommendationsDiv.contains(event.target)) {
                            recommendationsDiv.innerHTML = '';
                        }
                    });
                </script>

                <!-- Cards Element Untuk Pengembangan -->
                <div class="w-3/4 px-4">
                    @if ($places->count() == 0)
                        <div class="w-full h-fit bg-white/80">
                            <div class="flex w-10/12 m-auto">
                                <img class="w-4/12" src="/custom/not-found.png" alt="">
                                <div class="text-center my-auto ml-10 text-black/70">
                                    <p class="text-3xl text-left font-bold">Waduh gak ketemu nih,</p>
                                    <p class="text text-left">Indonesia luas loh, cari lain lagi yuk?</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="cards-container">
                        @foreach ($places as $place)
                            <div class="bg-white/80 p-4 shadow-md rounded-md">
                                <img src="/{{ $place->header_image }}" alt="Card Image {{ $loop->iteration }}" class="w-full h-48 object-cover rounded-md mb-4">
                                <h3 class="text-lg font-bold mb-2">{{ $place->name }}</h3>
                                <p class="text-gray-700 mb-4">{{ Str::limit($place->short_description, 76, '...') }}</p>
                                <a href="/admin/update/{{ $place->slug }}" class="inline-block bg-blue-500 text-white py-2 text-center w-full rounded-md">Update Web Ini</a>
                            </div>
                        @endforeach
                    </div>
                    
                    @if ($places->count() > 9)
                    <div class="mt-10 mb-4">
                        <nav class="flex justify-end">
                            <ul class="inline-flex items-center -space-x-px" id="pagination">
                                <li>
                                    <a href="#" class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700" onclick="changePage('prev')">Previous</a>
                                </li>
                                <li id="page-numbers"></li>
                                <li>
                                    <a href="#" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700" onclick="changePage('next')">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    @endif
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const cards = Array.from(document.querySelectorAll('#cards-container > div'));
                        const pagination = document.getElementById('pagination');
                        const itemsPerPage = 9;
                        let currentPage = 1;

                        function showPage(page) {
                            const start = (page - 1) * itemsPerPage;
                            const end = start + itemsPerPage;

                            cards.forEach((card, index) => {
                                card.style.display = (index >= start && index < end) ? 'block' : 'none';
                            });
                        }

                        function updatePagination() {
                            const totalPages = Math.ceil(cards.length / itemsPerPage);
                            pagination.innerHTML = '';

                            const prev = document.createElement('li');
                            prev.innerHTML = `<a href="#" class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700">Previous</a>`;
                            prev.addEventListener('click', () => {
                                if (currentPage > 1) {
                                    currentPage--;
                                    showPage(currentPage);
                                    updatePagination();
                                }
                            });
                            pagination.appendChild(prev);

                            for (let page = 1; page <= totalPages; page++) {
                                const li = document.createElement('li');
                                li.innerHTML = `<a href="#" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">${page}</a>`;
                                li.addEventListener('click', () => {
                                    currentPage = page;
                                    showPage(currentPage);
                                    updatePagination();
                                });
                                pagination.appendChild(li);
                            }

                            const next = document.createElement('li');
                            next.innerHTML = `<a href="#" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700">Next</a>`;
                            next.addEventListener('click', () => {
                                if (currentPage < totalPages) {
                                    currentPage++;
                                    showPage(currentPage);
                                    updatePagination();
                                }
                            });
                            pagination.appendChild(next);
                        }

                        showPage(currentPage);
                        updatePagination();
                    });
                </script>
            </div>
        </div>
    </div>

    <x-admin.footer>
        {{-- footer --}}
    </x-admin.footer>
</body>
</html>
