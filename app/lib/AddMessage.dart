import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:http/http.dart' as http;
import 'chatScreen.dart';
import 'constants.dart';

class AddMessage extends StatefulWidget {
  @override
  _AddMessageState createState() => _AddMessageState();
}

class _AddMessageState extends State<AddMessage> {

  final TextEditingController textEditingController =
  new TextEditingController();
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


  Future<Null> addMessage() async {
    try {
      String textmessage =textEditingController.text;
      final response = await http.get(rootUrl +
          "addMessage.php?stud_ID=$stud_ID & name=$name & message=$textmessage");
      final responseValue = response.body.toString();
      debugPrint(responseValue);
      if( responseValue.contains("You_are_blocked"))
      {
        showToast("You are blocked");
        textEditingController.clear();
      }
      else{
        debugPrint(responseValue);

        showToast("Message added");
        textEditingController.clear();
      }

    }
    catch(e){
      debugPrint(e.toString());
    }
  }



  Widget _textComposerWidget() {
    return new IconTheme(
      data: new IconThemeData(color: Color(0xff4AD7D1)),
      child: new Container(
        margin: const EdgeInsets.symmetric(horizontal: 8.0),
        child: new Row(
          children: <Widget>[
            new Flexible(
              child: new TextField(
                decoration: new InputDecoration.collapsed(
                    hintText: "Enter your message"),
                controller: textEditingController,
                // onSubmitted: _handleSubmit,
              ),
            ),
            new Container(
              margin: const EdgeInsets.symmetric(horizontal: 8.0),
              child: new IconButton(
                icon: new Icon(Icons.send),
                onPressed: () => addMessage(),
              ),
            )
          ],
        ),
      ),
    );
  }



  @override
  Widget build(BuildContext context) {
    // TODO: implement build
    return new Column(
      children: <Widget>[
        new Container(
          decoration: new BoxDecoration(
            color: Theme.of(context).cardColor,
          ),
          child: _textComposerWidget(),
        )
      ],

    );
  }
}