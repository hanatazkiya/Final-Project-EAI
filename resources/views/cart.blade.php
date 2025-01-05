<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tiket Terbaru</title>
    <script src="https://sandbox.doku.com/jokul-checkout-js/v1/jokul-checkout-1.0.0.js"></script>
    @vite('resources/css/app.css')
</head>
<body class="m-0 p-0 bg-black/10">
    <x-navbar :user="$user">
        {{-- navbar here --}}
    </x-navbar>

    <div class="container w-[97%] mx-auto max-w-[70rem] flex justify-between gap-6 relative">
        
        {{-- sample generated qr code --}}
        {{-- <div class="absolute inset-0 flex w-96 h-96 left-[35%] top-[15%] items-center justify-center z-10">
            <div class="bg-white w-full h-full p-4 rounded-lg shadow-lg">
                <img class="w-full h-full" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=Example" alt="QR Code">
            </div>
        </div> --}}

        <x-account.sidebar :user="$user" :reservation_details="$reservation_details">
            {{-- sidebar here --}}
        </x-account.sidebar>

        <div class="w-2/3">
            <div class="promo-banner w-full h-48 bg-blue-500/80 rounded-2xl drop-shadow-2xl mb-4">
                <div class="w-full h-full">
                    <img alt="gambar banner" class="w-full h-full opacity-90 drop-shadow-2xl object-cover" src="/images/header/banner.png">
                </div>
            </div>
            <div class="ticket-history">
                <h2 class="text-2xl font-bold mb-2">Tiket Terbaru</h2>
                @if ($reservation_details->count() == 0)
                <div class="no-ticket card flex justify-start bg-white rounded-lg shadow-md p-4 mb-4">
                    <div class="mr-4">
                        <img class="rounded-lg" src="https://ik.imagekit.io/tvlk/image/imageResource/2017/11/06/1509969696508-63e4a83e52864cf123f6cc7a9ee356fd.png?tr=q-75,w-175" alt="Sample Image">
                    </div>
                    <div class="w-2/3">
                        <h3 class="text-xl font-bold mb-2">Tidak Ada Tiket Tersedia</h3>
                        <p class="text-gray-700 mb-2 w-11/12 text-sm">Waduh, belum ada tiket yang dipesan nih. Emang yakin kamu bener bener nggak pengen liburan?</p>
                        <a href="/" class="text-blue-500 rounded-lg font-bold">Yuk Cari Tiket!</a>
                    </div>
                </div>

                @else
                    @foreach ($reservation_details as $reservation_detail_unit)
                    <div class="relative have-ticket card flex justify-start hover:scale-105 hover:bg-white/80 transition-all ease-in-out duration-300 bg-white rounded-lg drop-shadow-2xl p-4 mb-4">
                        @if ($reservation_detail_unit->reservation->status == '0') <button onclick="getCheckoutResponse({{ $reservation_detail_unit->reservation_id }}, {{ $reservation_detail_unit->unit_price }}, {{ $reservation_detail_unit->quantity }})" class="absolute w-full h-full"></button> @endif
                        <div class="mr-4 w-1/4">
                            <img class="w-full rounded-lg object-cover drop-shadow-md" src="https://asset.kompas.com/crops/OMWdPdZFS8UpJpupQdojw_07ixk=/0x0:1000x667/1200x800/data/photo/2020/03/10/5e677a1b83e8d.jpg" alt="Sample Image">
                        </div>
                        <div class="w-2/3">
                            <div class="top-contextor h-2/3">
                                <h3 class="text-xl font-bold">{{ $reservation_detail_unit->place->name }}</h3>
                                <p class="text-gray-700 w-11/12 text-sm">{{ $reservation_detail_unit->booking_for }}</p>
                                <p class="mb-2 w-11/12 text-blue-500 text-lg font-bold"> {{ $reservation_detail_unit->unit_price }} x {{ $reservation_detail_unit->quantity }} = <span class="text-yellow-600"> {{ $reservation_detail_unit->unit_price * $reservation_detail_unit->quantity }}</span></p>
                            </div>

                            <div class="bottom-contextor h-1/3">
                                <p class="hidden" id="invoice-number-{{ $reservation_detail_unit->reservation_id }}">{{ $reservation_detail_unit->reservation->reservation_invoice }} </p>
                                <a type="button" class="{{ ($reservation_detail_unit->reservation->status == '0') ? 'bg-red-700' : 'bg-green-500' }} px-7 py-2 text-white rounded-lg font-bold text-sm">
                                    {{ ($reservation_detail_unit->reservation->status == '0') ? 'Klik Untuk Membayar' : 'Pembayaran Berhasil' }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif

                <button onclick="window.location.href='/history'" class="hover:scale-105 transition-all ease-in-out duration-300 w-full bg-white rounded-2xl drop-shadow-2xl">
                    <h1 class="text-left pl-4 text-blue-500 font-bold py-4">
                        Lihat Semua Tiket Historikal
                    </h1>
                </button>
            </div>
        </div>
    </div>

    <x-footer>
        {{-- footer here --}}
    </x-footer>

    <script>
        async function getCheckoutResponse(invoice_number_id, price_input, quantity_input) {
            if(price_input <= 0 || isNaN(price_input)) return false;
            let invoice_number_input = document.getElementById("invoice-number-" + invoice_number_id).innerHTML;
            invoice_number_input = parseInt(invoice_number_input, 10);

            try {
                const response = await fetch('/checkout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        invoice_number: invoice_number_input, 
                        price: price_input,
                        quantity: quantity_input,
                    })
                });

                // ketika kode response bukan 200
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();
                loadJokulCheckout(data.response.payment.url); 

                return data;
            } catch (error) {
                console.log(error);
                alert('Terjadi kesalahan, silahkan coba lagi', error);
            }
        }
    </script>
</body>
</html>
