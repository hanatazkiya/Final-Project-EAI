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

    {{-- debug  : style="height: calc(100vh - 11rem);" --}}
    <form method="post" action="/admin/update/request" class="w-full flex mt-10">
        @csrf
        <div class="w-[60%] m-auto bg-white/80 rounded-xl drop-shadow-xl p-4">
            <div class="flex w-full justify-between">
                <div class="w-1/2 p-4">
                    <div class="mt-1 relative w-full h-64 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer flex items-center justify-center" onclick="document.getElementById('image').click()">
                        <span class="text-gray-500">Tekan Untuk Unggah Gambar Header</span>
                        <img id="imagePreview" class="absolute w-full rounded-md drop-shadow-2xl h-64 object-cover" src="{{ $place->header_image }}" alt="Image Preview" style="display: none;">
                    </div>
                    <input type="file" id="image" name="header_image" class="hidden" accept="image/*" onchange="previewImage(event)">
                </div>
                <div class="flex w-1/2 p-4">
                    <div class="m-auto w-[90%] h-[90%] text-black/80">
                        <label for="name" class="block text font-medium">Nama Tempat</label>
                        <input placeholder="Contoh : Andhang Pangrenan" type="text" value="{{ $place->name }}" id="name" name="name" class="mt-1 placeholder:text-black/60 block w-full bg-transparent border-b-2 border-b-black/30 py-2 focus:px-4 outline-none transition-all ease-in-out duration-300">

                        <label for="city" class="block text font-medium mt-4">Nama Kota</label>
                        <input placeholder="Contoh : Purwokerto" type="text" id="city" value="{{ $place->place_details->city }}" name="city" class="mt-1 placeholder:text-black/60 block w-full bg-transparent border-b-2 border-b-black/30 py-2 focus:px-4 outline-none transition-all ease-in-out duration-300">

                        <label for="price" class="block text font-medium mt-4">Harga Tiket</label>
                        <input placeholder="Contoh : 7500" type="number" id="price" value="{{ $place->price }}" name="price" class="mt-1 placeholder:text-black/60 block w-full bg-transparent border-b-2 border-b-black/30 py-2 focus:px-4 outline-none transition-all ease-in-out duration-300">
                    </div>
                </div>

                <script>
                    function previewImage(event) {
                        const reader = new FileReader();
                        reader.onload = function(){
                            const output = document.getElementById('imagePreview');
                            output.src = reader.result;
                            output.style.display = 'block';
                        };
                        reader.readAsDataURL(event.target.files[0]);
                    }
                </script>
            </div>

            <div class="w-full flex">
                <div class="w-full p-4">
                    <label for="maps" class="block text font-medium text-black/80">Embed Peta</label>
                    <div id="maps-embed" class="mt-2 hidden w-full h-48">
                        {{-- maps will shown here --}}
                    </div>
                    <input type="text" id="maps" name="maps" placeholder="Masukkan Embed Peta" class="mt-1 placeholder:text-black/60 block w-full bg-transparent border-b-2 border-b-black/30 py-1 focus:px-4 outline-none transition-all ease-in-out duration-300">
                    <p id="maps-notification" class="mt-2 text-sm text-black/60 text-right">
                        Teks Masih Kosong
                    </p>
                </div>

                <script>
                    function validateInputMaps(link){
                        const mapsNotification = document.getElementById('maps-notification');
                        const isValidMapsLink = link.includes('iframe') && link.includes('src="https://www.google.com/maps/embed');
                        link = link.replace(/</g, "&lt;").replace(/>/g, "&gt;"); // avoid xss attack

                        if(link.trim() == ''){
                            mapsNotification.innerHTML = 'Teks Masih Kosong';
                            return -1;
                        }

                        else if(isValidMapsLink){
                            mapsNotification.innerHTML = 'Peta Telah Diembed';
                            return 1;
                        } 

                        else if(isValidMapsLink == false){
                            mapsNotification.innerHTML = 'Peta Bukan Berasal Dari Google Maps';
                            return 0;
                        }
                    }

                    document.getElementById('maps').addEventListener('input', function () {
                        const mapsEmbed = document.getElementById('maps-embed');
                        if(validateInputMaps(this.value) != 1) {
                            mapsEmbed.classList.add('hidden'); return;
                        } const mapsInput = this.value.trim();

                        if (mapsInput) {
                            mapsEmbed.innerHTML = mapsInput;
                            mapsEmbed.classList.remove('hidden');
                            document.querySelectorAll('iframe').forEach((item) => {
                                item.classList.add('w-full'); item.classList.add('h-full');
                                item.classList.add('rounded'); item.classList.add('drop-shadow-sm');
                            });
                        } 
                        
                        else {
                            mapsEmbed.classList.add('hidden');
                        }
                    });
                </script>
            </div>

            <div class="flex w-full justify-between">
                <div class="w-full p-4">
                    <div class="short-description mb-10">
                        <label for="short_description" class="block text font-medium text-black/80">Deskripsi Singkat</label>
                        <textarea placeholder="Contoh : Tempat wisata yang indah dan nyaman" id="short_description" name="short_description" class="my-3 placeholder:text-black/60 block w-full bg-transparent outline outline-1 outline-black/30 py-2 px-4 outline-none transition-all ease-in-out duration-300" maxlength="240">{{ $place->short_description }}</textarea>
                        <p id="charCount" class="text-sm text-gray-500">0/240 characters</p>

                        <script>
                            document.getElementById('short_description').addEventListener('input', function () {
                                const maxLength = 240;
                                const currentLength = this.value.length;
                                document.getElementById('charCount').textContent = `${currentLength}/${maxLength} characters`;
                            });
                        </script>
                    </div>

                    <div class="description mb-10">
                        <label for="description" class="block text font-medium text-black/80 mt-4">Deskripsi</label>
                        <textarea placeholder="Contoh : Tempat wisata ini memiliki berbagai fasilitas..." id="description" name="description" class="my-3 placeholder:text-black/60 block w-full bg-transparent outline outline-1 outline-black/30 py-2 px-4 outline-none transition-all ease-in-out duration-300">{{ $place->place_details->description }}</textarea>
                        <p class="text-sm text-gray-500">Deskripsikan Sebaik Mungkin</p>
                    </div>
                </div>
            </div>

            <div class="w-full p-4">
                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-md">
                    Update Tempat Wisata
                </button>
            </div>
        </div>
    </form>

    <x-admin.footer>
        {{-- footer --}}
    </x-admin.footer>
</body>
</html>
