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
    <div class="container w-[97%] h-screen mx-auto max-w-[70rem] flex justify-between gap-6 relative">
        <div class="rounded-2xl flex w-[75%] h-[75%] m-auto bg-white/80 drop-shadow-2xl">
            <div class="flex justify-between w-[75%] m-auto h-[75%]">
                <div class="w-1/2 flex items-center justify-center">
                    <img class="w-full scale-110 m-auto" src="{{ asset('images/admin/assets/images/login/header.png') }}" alt="Login Image" class="rounded-2xl">
                </div>
                <div class="w-1/2 flex items-center justify-center">
                    <form method="post" action="/admin/login" class="w-full max-w-sm bg-white p-6 rounded-lg shadow-md">
                        @csrf
                        <div class="mb-5">
                            <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                            <input placeholder="Username Admin" type="text" id="username" value="{{ old('username') }}" name="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('username')
                                <p class="text-sm text-right mt-1 text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                            <input placeholder="Password Admin" type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
                            @error('password')
                                <p class="text-sm text-right mt-1 text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500/90 duration-300 transition-all ease-in-out w-full hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Masuk Akun
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
