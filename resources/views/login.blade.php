<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Masuk Akun</title>
    @vite('resources/css/app.css')
</head>
<body class="m-0 p-0 bg-black/10">
    <div class="w-screen h-screen flex relative">
        <div class="flex justify-around w-[75%] h-[75%] rounded-2xl shadow-xl bg-white m-auto">
            <div class="flex w-[40%] h-full rounded-2xl">
                <form method="post" action="/login" class="w-[75%] m-auto">
                    @csrf
                    <div class="username-contextor w-full">
                        <label class="font-bold italic text-black/70" for="username">Username</label>
                        <input class="mt-1 transition-all ease-in-out duration-300 focus:px-5 py-2 w-full border-b-2 outline-black/40" type="text" name="username" id="username" value="{{ old('username') }}" placeholder="username anda">
                        
                        
                        @error('username')
                        <p class="text-sm text-red-500 text-right">
                            {{ $message }} 
                        </p>
                        @enderror 
                    </div>

                    <div class="password-contextor w-full mt-5">
                        <label class="font-bold italic text-black/70" for="password">Password</label>
                        <div class="w-full flex justify-around gap-5">
                            <input class="mt-1 transition-all ease-in-out duration-300 focus:px-5 py-2 w-full border-b-2 outline-black/40" type="password" name="password" id="password" placeholder="password anda">
                            <div class="flex w-10">
                                <button type="button" onclick="showPassword()">
                                    <svg class="h-full w-full" fill="#000000" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="XMLID_6_"> <path id="XMLID_7_" d="M165.003,51.977C75.275,51.977,5.55,152.253,2.625,156.522c-3.5,5.109-3.5,11.845,0,16.955 c2.925,4.268,72.65,104.546,162.378,104.546c89.712,0,159.446-100.277,162.371-104.545c3.501-5.11,3.501-11.846,0-16.956 C324.449,152.253,254.715,51.977,165.003,51.977z M165.003,206.655c-23.015,0-41.67-18.627-41.67-41.655 c0-23.027,18.655-41.654,41.67-41.654c23,0,41.669,18.627,41.669,41.654C206.672,188.028,188.003,206.655,165.003,206.655z"></path> </g> </g></svg>
                                </button>
                            </div>
                        </div>
                        @error('password')
                        <p class="text-sm text-red-500 text-right">
                            {{ $message }} 
                        </p>
                        @enderror 
                    </div>

                    <div class="login-contextor w-full mt-9 justify-between flex">
                        <button class="bg-blue-500 px-5 py-2 rounded-lg text-white">
                            Masuk Akun Anda
                        </button>
                    </div>

                    <div class="login-contextor w-full mt-3">
                        <span class="mr-3">
                            Belum Mempunyai Akun?, 
                        </span>

                        <a href="/register" class="w-fit underline underline-offset-2">
                            Daftar Sekarang
                        </a> 
                    </div>
                </form>
            </div>

            <div class="w-[60%] h-full rounded-2xl bg-black/20">
                <img src="images/side/login-image.png" alt="" class="object-cover w-full rounded-2xl shadow-2xl">
            </div>
        </div>
    </div>

    <script>
        function showPassword(){
            const target = document.querySelector('#password');
            if(target.type == 'password') target.type = 'text';
            else target.type = 'password'; 
        }
    </script>
</body>
</html>