<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Histori Tiket</title>
    @vite('resources/css/app.css')
</head>
<body class="m-0 p-0 bg-black/10">
    <x-navbar :user="$user"> 
        {{-- navbar here --}}
    </x-navbar>

    <div class="container w-[97%] mx-auto max-w-[70rem] flex justify-between gap-6 relative">
        <x-popup.refund>
            {{-- refund here --}}
        </x-popup.refund>

        <script>
            function showRefundPopup(invoice_number) {
                document.getElementById('refund-popup').classList.remove('hidden');
                document.getElementById('button-trigger').addEventListener('click', function () {
                    window.location.href = `/refund/${invoice_number}`;
                });
            }

            function closeRefundPopup() {
                document.getElementById('refund-popup').classList.add('hidden');
            } closeRefundPopup();
        </script>
        
        <x-account.sidebar :user="$user" :reservation_details="$reservation_details">
            {{-- sidebar here --}}
        </x-account.sidebar>

        <div class="w-2/3">
            <div class="ticket-history">
                <h2 class="text-2xl font-bold mb-2">Histori Tiket Anda</h2>
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
                    <div class="h-[40rem]" id="ticket-container">
                        @foreach ($reservation_details as $reservation)
                        <div class="relative have-ticket card flex justify-start hover:scale-105 hover:bg-white/80 transition-all ease-in-out duration-300 bg-white rounded-lg drop-shadow-2xl p-4 mb-4">
                            <div class="mr-4 w-1/4">
                                <img class="w-full rounded-lg object-cover drop-shadow-md" src="https://asset.kompas.com/crops/OMWdPdZFS8UpJpupQdojw_07ixk=/0x0:1000x667/1200x800/data/photo/2020/03/10/5e677a1b83e8d.jpg" alt="Sample Image">
                            </div>
                            <div class="w-2/3">
                                <div class="top-contextor h-2/3">
                                    <h3 class="text-xl font-bold">{{ $reservation->place->name }}</h3>
                                    <p class="text-gray-700 w-11/12 text-sm">{{ $reservation->booking_for }}</p>
                                    <p class="mb-2 w-11/12 text-blue-500 text-lg font-bold">{{ $reservation->unit_price * $reservation->quantity }}</p>
                                </div>

                                <div class="bottom-contextor h-1/3">
                                    <a class="bg-green-500 px-7 py-2 text-white rounded-lg font-bold text-sm">
                                        {{ ($reservation->reservation->status == '0') ? 'Pembayaran Ditangguhkan' : 'Pembayaran Berhasil' }}
                                    </a>
                                    
                                    @if ($reservation->reservation->status == '1' && $reservation->refund == null)
                                    <button onclick="showRefundPopup({{ $reservation->reservation->reservation_invoice }})" class="hover:scale-110 transition-all ease-in-out duration-300 ml-3 bg-red-700 px-7 py-2 text-white rounded-lg font-bold text-sm">
                                        Batalkan
                                    </button>
                                    @endif
                                        
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="flex justify-end mt-4">
                        <button id="prev-page" class="px-4 py-2 hover:bg-white/80 hover:scale-110 transition-all ease-in-out duration-500 hover:text-blue-500 bg-blue-500 text-white rounded-lg mr-2">Sebelumnya</button>
                        <span id="page-number" class="px-4 py-2 text-gray-700"></span>
                        <button id="next-page" class="px-4 py-2 hover:bg-white/80 hover:scale-110 transition-all ease-in-out duration-500 hover:text-blue-500 bg-blue-500 text-white rounded-lg">Selanjutnya</button>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const itemsPerPage = 4;
                            const container = document.getElementById('ticket-container');
                            const tickets = container.children;
                            const totalPages = Math.ceil(tickets.length / itemsPerPage);
                            let currentPage = 1;

                            function showPage(page) {
                                for (let i = 0; i < tickets.length; i++) {
                                    tickets[i].style.display = 'none';
                                }
                                const start = (page - 1) * itemsPerPage;
                                const end = start + itemsPerPage;
                                for (let i = start; i < end && i < tickets.length; i++) {
                                    tickets[i].style.display = 'flex';
                                }
                                document.getElementById('page-number').textContent = `Page ${page} of ${totalPages}`;
                            }

                            document.getElementById('prev-page').addEventListener('click', function () {
                                if (currentPage > 1) {
                                    currentPage--;
                                    showPage(currentPage);
                                }
                            });

                            document.getElementById('next-page').addEventListener('click', function () {
                                if (currentPage < totalPages) {
                                    currentPage++;
                                    showPage(currentPage);
                                }
                            });

                            showPage(currentPage);
                        });
                    </script>
                @endif
            </div>
        </div>
    </div>

    <x-footer>
        {{-- footer here --}}
    </x-footer>
</body>
</html>