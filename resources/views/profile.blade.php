<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $user->name }}</title>
    @vite('resources/css/app.css')
</head>
<body class="m-0 p-0 bg-black/10">
    <x-navbar :user="$user">
        {{-- navbar here --}}
    </x-navbar>

    <div class="container w-[97%] mx-auto max-w-[70rem] flex justify-between gap-6 relative">
        <x-account.sidebar :user="$user" :reservation_details="$reservation_details">
            {{-- sidebar here --}}
        </x-account.sidebar>

        <div class="w-2/3">
            <form action="/profile" method="post" enctype="multipart/form-data" class="flex promo-banner w-full h-72 bg-white/90 rounded-2xl drop-shadow-2xl mb-4">
                @csrf
                <div class="flex gap-4 w-10/12 my-auto">
                    <div class="w-1/2 flex flex-col items-center">
                        <div class="relative w-48 h-48 rounded-full overflow-hidden bg-gray-200 cursor-pointer drop-shadow-2xl">
                            {{-- reminder : change this --}}
                            <img id="image-preview" class="w-full h-full object-cover" src="{{ asset($user->profile_image) }}" alt="Image Preview">
                            <input type="file" id="image" name="profile_image" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer" onchange="previewImage(event)">
                        </div>
                        <p class="text-center text-sky-800 mt-2">(Klik Gambar Untuk Ganti)</p>
                    </div>
                    <div class="w-1/2">
                        <div class="name-contextor mb-7 w-full">
                            <label class="flex font-bold" id="name-label" for="name">Nama Baru<div id="name-invalid-label" class="text-red-500 animate-form-invalid-danger"></div></label>
                            <input class="focus:outline-none mt-1 transition-all ease-in-out duration-300 focus:px-5 py-2 w-full border-b-2 outline-black/40 bg-transparent" type="text" name="name" id="name" placeholder="Kapital Diabaikan, Min 8 Karakter">
                        </div>
                        <div class="email-contextor w-full">
                            <label class="flex font-bold" id="email-label" for="email">Email Baru<div id="email-invalid-label" class="text-red-500 animate-form-invalid-danger"></div></label>
                            <input class="focus:outline-none mt-1 transition-all ease-in-out duration-300 focus:px-5 py-2 w-full border-b-2 outline-black/40 bg-transparent" type="text" name="email" id="email" placeholder="Contoh : widiaayu@gmail.com">
                        </div>
                        <div class="email-contextor w-full">
                            <button type="submit" class="w-full py-2 drop-shadow-2xl bg-blue-400 hover:bg-blue-400/80 hover:scale-110 duration-500 transition-all text-white rounded-lg mt-4" type="submit">
                                Lakukan Perubahan
                            </button>
                        </div>
                    </div>
                </div>

                <script>
                    function previewImage(event) {
                        const reader = new FileReader();
                        reader.onload = function() {
                            const output = document.getElementById('image-preview');
                            output.src = reader.result;
                            output.style.display = 'block';
                        };
                        reader.readAsDataURL(event.target.files[0]);
                    }
                </script>
            </form>
        </div>
    </div>

    <x-footer>
        {{-- footer here --}}
    </x-footer>
</body>
</html>
