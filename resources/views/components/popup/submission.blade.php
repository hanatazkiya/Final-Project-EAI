<div id='popup-submission' class="bg-black/50 w-screen h-screen absolute">
    <div class="w-[30rem] h-fit pb-10 mx-auto mt-[7vh] rounded-xl shadow-2xl drop-shadow-2xl bg-white/50">
        <div class="flex information-icon-contextor w-[80%] mx-auto h-12 rounded-xl mt-7">
            <div class="bg-blue-600/80 rounded-full flex information-icon w-12 h-full">
                <p class="text-2xl text-center m-auto text-white/80">
                    i
                </p>
            </div>

            <div class="ml-3 h-full flex information-text">
                <p class="text-2xl my-auto text-blue-600/80">
                    Konfirmasi Registrasi
                </p>
            </div>
        </div>

        <div class="flex information-content-contextor w-[80%] mx-auto bg-white/50 drop-shadow-xl rounded-xl mt-6">
            <p class="mx-4 my-3 text-md">
                Semua form yang kamu isi sudah valid, apakah kamu sudah selesai mengisi form dan akan melanjutkan ke tahap submission?
            </p>    
        </div>

        <div class="flex justify-start gap-5 text-white/70 information-content-contextor w-[80%] mx-auto rounded-xl mt-6">
            <button type="button" onclick="hideSubmissionPopup()" class="bg-red-500/80 hover:scale-110 duration-300 ease-in-out hover:bg-red-700 hover:text-white/80 px-5 py-2 rounded-xl drop-shadow-xl">
                Batalkan
            </button>

            <button type="submit" class="bg-yellow-600/80 hover:scale-110 duration-300 ease-in-out hover:bg-yellow-700 hover:text-white/80 px-5 py-2 rounded-xl drop-shadow-xl">
                Ya, Kirim Data
            </button>
        </div>
    </div>
</div>

<script>
    const contextor = document.getElementById('popup-submission');
    contextor.classList.add('hidden'); contextor.classList.add('-z-10');

    function hideSubmissionPopup(){
        contextor.classList.replace('flex', 'hidden');
        contextor.classList.replace('z-10', '-z-10');
    }

    function showSubmissionPopup(){
        generateMessage();
        contextor.classList.replace('hidden', 'flex');
        contextor.classList.replace('-z-10', 'z-10');
    }
</script>