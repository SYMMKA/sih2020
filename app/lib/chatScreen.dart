import 'dart:async';
import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:sihapp/chatMessage.dart';
import 'package:sihapp/AddMessage.dart';
import 'constants.dart';

class ChatScreen extends StatefulWidget {
  @override
  State createState() => new ChatScreenState();
}

class ChatScreenState extends State<ChatScreen> {
  final TextEditingController textEditingController =
      new TextEditingController();
  final List<ChatMessage> _messages = <ChatMessage>[];
  Map chatMap = Map();
  List chatList = List();
  String stud_ID;
  Timer timer;
  int counter = 0;

  _loadData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      stud_ID = (prefs.getString('stud_ID') ?? '');
      debugPrint(stud_ID);
    });
  }

  void _handleSubmit(String name, String message, String time) {
    textEditingController.clear();
    ChatMessage chatMessage = new ChatMessage(
      name: name,
      message: message,
      time: time,
      stud_id: stud_ID,
    );
    setState(() {
      //used to rebuild our widget
      _messages.insert(0, chatMessage);
    });
  }

  Future<Null> getChats() async {
    final response = await http.get(rootUrl + "chats.php");
    final responseJson = json.decode(response.body);

   // debugPrint(responseJson.toString());

    setState(() {
      _messageDetails.clear();
      for (Map user in responseJson) {
        _messageDetails.add(Messages.fromJson(user));
      }
    //  debugPrint(_messageDetails.length.toString());
    });
  }

  @override
  void initState() {
    super.initState();
    _loadData();

    timer = Timer.periodic(Duration(seconds: 1), (Timer t) {
      _messages.clear();
      addValue();
      getChats();
      for (int i = 0; i < _messageDetails.length; i++) {
        _handleSubmit(_messageDetails[i].name, _messageDetails[i].message,
            _messageDetails[i].time);
      }
    });
  }

  void addValue() {
    setState(() {
      counter++;
    });
    debugPrint(counter.toString());
  }

  @override
  void dispose() {
    timer.cancel();
    super.dispose();
  }



  @override
  Widget build(BuildContext context) {
    return _messages.length != 0
        ? new Column(
            children: <Widget>[
              new Flexible(
                child: new ListView.builder(
                  padding: new EdgeInsets.all(8.0),
                  reverse: true,
                  itemBuilder: (_, int index) => _messages[index],
                  itemCount: _messages.length,
                ),
              ),
              new Divider(
                height: 1.0,
              ),

              new Container(
                decoration: new BoxDecoration(
                  color: Theme.of(context).cardColor,
                ),
                child: new AddMessage(),
              )
            ],
          )
        : new Container(
            child: Center(
              child: CircularProgressIndicator(
                backgroundColor: Colors.white,
              ),
            ),
          );
  }
}

List<Messages> _messageDetails = [];

class Messages {
  final String id, name, message, time,stud_id;

  Messages({
    this.id,
    this.name,
    this.message,
    this.time,
    this.stud_id,
  });

  factory Messages.fromJson(Map<String, dynamic> json) {
    return new Messages(
      id: json['id'],
      name: json['name'],
      stud_id: json['stud_ID'],
      message: json['message'],
      time: json['time'],
    );
  }
}