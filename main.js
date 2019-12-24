/* setup vars for our trigger, form, text input and result elements */



var $voiceTrigger = $("#voice-trigger");
var $searchForm = $("#search-form");
var $searchInput = $("#search-input");
var $result = $("#result");

/*  set Web Speech API for Chrome or Firefox */
window.SpeechRecognition =
  window.SpeechRecognition || window.webkitSpeechRecognition;

/* Check if browser support Web Speech API, remove the voice trigger if not supported */
if (window.SpeechRecognition) {
  /* setup Speech Recognition */
  var recognition = new SpeechRecognition();
  recognition.interimResults = true;
  recognition.addEventListener("result", _transcriptHandler);

  recognition.onerror = function(event) {
    console.log(event.error);

    /* Revert input and icon CSS if no speech is detected */
    if (event.error == "no-speech") {
      $voiceTrigger.removeClass("active");
      $searchInput.attr("placeholder", "Search me...");
    }
  };
} else {
  $voiceTrigger.remove();
}

jQuery(document).ready(function() {
  /* Trigger listen event when our trigger is clicked */
  $voiceTrigger.on("click touch", listenStart);
});

/* Our listen event */
function listenStart(e) {
  e.preventDefault();
  /* Update input and icon CSS to show that the browser is listening */
  $searchInput.attr("placeholder", "Listening...");
  $voiceTrigger.addClass("active");
  /* Start voice recognition */
  recognition.start();
}

/* Parse voice input */
function _parseTranscript(e) {
  return Array.from(e.results)
    .map(result => result[0])
    .map(result => result.transcript)
    .join("");
}

/* Convert our voice input into text and submit the form */
function _transcriptHandler(e) {
  var speechOutput = _parseTranscript(e);
  $searchInput.val(speechOutput);

  //$result.html(speechOutput);
  if (e.results[0].isFinal) {
    window.SpeechRecognition.stop();
  }
}

//for dropdown menu
$(".dropdown-menu li").on("click", function() {
  $(".dropdown-toggle").html($(this).html() + '<span class="caret"></span>');
});
