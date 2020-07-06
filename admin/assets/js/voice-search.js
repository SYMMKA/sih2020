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
    const transcript = event.results[current][0].transcript
      .toLowerCase()
      .trim();
    console.log(transcript);
    var array = transcript.split(" ");
    console.log(array);
    if (
      array[array.length - 1] == "search" &&
      array[array.length - 2] == "in"
    ) {
      var n = array.lastIndexOf("in");
      var search = array.slice(0, n).join(" ");
      console.log(search);
      window.location.href = "addBooks.php?q=" + search + "";
    }
    // if (transcript.indexOf("stop recording") >= 0) {
    //   console.log("stopped");
    // } else if (transcript.indexOf("home") >= 0) {
    //   window.location.href = "home.php";
    // } else if (transcript.indexOf("add") >= 0) {
    //   window.location.href = "addBooks.php";
    // } else if (transcript.indexOf("recommend") >= 0) {
    //   window.location.href = "recom.html";
    // } else if (transcript.indexOf("report") >= 0) {
    //   window.location.href = "report.html";
    // } else if (transcript.indexOf("shelf") >= 0) {
    //   window.location.href = "shelf.php";
    // } else {
    //   console.log("voice recog failed");
    // }
    recognition2.stop();
    // setTimeout(() => {
    //   searchForm.submit();
    // }, 500);
  }
} else {
  console.log("Your Browser does not support speech Recognition");
  info.textContent = "Your Browser does not support Speech Recognition";
}
