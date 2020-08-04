import 'dart:async';
import 'dart:math';

import 'package:flutter/material.dart';
import 'package:sihapp/homeTest.dart';
import 'package:sihapp/qrScanner.dart';
import 'package:speech_to_text/speech_recognition_error.dart';
import 'package:speech_to_text/speech_recognition_result.dart';
import 'package:speech_to_text/speech_to_text.dart';

import 'leaderBoard.dart';



class VoiceNavigation extends StatefulWidget {
  @override
  _VoiceNavigationState createState() => _VoiceNavigationState();
}

class _VoiceNavigationState extends State<VoiceNavigation> {
  bool _hasSpeech = false;
  double level = 0.0;
  double minSoundLevel = 50000;
  double maxSoundLevel = -50000;
  String lastWords = "";
  String lastError = "";
  String lastStatus = "";
  String _currentLocaleId = "";
  String inputGiven;
  List<LocaleName> _localeNames = [];
  final SpeechToText speech = SpeechToText();

  @override
  void initState() {
    super.initState();
    initSpeechState();
  }

  Future<void> initSpeechState() async {
    bool hasSpeech = await speech.initialize(
        onError: errorListener, onStatus: statusListener);
    if (hasSpeech) {
      _localeNames = await speech.locales();

      var systemLocale = await speech.systemLocale();
      _currentLocaleId = systemLocale.localeId;
    }

    if (!mounted) return;

    setState(() {
      _hasSpeech = hasSpeech;
    });
  }

  navigateToScreen()
  {
    if(inputGiven.contains("dashboard")|| inputGiven.contains("dash board"))
      {
              Navigator.pushReplacement(
                context,
                MaterialPageRoute(
                  builder: (context) => HomeTest(pos: 0,),
                ),
              );
      }
    else if(inputGiven.contains("search books"))
    {
      Navigator.pushReplacement(
        context,
        MaterialPageRoute(
          builder: (context) => HomeTest(pos: 1,),
        ),
      );
    }
    else if(inputGiven.contains(" activities ") ||inputGiven.contains(" library card "))
    {
      Navigator.pushReplacement(
        context,
        MaterialPageRoute(
          builder: (context) => HomeTest(pos: 2,),
        ),
      );
    }
    else if(inputGiven.contains("chat"))
    {
      Navigator.pushReplacement(
        context,
        MaterialPageRoute(
          builder: (context) => HomeTest(pos: 3,),
        ),
      );
    }
    else if(inputGiven.contains("timetable") || inputGiven.contains("time table"))
    {
      Navigator.pushReplacement(
        context,
        MaterialPageRoute(
          builder: (context) => HomeTest(pos: 4,),
        ),
      );
    }
    else if(inputGiven.contains("QR scanner"))
    {
      Navigator.push(
        context,
        MaterialPageRoute(
          builder: (context) => QRViewExample(),
        ),
      );
    }
    else if(inputGiven.contains("leader board") || inputGiven.contains("leaderboard"))
    {
      Navigator.push(
        context,
        MaterialPageRoute(
          builder: (context) => LeaderBoard(),
        ),
      );
    }


  }



