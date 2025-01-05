<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $place->name }}</title>
    @vite('resources/css/app.css')
</head>
<body class="m-0 p-0 bg-black/10">
    <x-navbar :user="$user">
        {{-- navbar here --}}
    </x-navbar>

    <form method="post" action="/request-booking" class="w-full h-full flex relative">
        @csrf
        <x-popup.booking>
            {{-- popup untuk konfirmasi pembayaran --}}
        </x-popup.booking>

        <div class="w-[75%] gap-3 flex justify-between h-96 m-auto">
            <div class="left-side w-7/12">
                {!! $place->place_details->maps !!}
            </div>
            
            <div class="right-side w-5/12">
                <div class="flex flex-col gap-4 p-10">
                    <input type="hidden" name="place_id" value="{{ $place->id }}">
                    <input type="hidden" name="price" value="{{ $place->price }}">
                    
                    <div>
                        <label for="bookingDate" class="block text-sm font-medium text-gray-700">Booking untuk (tanggal)</label>
                        <input type="date" id="bookingDate" name="booking_for" class="py-2 px-4 mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="bookingTotal" class="block text-sm font-medium text-gray-700">Booking total</label>
                        <input type="number" id="bookingTotal" name="quantity" class="py-2 px-4 mt-1 block w-full border-gray-300 rounded-md shadow-sm" oninput="calculateTotal()">
                    </div>
                    <div>
                        <label for="total" class="block text-sm font-medium text-gray-700">Total</label>
                        <input type="text" id="total" name="total" class="py-2 px-4 mt-1 block w-full border-gray-300 rounded-md shadow-sm" readonly>
                    </div>
                    <button onclick="sendConfirmation()" type="button" class="mt-4 px-4 py-2 bg-blue-400 text-white rounded-md">
                        Pesan Sekarang
                    </button>
                </div>

                {{-- lorem ipsum dolor sit amet --}}

                <script>
                    // catatan : untuk kedepannya, demi keamanan berikan validasi price sebelum mengirimkan link checkout
                    const pricePerUnit = {{ $place->price }};
                    
                    function calculateTotal() {
                        const bookingTotal = document.getElementById('bookingTotal').value;
                        const total = bookingTotal * pricePerUnit;
                        document.getElementById('total').value = total;
                    }
                </script>
            </div>
        </div>
    </form>

    <x-footer>
        {{-- footer here --}}
    </x-footer>

    {{-- embedded maps script --}}
    <script>
        document.querySelectorAll('iframe').forEach((iframe) => {
            iframe.setAttribute('height', '');
            iframe.setAttribute('width', '');
            iframe.classList.add('w-full');
            iframe.classList.add('h-full');
        });
    </script>

    {{-- booking alert --}}
    @error('log')
    <script>
        alert('{{ $message }}')
    </script>
    @enderror

    {{-- booking confirmation --}}
    <script>
        document.getElementById('booking-popup').classList.add('hidden');

        function sendConfirmation() {
            document.getElementById('booking-popup').classList.remove('hidden');
        }
    </script>
</body>
</html>
