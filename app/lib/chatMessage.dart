import 'package:bubble/bubble.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';

class ChatMessage extends StatefulWidget {
  final String name, message, time,stud_id;

  ChatMessage({this.name, this.message, this.time,this.stud_id});

  @override
  _ChatMessageState createState() => _ChatMessageState();
}

class _ChatMessageState extends State<ChatMessage> {


  String stud_ID, password , name,email,mobile,points;



  @override
  void dispose() {
    super.dispose();
  }


  _loadData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      stud_ID = (prefs.getString('stud_ID') ?? '');
      name = (prefs.getString('name') ?? '');
      email = (prefs.getString('email') ?? '');
    });
  }


  @override
  void initState() {
    super.initState();
    _loadData();

  }


  @override
  Widget build(BuildContext context) {
    return new Container(

      child: Column(
        children: <Widget>[

          Bubble(
            margin: BubbleEdges.only(top: 10),
            padding: BubbleEdges.all(20),
            alignment: Alignment.topLeft,
            nip: BubbleNip.leftTop ,
            child:
            Container(

              child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: <Widget>[
                    Row(
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      children: <Widget>[
                        Text(widget.name, style: TextStyle(fontWeight: FontWeight.bold ,color: Color(0xff001730))),

                        Text(widget.time, style: TextStyle(fontWeight: FontWeight.bold ,color: Colors.grey)),
                      ],
                    ),

                    SizedBox(
                      height: 10,
                    ),

                    Text(widget.message),
                  ]
              ),
            )

          ),

        ],
      ),
    );
  }
}
