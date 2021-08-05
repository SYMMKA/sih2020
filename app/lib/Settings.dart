import 'dart:convert';

import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:http/http.dart' as http;
import 'package:sihapp/constants.dart';

class ForgotPassPage extends StatefulWidget {
  @override
  ForgotPassPageState createState() => ForgotPassPageState();
}

class ForgotPassPageState extends State<ForgotPassPage>
    with SingleTickerProviderStateMixin {
  bool _status = true;
  final FocusNode myFocusNode = FocusNode();

  String errMessage = 'Error Uploading Image';

  TextEditingController oldPassword_controller = new TextEditingController();
  TextEditingController password_controller = new TextEditingController();

  final _scaffoldKey = GlobalKey<ScaffoldState>();
  final _formKey = GlobalKey<FormState>();
  String stud_ID,password,oldPassword;

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    _loadData();
  }

  _loadData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      stud_ID = (prefs.getString('stud_ID') ?? '');
      password = (prefs.getString('password') ?? '');
    });
  }


  void changePassword() async
  {
    if(_formKey.currentState.validate())
      {
        if(oldPassword_controller.text==password)
          {
            final response = await http.post(rootUrl + "changePassword.php", body: {
              "password": password_controller.text,
              "stud_ID": stud_ID,
            });

            debugPrint(response.body.toString());
            
            if(response.body.toString().contains("Update_Sucessfull"))
              {
                showToast("updated successfully");
              }
            else
              {
                showToast("update failed");
              }
          }
        else{
          showToast("Invalid current password");
        }

      }

  }

  @override
  Widget build(BuildContext context) {
    double _height = MediaQuery.of(context).size.height;
    double _width = MediaQuery.of(context).size.width;

    return new Scaffold(
        key: _scaffoldKey,
        appBar: AppBar(
          title: Text(
            'Settings',
            style: TextStyle(color: Color(0xff001730)),
          ),
          backgroundColor: Colors.white,
          iconTheme: IconThemeData(color: Color(0xff001730)),
        ),
        body: new Container(
            color: Colors.white,
            margin: EdgeInsets.only(left: _width / 10, right: _width / 10),
            child: Center(
                child: SingleChildScrollView(
              child: Column(
                children: [
                  Form(
                    key: _formKey,
                    child: Column(
                      children: [
                        Text(
                          'Change password',
                          style: TextStyle(
                              fontSize: 20, fontWeight: FontWeight.bold),
                        ),
                        SizedBox(
                          height: 30,
                        ),
                        oldPasswordFormField(),
                        SizedBox(
                          height: 25,
                        ),
                        passwordFormField(),
                        SizedBox(
                          height: 25,
                        ),
                        button(),
                      ],
                    ),
                  )
                ],
              ),
            ))));
  }

  Widget oldPasswordFormField() {
    return TextFormField(
      controller: oldPassword_controller,
      decoration: new InputDecoration(
        labelText: "Enter old password",
        prefixIcon: Padding(
          padding: EdgeInsets.all(0.0),
          child: Icon(
            Icons.email,
            color: Colors.grey,
          ), // icon is 48px widget.
        ),
        fillColor: Colors.white,
        border: new OutlineInputBorder(
          borderRadius: new BorderRadius.circular(10.0),
          borderSide: new BorderSide(),
        ),
        //fillColor: Colors.green
      ),
      validator: (input) {
        if (input.isEmpty) {
          return 'password cannot be empty';
        }
      },
      onSaved: (input) {
        setState(() {
          oldPassword = input;
        });
      },
      keyboardType: TextInputType.emailAddress,
      style: new TextStyle(
        fontFamily: "Poppins",
      ),
    );
  }


  Widget passwordFormField() {
    return TextFormField(
      controller: password_controller,
      decoration: new InputDecoration(
        labelText: "Enter new password",
        prefixIcon: Padding(
          padding: EdgeInsets.all(0.0),
          child: Icon(
            Icons.email,
            color: Colors.grey,
          ), // icon is 48px widget.
        ),
        fillColor: Colors.white,
        border: new OutlineInputBorder(
          borderRadius: new BorderRadius.circular(10.0),
          borderSide: new BorderSide(),
        ),
        //fillColor: Colors.green
      ),
      validator: (input) {
        if (input.isEmpty) {
          return 'password cannot be empty';
        }
      },
      onSaved: (input) {
        setState(() {
          password = input;
        });
      },
      keyboardType: TextInputType.emailAddress,
      style: new TextStyle(
        fontFamily: "Poppins",
      ),
    );
  }

  Widget button() {
    return RaisedButton(
      elevation: 0,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(30.0)),
      onPressed: () {
        //resetPassword();
        changePassword();
      },
      textColor: Colors.white,
      padding: EdgeInsets.all(0.0),
      child: Container(
        width: MediaQuery.of(context).size.width / 3,
        alignment: Alignment.center,
//        height: _height / 20,
        // width: _large ? _width / 4 : (_medium ? _width / 3.75 : _width / 3.5),
        decoration: BoxDecoration(
          borderRadius: BorderRadius.all(Radius.circular(10.0)),
          gradient: LinearGradient(
            colors: <Color>[Colors.black, Colors.blueGrey],
          ),
        ),
        padding: const EdgeInsets.all(12.0),
        child: Text(
          'Reset',
          //  style: TextStyle(fontSize: _large ? 14 : (_medium ? 12 : 10)),
        ),
      ),
    );
  }
}
