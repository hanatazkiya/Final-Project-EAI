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
    <form method="post" action="/admin/add" class="w-full flex mt-10">
        @csrf
        <div class="w-[60%] m-auto bg-white/80 rounded-xl drop-shadow-xl p-4">
            <div class="flex w-full justify-between">
                <div class="w-1/2 p-4">
                    <div class="mt-1 relative w-full h-64 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer flex items-center justify-center" onclick="document.getElementById('image').click()">
                        <span class="text-gray-500">Tekan Untuk Unggah Gambar Header</span>
                        <img id="imagePreview" class="absolute w-full rounded-md drop-shadow-2xl h-64 object-cover" src="#" alt="Image Preview" style="display: none;">
                    </div>
                    <input type="file" id="image" name="header_image" class="hidden" accept="image/*" onchange="previewImage(event)">
                </div>
                <div class="flex w-1/2 p-4">
                    <div class="m-auto w-[90%] h-[90%] text-black/80">
                        <label for="name" class="block text font-medium">Nama Tempat</label>
                        <input placeholder="Contoh : Andhang Pangrenan" type="text" id="name" name="name" class="mt-1 placeholder:text-black/60 block w-full bg-transparent border-b-2 border-b-black/30 py-2 focus:px-4 outline-none transition-all ease-in-out duration-300">

                        <label for="city" class="block text font-medium mt-4">Nama Kota</label>
                        <input placeholder="Contoh : Purwokerto" type="text" id="city" name="city" class="mt-1 placeholder:text-black/60 block w-full bg-transparent border-b-2 border-b-black/30 py-2 focus:px-4 outline-none transition-all ease-in-out duration-300">

                        <label for="price" class="block text font-medium mt-4">Harga Tiket</label>
                        <input placeholder="Contoh : 7500" type="number" id="price" name="price" class="mt-1 placeholder:text-black/60 block w-full bg-transparent border-b-2 border-b-black/30 py-2 focus:px-4 outline-none transition-all ease-in-out duration-300">
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
                        <textarea placeholder="Contoh : Tempat wisata yang indah dan nyaman" id="short_description" name="short_description" class="my-3 placeholder:text-black/60 block w-full bg-transparent outline outline-1 outline-black/30 py-2 px-4 outline-none transition-all ease-in-out duration-300" maxlength="240"></textarea>
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
                        <textarea placeholder="Contoh : Tempat wisata ini memiliki berbagai fasilitas..." id="description" name="description" class="my-3 placeholder:text-black/60 block w-full bg-transparent outline outline-1 outline-black/30 py-2 px-4 outline-none transition-all ease-in-out duration-300"></textarea>
                        <p class="text-sm text-gray-500">Deskripsikan Sebaik Mungkin</p>
                    </div>

                    <div class="features-inputfield mb-5">
                        <label for="features" class="block text font-medium text-black/80 mt-4">Fitur</label>
                        <div id="featuresList" class="mb-4 flex justify-start flex-wrap">
                            <input class="hidden" type="number" id="features-count" name="features_count" value="0">
                            <!-- Features will be added here -->
                        </div>
                        <input type="text" id="featureInput" placeholder="Misal : Mushola" class="mt-1 placeholder:text-black/60 block w-full bg-transparent border-b-2 border-b-black/30 py-2 focus:px-4 outline-none transition-all ease-in-out duration-300">
                        <p class="text-sm text-right text-gray-500">Fitur Harus 1 Kata</p>
                        <button type="button" onclick="addFeature()" class="-translate-y-2 bg-blue-500 text-white py-2 px-4 rounded">Tambahkan Fitur</button>

                        <script>
                            var featuresCounter = document.getElementById('features-count');
                            var featuresCount = 0;                            
                            function addFeature() {
                                const featureInput = document.getElementById('featureInput');
                                const featureText = featureInput.value.trim();
                                if (featureText && featureText.split(' ').length === 1) {
                                    const featureElement = document.createElement('div');
                                    const hiddenInput = document.createElement('input');
                                    const featureChild = document.createElement('span');
                                    
                                    hiddenInput.type = 'hidden'; featuresCount++;
                                    hiddenInput.name = `features-${featuresCount}`;
                                    hiddenInput.value = featureText;

                                    featureElement.className = 'flex text-black rounded mt-2 w-1/5';
                                    featureChild.textContent = featureText;
                                    featureChild.className = 'bg-black/60 rounded-xl drop-shadow-2xl text-white text-left px-4 py-2 h-full w-[95%] my-auto';
                                    
                                    featureElement.appendChild(hiddenInput);
                                    featureElement.appendChild(featureChild);
                                    document.getElementById('featuresList').appendChild(featureElement);
                                    featureInput.value = '';
                                    featuresCounter.value = featuresCount;
                                }
                            }
                        </script>
                    </div>

                    <div class="spacer h-5"></div>

                    <div class="uniqueness-inputfield mb-5">
                        <label for="uniqueness" class="block text font-medium text-black/80 mt-4">Keunikan</label>
                        <div id="uniquenessList" class="mb-4 flex justify-start flex-wrap">
                            <input class="hidden" type="number" id="uniqueness-count" name="uniqueness_count" value="0">
                            <!-- uniqueness will be added here -->
                        </div>
                        <input type="text" id="uniquenessInput" placeholder="Misal : Justin Bieber Pernah ke Sini" class="mt-1 placeholder:text-black/60 block w-full bg-transparent border-b-2 border-b-black/30 py-2 focus:px-4 outline-none transition-all ease-in-out duration-300">
                        <p class="text-sm text-right text-gray-500">Keunggulan Keunikan</p>
                        <button type="button" onclick="addUniqueness()" class="-translate-y-2 bg-blue-500 text-white py-2 px-4 rounded">Tambahkan Keunikan</button>

                        <script>
                            var uniquenessCounter = document.getElementById('uniqueness-count');
                            var uniquenessCount = 0;
                            function addUniqueness() {
                                const uniquenessInput = document.getElementById('uniquenessInput');
                                const uniquenessText = uniquenessInput.value.trim();
                                if (uniquenessText) {
                                    const uniquenessElement = document.createElement('div');
                                    const hiddenInput = document.createElement('input');
                                    const uniquenessChild = document.createElement('span');
                                    
                                    hiddenInput.type = 'hidden'; uniquenessCount++;
                                    hiddenInput.name = `uniqueness-${uniquenessCount}`;
                                    hiddenInput.value = uniquenessText;

                                    uniquenessElement.className = 'flex text-black rounded mt-2 w-1/5';
                                    uniquenessChild.textContent = uniquenessText;
                                    uniquenessChild.className = 'bg-black/60 rounded-xl drop-shadow-2xl text-white text-left px-4 py-2 h-full w-[95%] my-auto';
                                    
                                    uniquenessElement.appendChild(hiddenInput);
                                    uniquenessElement.appendChild(uniquenessChild);
                                    document.getElementById('uniquenessList').appendChild(uniquenessElement);
                                    uniquenessInput.value = '';
                                    uniquenessCounter.value = uniquenessCount;
                                }
                            }
                        </script>
                    </div>
                </div>
            </div>

            <div class="w-full">
                <label for="uniqueness" class="flex justify-start text-xl font-medium text-black/80 px-4">
                    <p class="w-fit">Gambar Tempat Wisata</p>
                </label>
                
                <div class="w-full px-4 py-1">
                    <div class="image-upload-container w-full">
                        <div class="mt-1 relative w-full py-4 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer flex items-center justify-center" onclick="document.getElementById('imageInput').click()">
                            <span class="text-gray-500">Tekan Untuk Unggah Gambar</span>
                        </div>
                        <input type="file" id="imageInput" name="images[]" class="hidden" accept="image/*" multiple onchange="previewImages(event)">
                    </div>
                    <div id="imagePreviewContainer" class="flex flex-wrap mt-4">
                        <!-- Image previews will be added here -->
                    </div>
                </div>
    
                <script>
                    function previewImages(event) {
                        const files = event.target.files;
                        const container = document.getElementById('imagePreviewContainer');
                        // container.innerHTML = ''; // aktifkan kalau ingin menghapus gambar sebelumnya
    
                        for (let i = 0; i < files.length; i++) {
                            const file = files[i];
                            const reader = new FileReader();
    
                            reader.onload = function(e) {
                                const imgElement = document.createElement('img');
                                imgElement.src = e.target.result;
                                imgElement.className = 'w-2/4 h-64 drop-shadow-2xl rounded-xl object-cover p-2';
                                container.appendChild(imgElement);
                            };
    
                            reader.readAsDataURL(file);
                        }
                    }
                </script>
            </div>

            <div class="w-full p-4">
                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-md">
                    Tambahkan Tempat Wisata
                </button>
            </div>
        </div>
    </form>

    <x-admin.footer>
        {{-- footer --}}
    </x-admin.footer>
</body>
</html>
