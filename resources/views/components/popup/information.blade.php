<div id='popup-information' class="bg-black/50 w-screen h-screen absolute">
    <div class="w-[30rem] h-fit pb-10 mx-auto mt-[7vh] rounded-xl shadow-2xl drop-shadow-2xl bg-white/50">
        <div class="flex information-icon-contextor w-[80%] mx-auto h-12 rounded-xl mt-7">
            <div class="bg-blue-600/80 rounded-full flex information-icon w-12 h-full">
                <p class="text-2xl text-center m-auto text-white/80">
                    i
                </p>
            </div>

            <div class="ml-3 h-full flex information-text">
                <p class="text-2xl my-auto text-blue-600/80">
                    Informasi Penting
                </p>
            </div>
        </div>

        <div class="flex information-content-contextor w-[80%] mx-auto bg-white/50 drop-shadow-xl rounded-xl mt-6">
            <p class="mx-4 my-3 text-md" id="form-text-message">
                {{-- teks akan ditampilkan di sini --}}
            </p>    
        </div>

        <div class="flex justify-start gap-5 text-white/80 information-content-contextor w-[80%] mx-auto rounded-xl mt-6">
            <button type="button" onclick="changeVisibility()" class="bg-blue-500/80 hover:scale-110 duration-300 ease-in-out hover:bg-yellow-400 hover:text-blue-600 px-5 py-2 rounded-xl drop-shadow-xl">
                Mengerti
            </button>
        </div>
    </div>

    <script>
        window.onload = ()=> {
            const mainContent = document.querySelector('#popup-information');
            const innerText = document.querySelector('#form-text-message');
            innerText.innerHTML = 'Konfirmasi pengiriman form akan dilakukan secara otomatis setelah semua form terisi.';

            if(sessionStorage.is_understand){
                mainContent.classList.add('hidden');
                mainContent.classList.add('-z-10');
            } 
            
            else {
                mainContent.classList.add('flex');
                mainContent.classList.add('z-10');
            }
        };

        var problemList = [
            'Common',
            'Username',
            'Email',
            'Nama',
            'Password',
            'Konfirmasi Password'
        ];

        var listLabel = [
            'common',
            'username-invalid-label',
            'email-invalid-label',
            'name-invalid-label',
            'password-invalid-label',
            'password-confirmation-invalid-label',
        ];

        var commonStatus = {
            isHaveNotified : false,
            isUsernameValid : false,
            isEmailValid : false,
            isNameValid : false,
            isPasswordValid : false,
            isPasswordConfirmationValid : false
        }

        var inputElement = {
            username : document.querySelector('#username'),
            email : document.querySelector('#email'),
            name : document.querySelector('#name'),
            password : document.querySelector('#password'),
            passwordConfirmation : document.querySelector('#password-confirmation'),
        }

        function generateMessage(){
            let message = ''; let counter = 0; analyzeInput();
            for(key in commonStatus){
                if(key == 'isHaveNotified') {
                    counter += 1; continue;
                }

                else if(commonStatus[key] == false){
                    identific = 'validator-' + counter;
                    targetElement = '#' + listLabel[counter];
                    putDangerValidationOnLabel(document.querySelector(targetElement));
                    counter += 1;
                }

                else if(commonStatus[key] == true){
                    identific = 'validator-' + counter;
                    targetElement = '#' + listLabel[counter];
                    removeDangerValidationOnLabel(document.querySelector(targetElement));
                    counter += 1;
                }
            };
        }

        function putDangerValidationOnLabel(targetElement){
            targetElement.innerHTML = '( Invalid )'; 
        }

        function removeDangerValidationOnLabel(targetElement){
            targetElement.innerHTML = '';
        }

        function changeVisibility(notes=''){
            const docsTarget = document.querySelector('#popup-information');
            if(docsTarget.classList.contains('flex')){
                docsTarget.classList.replace('flex', 'hidden');
                docsTarget.classList.replace('z-10', '-z-10'); 
                commonStatus.isHaveNotified = true;
                sessionStorage.setItem('is_understand', 'yes');
            } 
            else {
                docsTarget.classList.replace('hidden', 'flex');
                docsTarget.classList.replace('-z-10', 'z-10');    
            }
        }

        function isNumber(value) {
            return !isNaN(value) && value.trim() !== "";
        }

        function isContainsNumber(str) {
            return /\d/.test(str);
        }

        function isContainsUniqueSymbol(str) {
            return /[^a-zA-Z0-9\s]/.test(str);
        }

        function validateUsername(username=inputElement.username.value){
            if(username.includes(' ')) return false;
            else if(username.length < 8) return false;
            return true;
        }

        function validateEmail(email=inputElement.email.value){
            if(!email.includes('@')) return false;
            else if(email.length < 13) return false;
            return true;
        }

        function validateName(name=inputElement.name.value){
            if(isNumber(name)) return false;
            else if(isContainsNumber(name)) return false;
            else if(isContainsUniqueSymbol(name)) return false;
            else if(name.length < 3) return false;
            return true;
        }

        function validatePassword(password=inputElement.password.value){
            if(password.length<8) return false;
            return true;
        }

        function validateConfirmationPassword(password=inputElement.passwordConfirmation.value){
            if(password != inputElement.password.value) return false;
            else if(password.length < 8) return false;
            else return true;
        }

        function debugAnalyzeInput(){
            alert(
                'isUsernameValid : ' + commonStatus.isUsernameValid + '\n' + 
                'isEmailValid : ' + commonStatus.isEmailValid + '\n' + 
                'isNameValid : ' + commonStatus.isNameValid + '\n' + 
                'isPasswordValid : ' + commonStatus.isPasswordValid + '\n' + 
                'isPasswordConfirmationValid : ' + commonStatus.isPasswordConfirmationValid + '\n'
            )
        }

        function analyzeInput(){
            commonStatus.isUsernameValid = validateUsername();
            commonStatus.isEmailValid = validateEmail();
            commonStatus.isNameValid = validateName();
            commonStatus.isPasswordValid = validatePassword();
            commonStatus.isPasswordConfirmationValid = validateConfirmationPassword();
        }

        function submitForm(){
            // function here
        }

    </script>
</div>