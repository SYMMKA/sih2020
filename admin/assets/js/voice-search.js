const searchForm = document.querySelector(".search-form");
const searchFormInput = document.querySelector(".search-box");
const input = searchFormInput.querySelector("input"); // <=> document.querySelector("#search-form input");

// The speech recognition interface lives on the browser’s window object
const SpeechRecognition =
  window.SpeechRecognition || window.webkitSpeechRecognition; // if none exists -> undefined

if (SpeechRecognition) {
  console.log("Your Browser supports speech Recognition");

  const recognition = new SpeechRecognition();
  const recognition2 = new SpeechRecognition();
  recognition2.continuous = true;
  // recognition.lang = "en-US";

  searchFormInput.insertAdjacentHTML(
    "beforeend",
    '<button type="button" class="mic-button"><i i class= "fa fa-microphone " aria-hidden="true" ></i></button >'
  );

  const micBtn = searchForm.querySelector(".mic-button");
  const micIcon = micBtn.firstElementChild;
  const voiceBtn = document.querySelector(".voice-button");
  const voiceIcon = voiceBtn.firstElementChild;

  micBtn.addEventListener("click", micBtnClick);
  function micBtnClick() {
    if (micIcon.classList.contains("fa-microphone")) {
      // Start Voice Recognition
      recognition.start(); // First time you have to allow access to mic!
    } else {
      recognition.stop();
    }
  }

  voiceBtn.addEventListener("click", voiceBtnClick);
  function voiceBtnClick() {
    if (voiceIcon.classList.contains("fa-microphone")) {
      // Start Voice Recognition
      recognition2.start();
    } else {
      recognition2.stop();
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

  recognition2.addEventListener("start", startSpeechRecognition2); // <=> recognition.onstart = function() {...}
  function startSpeechRecognition2() {
    voiceIcon.classList.remove("fa-microphone");
    voiceIcon.classList.add("fa-microphone-slash");
    console.log("Voice activated, SPEAK");
  }

  recognition2.addEventListener("end", endSpeechRecognition2); // <=> recognition.onend = function() {...}
  function endSpeechRecognition2() {
    voiceIcon.classList.remove("fa-microphone-slash");
    voiceIcon.classList.add("fa-microphone");
    console.log("Speech recognition service disconnected");
  }

  recognition2.addEventListener("result", resultOfSpeechRecognition2); // <=> recognition.onresult = function(event) {...} - Fires when you stop talking
  function resultOfSpeechRecognition2(event) {
    const current = event.resultIndex;
    const transcript = event.results[current][0].transcript;
    console.log(transcript.toLowerCase());
    if (transcript.toLowerCase().trim() === "stop recording") {
      endSpeechRecognition2();
    } else if (!searchFormInput.value) {
      searchFormInput.value = transcript;
    } else transcript.toLowerCase().trim() == "home";
    if (transcript.toLowerCase().trim() === "go") {
      window.location.href = "http://www.w3schools.com";
    }
    // setTimeout(() => {
    //   searchForm.submit();
    // }, 500);
  }
} else {
  console.log("Your Browser does not support speech Recognition");
  info.textContent = "Your Browser does not support Speech Recognition";
}
