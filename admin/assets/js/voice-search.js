// The speech recognition interface lives on the browser’s window object
const SpeechRecognition =
    window.SpeechRecognition || window.webkitSpeechRecognition; // if none exists -> undefined

if (SpeechRecognition) {
    if (document.querySelector(".search-form") != null) {
        const searchForm = document.querySelector(".search-form");
        const input = searchForm.querySelector("#searchByVoice"); // <=> document.querySelector("#search-form input");

        const recognition = new SpeechRecognition();

        searchForm.insertAdjacentHTML(
            "beforeend",
            '<button type="button" class="mic-button"><i i class= "fa fa-microphone " aria-hidden="true" ></i></button >'
        );

        const micBtn = searchForm.querySelector(".mic-button");
        const micIcon = micBtn.firstElementChild;

        micBtn.addEventListener("click", micBtnClick);
        function micBtnClick() {
            if (micIcon.classList.contains("fa-microphone")) {
                // Start Voice Recognition
                recognition.start(); // First time you have to allow access to mic!
            } else {
                recognition.stop();
            }
        }

        recognition.addEventListener("start", startSpeechRecognition); // <=> recognition.onstart = function() {...}
        function startSpeechRecognition() {
            micIcon.classList.remove("fa-microphone");
            micIcon.classList.add("fa-microphone-slash");
            input.focus();
            console.log("Voice activated, SPEAK");
        }

        recognition.addEventListener("end", endSpeechRecognition); // <=> recognition.onend = function() {...}
        function endSpeechRecognition() {
            micIcon.classList.remove("fa-microphone-slash");
            micIcon.classList.add("fa-microphone");
            input.focus();
            console.log("Speech recognition service disconnected");
        }

        recognition.addEventListener("result", resultOfSpeechRecognition); // <=> recognition.onresult = function(event) {...} - Fires when you stop talking
        function resultOfSpeechRecognition(event) {
            const transcript = event.results[0][0].transcript;
            console.log(transcript);
            input.value = transcript;
            input.focus();
            // setTimeout(() => {
            //   searchForm.submit();
            // }, 500);
        }
    }
} else {
    console.log("Your Browser does not support speech Recognition");
    info.textContent = "Your Browser does not support Speech Recognition";
}
