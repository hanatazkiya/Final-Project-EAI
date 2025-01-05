<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengembalian Dana</title>
    @vite('resources/css/app.css')
</head>
<body class="m-0 p-0 bg-black/10">
    <x-navbar :user="$user"> 
        {{-- navbar here --}}
    </x-navbar>

    <form method="post" action="/refund/send-message" class="container w-[97%] mx-auto max-w-[70rem] justify-between gap-6 relative">
        @csrf
        <div class="w-full flex justify-between gap-10">
            <div class="w-2/3 rounded-2xl drop-shadow-2xl h-96">
                {!! $place->place_details->maps !!}
            </div>
            <div class="w-1/3 bg-white drop-shadow-2xl rounded-2xl h-96">
                <div class="p-6">
                    <div class="mb-4">
                        <label for="atas_nama" class="block text-gray-700">Atas Nama</label>
                        <input type="text" id="atas_nama" name="atas_nama" value="{{ $user->name }}" readonly class="bg-gray-400/20 text-black/70 w-full mt-1 p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label for="tanggal" class="block text-gray-700">Pesan untuk Tanggal</label>
                        <input type="text" id="tanggal" name="tanggal" value="{{ $reservation->booking_for }}" readonly class="bg-gray-400/20 text-black/70 w-full mt-1 p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label for="jumlah_tiket" class="block text-gray-700">Jumlah Tiket</label>
                        <input type="text" id="jumlah_tiket" name="jumlah_tiket" value="{{ $reservation->reservation_detail->first()->quantity }}" readonly class="bg-gray-400/20 text-black/70 w-full mt-1 p-2 border rounded">
                    </div>
                    <div>
                        <label for="subtotal" class="block text-gray-700">Subtotal</label>
                        <input type="text" id="subtotal" name="subtotal" value="{{ $reservation->reservation_detail->first()->unit_price * $reservation->reservation_detail->first()->quantity }}" readonly class="bg-gray-400/20 text-black/70 w-full mt-1 p-2 border rounded">
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full bg-white rounded-2xl drop-shadow-2xl mt-10">
            <div class="px-10 pt-10 pb-5">
                <div class="mb-4">
                    <input type="number" name="reservation_invoice" value="{{ $reservation->reservation_invoice }}" class="hidden">
                    <input type="text" name="admin_username" value="{{ $place->place_details->admin_username }}" class="hidden">
                    <label for="pesan_pengembalian" class="block text-gray-700 text-2xl font-bold mb-3">Pesan Permintaan Pengembalian</label>
                    <textarea id="pesan_pengembalian" name="pesan_pengembalian" class="bg-gray-400/10 text-black/70 w-full h-60 mt-1 p-2 border rounded" rows="4">
Kepada Yth. Pihak Penyedia {{ $place->name }},
Saya yang melakukan pengajuan pengembalian dana atas nama {{ $user->name }} dengan detail pemesanan sebagai berikut:

- Tanggal Pemesanan: {{ $reservation->booking_for }}
- Jumlah Tiket: {{ $reservation->reservation_detail->first()->quantity }}
- Subtotal: {{ $reservation->reservation_detail->first()->unit_price * $reservation->reservation_detail->first()->quantity }}

Dengan ini mengajukan permintaan pengembalian dana sebesar Rp. {{ $reservation->reservation_detail->first()->unit_price * $reservation->reservation_detail->first()->quantity }} dikarenakan alasan ... 
Mohon segera diproses dan dikonfirmasi kembali kepada saya.

Berikut adalah data untuk pengembalian dana:
- Nama Bank: ...
- Nomor Rekening: ...
- Atas Nama: ...

Demikian permintaan ini saya ajukan.
Sekian dan Terima Kasih,


Salam Hormat, {{ $user->name }}
                    </textarea>
                </div>
            </div>

            <button class="w-full bg-blue-500 text-white p-3 rounded-b-2xl drop-shadow-2xl duration-300 ease-in-out transition-all hover:bg-blue-600">
                Kirim Permintaan Pengembalian
            </button>
        </div>
    </form>

    <script>
        document.querySelector('iframe').classList.add('w-full', 'h-full');
    </script>

    <x-footer>
        {{-- footer here --}}
    </x-footer>
</body>
</html>
