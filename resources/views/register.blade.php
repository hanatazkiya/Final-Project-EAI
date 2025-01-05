<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Sekarang</title>
    <link rel="stylesheet" href="custom/form-animation.css">
    @vite('resources/css/app.css')
</head>
<body class="m-0 p-0 bg-black/10">
    <form class="w-screen h-screen flex relative" onchange="checkIsFilled()" action="/register" method="post">
        @csrf
        <div class="flex justify-around w-[50rem] h-[35rem] rounded-2xl shadow-xl bg-white m-auto">
            <div class="relative left-element w-full h-full flex">
                <div class="text-blue-600/60 copywriting-contextor w-[75%] mx-auto mt-16">
                    <h1 class="text-2xl font-bold w-fit">
                        Hai, Sudah Siap?
                    </h1>
                    
                    <p class="text w-fit leading-5 mt-3">
                        Ayo mendaftar dan agendakan wisatamu sekarang juga!
                    </p>
                </div>
                <img class="select-none pointer-events-none absolute h-full scale-150 translate-x-14 -translate-y-24 drop-shadow-2xl" src="images/side/register-ilustrator.png">
            </div>

            <div class="right-element flex w-full h-full">
                <div class="w-[75%] mr-auto my-auto text-blue-500/80">
                    <div class="username-contextor w-full">
                        <label class="flex font-bold italic" id="username-label" for="username">Username <div id="username-invalid-label" class="text-red-500 animate-form-invalid-danger"></div></label>
                        <input onchange="generateMessage()" class="mt-1 transition-all ease-in-out duration-300 focus:px-5 py-2 w-full border-b-2 outline-black/40" type="text" name="username" id="username" placeholder="Kapital Diabaikan, Min 8 Karakter">
                        @error('username')
                            <p class="w-full text-right text-sm mt-1 text-red-800">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="email-contextor mt-5 w-full">
                        <label class="flex font-bold italic" id="email-label" for="email">Email<div id="email-invalid-label" class="text-red-500 animate-form-invalid-danger"></div></label>
                        <input onchange="generateMessage()" class="mt-1 transition-all ease-in-out duration-300 focus:px-5 py-2 w-full border-b-2 outline-black/40" type="email" name="email" id="email" placeholder="Contoh : support@nusanio.com">
                        @error('email')
                            <p class="w-full text-right text-sm mt-1 text-red-800">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="name-contextor mt-5 w-full">
                        <label class="flex font-bold italic" id="name-label" for="name">Nama<div id="name-invalid-label" class="text-red-500 animate-form-invalid-danger"></div></label>
                        <input onchange="generateMessage()" class="mt-1 transition-all ease-in-out duration-300 focus:px-5 py-2 w-full border-b-2 outline-black/40" type="text" name="name" id="name" placeholder="Contoh : Agus Budiman">
                    </div>

                    <div class="password-contextor w-full mt-5">
                        <label class="flex font-bold italic" id="password-label" for="password">Password<div id="password-invalid-label" class="text-red-500 animate-form-invalid-danger"></div></label>
                        <div class="w-full flex justify-around gap-5">
                            <input onchange="generateMessage()" class="mt-1 transition-all ease-in-out duration-300 focus:px-5 py-2 w-full border-b-2 outline-black/40" type="password" name="password" id="password" placeholder="Minimal 8 Karakter">
                            <div class="flex w-10">
                                <button type="button" onclick="showPassword()">
                                    <svg class="h-full w-full fill-blue-500/80" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="XMLID_6_"> <path id="XMLID_7_" d="M165.003,51.977C75.275,51.977,5.55,152.253,2.625,156.522c-3.5,5.109-3.5,11.845,0,16.955 c2.925,4.268,72.65,104.546,162.378,104.546c89.712,0,159.446-100.277,162.371-104.545c3.501-5.11,3.501-11.846,0-16.956 C324.449,152.253,254.715,51.977,165.003,51.977z M165.003,206.655c-23.015,0-41.67-18.627-41.67-41.655 c0-23.027,18.655-41.654,41.67-41.654c23,0,41.669,18.627,41.669,41.654C206.672,188.028,188.003,206.655,165.003,206.655z"></path> </g> </g></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="password-confirmation-contextor w-full mt-5">
                        <label class="flex font-bold italic" id="password-confirmation-label" for="password-confirmation">Konfirmasi Password <div id="password-confirmation-invalid-label" class="text-red-500 animate-form-invalid-danger"></div></label>
                        <div class="w-full flex justify-around gap-5">
                            <input onchange="generateMessage()" oninput="validateConfirmationInput()" class="mt-1 transition-all ease-in-out duration-300 focus:px-5 py-2 w-full border-b-2 outline-black/40" type="password" name="password_confirmation" id="password-confirmation" placeholder="Konfirmasi Password Kamu">
                            <div class="flex w-10">
                                <button type="button" onclick="showPassword('password-confirmation')">
                                    <svg class="h-full w-full fill-blue-500/80" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="XMLID_6_"> <path id="XMLID_7_" d="M165.003,51.977C75.275,51.977,5.55,152.253,2.625,156.522c-3.5,5.109-3.5,11.845,0,16.955 c2.925,4.268,72.65,104.546,162.378,104.546c89.712,0,159.446-100.277,162.371-104.545c3.501-5.11,3.501-11.846,0-16.956 C324.449,152.253,254.715,51.977,165.003,51.977z M165.003,206.655c-23.015,0-41.67-18.627-41.67-41.655 c0-23.027,18.655-41.654,41.67-41.654c23,0,41.669,18.627,41.669,41.654C206.672,188.028,188.003,206.655,165.003,206.655z"></path> </g> </g></svg>
                                </button>
                            </div>
                        </div>
                        @error('password-confirmation')
                            <p class="w-full text-right text-sm mt-1 text-red-800">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <x-popup.submission>
            {{-- popup submission here --}}
        </x-popup.submission>

        <x-popup.information>
            {{-- popup information here --}}
        </x-popup.information>
    </form>

    <script>
        function showPassword(wanted='password'){
            const target = document.querySelector(('#' + wanted));
            if(target.type == 'password') target.type = 'text';
            else target.type = 'password'; 
        }

        function checkIsFilled(){
            counter = 0; trueCounter = 0;
            document.querySelectorAll('input').forEach(inputElement => {
                if(inputElement.value != '' && inputElement.value != ' ') trueCounter += 1;
                counter += 1;
            }); if(trueCounter == counter) analyzeInput();
        }

        function validateConfirmationInput(){
            const passwd = document.querySelector('#password');
            const confim = document.querySelector('#password-confirmation');
            if(passwd.value == confim.value) showSubmissionPopup();
        }
    </script>
</body>
</html>