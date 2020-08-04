import 'dart:convert';

import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:progress_dialog/progress_dialog.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:sihapp/Homepage.dart';
import 'package:http/http.dart' as http;
import 'package:sihapp/constants.dart';

import 'homeTest.dart';

class LoginPage extends StatefulWidget {
  @override
  _LoginPageState createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  bool checkBoxValue = false;

  final GlobalKey<FormState> key = GlobalKey<FormState>();
  TextEditingController _controllerEmail = new TextEditingController();
  TextEditingController _controllerPassword = new TextEditingController();
  String stud_ID, password, name, email, mobile, points, type, block;

  void login() async {
    if (key.currentState.validate()) {
      ProgressDialog pr = ProgressDialog(context,
          type: ProgressDialogType.Normal,
          isDismissible: true,
          showLogs: false);
      await pr.show();

      setState(() {
        stud_ID = _controllerEmail.text;
        password = _controllerPassword.text;
      });


      debugPrint(stud_ID+password);
      try {
        final response = await http.post(rootUrl + "signin.php", body: {
          "stud_ID": stud_ID,
          "password": password,
        });


        debugPrint(response.body);

      if(response.body!="FALSE")
      {
        var data = json.decode(response.body);
        setState(() {
          name = data[0]["name"];
          email = data[0]["email"];
          mobile = data[0]["mobile"];
          points = data[0]["points"];
          block = data[0]["block"];
          type = data[0]["type"];
        });

        _setData();

        await pr.hide();

        Navigator.push(
          context,
          MaterialPageRoute(
            builder: (context) => HomeTest(
              pos: 0,
            ),
          ),
        );
      }
      else{
        showToast("Invalid username or password");
      }


      }
    catch (e) {
        await pr.hide();
        debugPrint("the error message" + e.toString());
      }
    }
  }

  _setData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    prefs.clear();

    prefs.setString('stud_ID', stud_ID);
    prefs.setString('name', name);
    prefs.setString('email', email);
    prefs.setString('mobile', mobile);
    prefs.setString('points', points);
    prefs.setString('password', password);
    prefs.setString('block', block);
    prefs.setString('type', type);
    prefs.setBool("isLoggedIn", true);
  }

  @override
  Widget build(BuildContext context) {
    double _height = MediaQuery.of(context).size.height;
    double _width = MediaQuery.of(context).size.width;

    return Scaffold(

      extendBodyBehindAppBar: true,
      body: Container(
        color: Color(0xff001730),
        margin: EdgeInsets.only(top: 20),
        padding: EdgeInsets.all(20),
        child: ListView(children: [
          Center(
            child: Container(
              width: _height < _width - 50 ? _width / 2 : _width - 30,
              height: _height / 1.3,
              child: Container(
                padding: EdgeInsets.only(left: 15, right: 15),
                child: Form(
                  key: key,
                  child: Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      crossAxisAlignment: CrossAxisAlignment.center,
                      children: [
                        RichText(
                          text: TextSpan(
                            text: 'Welcome',
                            style: TextStyle(
                                color: Colors.white,
                                fontSize: 24,
                                fontWeight: FontWeight.w500),
                          ),
                        ),
                        SizedBox(height: 10),
                        RichText(
                          text: TextSpan(
                              text: 'AlphaByte',
                              style: TextStyle(
                                color: Colors.white,
                                fontSize: 36,
                                fontWeight: FontWeight.bold,
                              )),
                        ),
                        SizedBox(height: 10),
                        RichText(
                          text: TextSpan(
                            text: 'Change your perspective with a book',
                            style: TextStyle(
                                color: Colors.white,
                                fontSize: 18,
                                fontWeight: FontWeight.w500),
                          ),
                        ),
                        SizedBox(
                          height: 30,
                        ),
                        TextFormField(
                          controller: _controllerEmail,
                          validator: (String content) {
                            if (content.length == 0) {
                              return "Please enter valid email";
                            } else {
                              return null;
                            }
                          },
                          decoration: InputDecoration(
                            fillColor: Colors.white,
                            filled: true,
                            prefixIcon: Padding(
                              padding: EdgeInsets.all(0.0),
                              child: Icon(
                                Icons.email,
                                color: Colors.grey,
                              ), // icon is 48px widget.
                            ),
                            labelText: "Enter College ID",
                            border: OutlineInputBorder(),
                          ),
                        ),
                        SizedBox(
                          height: 16,
                        ),
                        TextFormField(
                          controller: _controllerPassword,
                          obscureText: true,
                          validator: (String content) {
                            if (content.length == 0) {
                              return "Please enter valid password";
                            } else {
                              return null;
                            }
                          },
                          decoration: InputDecoration(
                            fillColor: Colors.white,
                            filled: true,
                            prefixIcon: Padding(
                              padding: EdgeInsets.all(0.0),
                              child: Icon(
                                Icons.lock,
                                color: Colors.grey,
                              ), // icon is 48px widget.
                            ),
                            labelText: "Password",
                            border: OutlineInputBorder(),
                          ),
                        ),
                        SizedBox(
                          height: 16,
                        ),
                        Row(
                          children: <Widget>[
                            Expanded(
                              child: RaisedButton(
                                padding: EdgeInsets.symmetric(
                                    horizontal: 45, vertical: 15),
                                color: Color(0xffFE4A49),
                                shape: RoundedRectangleBorder(
                                  borderRadius: BorderRadius.circular(4),
                                ),
                                onPressed: () {
                                  // If statement is validating the input fields.
                                  login();
                                },
                                child: Row(
                                  mainAxisAlignment: MainAxisAlignment.center,
                                  children: <Widget>[
                                    Icon(
                                      Icons.lock_open,
                                      color: Colors.white,
                                    ),
                                    SizedBox(width: 12),
                                    Text(
                                      "LOGIN",
                                      style: TextStyle(
                                          color: Colors.white, fontSize: 18),
                                    ),
                                  ],
                                ),
                              ),
                            )
                          ],
                        ),
                      ]),
                ),
              ),
            ),
          ),
        ]),
      ),
    );
  }
}
