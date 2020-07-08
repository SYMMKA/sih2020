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
    // var x;
    // var y;
    // switch (array.indexOf(x) >= 0) {
    //   case "search":
    //     var a = array.indexOf("search");
    //     var n = array.lastIndexOf("in");
    //     var last = array.slice(n + 1, transcript.length).join(" ");
    //     var search = array.slice(a + 1, n).join(" ");
    //     switch (last.indexOf(y) >= 0) {
    //       case "add":
    //         window.location.href = "addBooks.php?q=" + search + "";
    //         break;
    //       case "manage":
    //         window.location.href = "manageBooks.php?q=" + search + "";
    //         break;
    //     }
    //     break;
    //   case "home":
    //     window.location.href = "home.php";
    //     break;
    //   case "add":
    //     window.location.href = "addBooks.php";
    //     break;
    //   case "recommend":
    //     window.location.href = "recom.php";
    //     break;
    //   case "shelf":
    //     window.location.href = "shelf.php";
    //     break;
    //   case "manage":
    //     window.location.href = "manageBooks.php";
    //     break;
    //   case "report":
    //     window.location.href = "report.php";
    //     break;
    //   case "due":
    //     window.location.href = "due.php";
    //     break;
    // }
    var a = array.indexOf("search");
    if (a >= 0) {
      var last = array.slice(n + 1, transcript.length).join(" ");
      var n = array.lastIndexOf("in");
      var search = array.slice(a + 1, n).join(" ");
      console.log(search);
      if (last.indexOf("add") >= 0) {
        window.location.href = "addBooks.php?q=" + search + "";
      } else if (last.indexOf("manage") >= 0) {
        window.location.href = "manageBooks.php?q=" + search + "";
      }
    } else if (transcript.indexOf("home") >= 0) {
      window.location.href = "home.php";
    } else if (transcript.indexOf("add") >= 0) {
      window.location.href = "addBooks.php";
    } else if (transcript.indexOf("recommend") >= 0) {
      window.location.href = "recom.html";
    } else if (transcript.indexOf("report") >= 0) {
      window.location.href = "report.html";
    } else if (transcript.indexOf("shelf") >= 0) {
      window.location.href = "shelf.php";
    } else if (transcript.indexOf("due") >= 0) {
      window.location.href = "due.php";
    } else if (transcript.indexOf("manage") >= 0) {
      window.location.href = "manageBooks.php";
    } else {
      console.log("voice recog failed");
    }
    recognition2.stop();
    // setTimeout(() => {
    //   searchForm.submit();
    // }, 500);
  }
} else {
  console.log("Your Browser does not support speech Recognition");
  info.textContent = "Your Browser does not support Speech Recognition";
}