  @override
  Widget build(BuildContext context) {
    return Center(
        child: Material(
          child:Container(
            height: MediaQuery.of(context).size.height / 1.8,
            width: MediaQuery.of(context).size.width - 50,
        child: Column(children: [

          Container(
            child: Column(
              children: <Widget>[
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceAround,
                  children: <Widget>[
                   Text("Voice Navigation",style: TextStyle(fontSize: 18),),
                  ],
                ),

//                Row(
//                  mainAxisAlignment: MainAxisAlignment.spaceAround,
//                  children: <Widget>[
//                    DropdownButton(
//                      onChanged: (selectedVal) => _switchLang(selectedVal),
//                      value: _currentLocaleId,
//                      items: _localeNames
//                          .map(
//                            (localeName) => DropdownMenuItem(
//                          value: localeName.localeId,
//                          child: Text(localeName.name),
//                        ),
//                      )
//                          .toList(),
//                    ),
//                  ],
//                ),

                SizedBox(
                  height: 15,
                ),

                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceAround,
                  children: <Widget>[
                   IconButton(
                      icon: Icon(Icons.call_missed_outgoing),
                      color: Colors.black,
                      onPressed: !_hasSpeech || speech.isListening
                          ? null
                          : startListening,
                    ),
                    IconButton(
                      icon: Icon(Icons.pause),
                      color: Colors.black,
                      onPressed: speech.isListening ? stopListening : null,
                    ),
                    IconButton(
                      icon: Icon(Icons.cancel),
                      color: Colors.black,
                      onPressed: speech.isListening ? cancelListening : null,
                    ),
                  ],
                ),

              ],
            ),
          ),

          SizedBox(
            height: 15,
          ),
          Expanded(
            flex: 4,
            child: Column(
              children: <Widget>[
                Center(
                  child: Text(
                    'Recognized Words',
                    style: TextStyle(fontSize: 16.0),
                  ),
                ),
                Expanded(
                  child: Stack(
                    children: <Widget>[
                      Container(
                        color: Theme.of(context).selectedRowColor,
                        child: Center(
                          child: Text(
                            lastWords,
                            textAlign: TextAlign.center,
                          ),
                        ),
                      ),

                    ],
                  ),
                ),
              ],
            ),
          ),
//          Expanded(
//            flex: 1,
//            child: Column(
//              children: <Widget>[
//                Center(
//                  child: Text(
//                    'Error Status',
//                    style: TextStyle(fontSize: 22.0),
//                  ),
//                ),
//                Center(
//                  child: Text(lastError),
//                ),
//              ],
//            ),
//          ),
          Container(
            padding: EdgeInsets.symmetric(vertical: 20),
            color: Color(0xff4AD7D1).withOpacity(0.5),
            child: Center(
              child: speech.isListening
                  ? Text(
                "I'm listening...",
                style: TextStyle(fontWeight: FontWeight.bold),
              )
                  : Text(
                'Not listening',
                style: TextStyle(fontWeight: FontWeight.bold),
              ),
            ),
          ),
        ]),
      )));

  }

  void startListening() {
    lastWords = "";
    lastError = "";
    speech.listen(
        onResult: resultListener,
        listenFor: Duration(seconds: 10),
        localeId: _currentLocaleId,
        onSoundLevelChange: soundLevelListener,
        cancelOnError: true,
        partialResults: true,
        onDevice: true,
        listenMode: ListenMode.confirmation);
    setState(() {});
  }

  void stopListening() {
    speech.stop();
    setState(() {
      level = 0.0;
    });
  }

  void cancelListening() {
    speech.cancel();
    setState(() {
      level = 0.0;
    });
  }

  void resultListener(SpeechRecognitionResult result) {
    setState(() {
      if(result.finalResult)
        {
          setState(() {
            inputGiven = result.recognizedWords;
            debugPrint(inputGiven);
            navigateToScreen();
          });
        }
      lastWords = "${result.recognizedWords}";
    });
  }

  void soundLevelListener(double level) {
    minSoundLevel = min(minSoundLevel, level);
    maxSoundLevel = max(maxSoundLevel, level);
    // print("sound level $level: $minSoundLevel - $maxSoundLevel ");
    setState(() {
      this.level = level;
    });
  }

  void errorListener(SpeechRecognitionError error) {
    // print("Received error status: $error, listening: ${speech.isListening}");
    setState(() {
      lastError = "${error.errorMsg} - ${error.permanent}";
    });
  }

  void statusListener(String status) {
    // print(
    // "Received listener status: $status, listening: ${speech.isListening}");
    setState(() {
      lastStatus = "$status";

    });
  }

  _switchLang(selectedVal) {
    setState(() {
      _currentLocaleId = selectedVal;
    });
    print(selectedVal);
  }
}