<div id="admin-confirmation" class="hidden fixed w-96 bg-white/80 drop-shadow-2xl shadow-lg rounded-xl z-30 top-1/3 left-1/2 transform -translate-x-1/2 -translate-y-1/2 justify-center">
    <div class="top-container flex w-80 h-14 mx-auto mt-6">
        <div class="i-icon">
            <div class="w-14 h-14 rounded-full flex bg-blue-400/90 drop-shadow-2xl">
                <p class="text-3xl text-center font-bold m-auto text-white/80">
                    i
                </p>
            </div>
        </div>

        <div class="text-contextor flex">
            <p class="text-xl my-auto ml-4 font-bold text-blue-400 drop-shadow-xl">
                Konfirmasi Pengembalian
            </p>
        </div>
    </div>

    <div class="middle-container flex w-80 mx-auto mt-6 bg-gray-500/20 rounded-xl drop-shadow-2xl text-black px-5 py-2">
        <p class="text text-justify">
            Dengan menekan tombol "Verifikasi" berarti anda sudah benar benar menyelesaikan pengembalian dana kepada pengguna.
        </p>
    </div>

    <div class="bottom-container gap-10 pb-6 flex justify-between w-80 mx-auto mt-6">
        <button onclick="hidePopup()" class="bg-red-500 w-full hover:scale-110 ease-in-out transition-all duration-300 hover:bg-yellow-500  py-2 drop-shadow-2xl rounded text-white/90" type="button">
            Kembali
        </button>
        
        <button id="admin-confirmation-button" type="button" class="bg-blue-400 w-full hover:scale-110 ease-in-out transition-all duration-300 hover:bg-yellow-500  py-2 drop-shadow-2xl rounded text-white/90" type="submit">
            Verifikasi
        </button>
    </div>
</div>
