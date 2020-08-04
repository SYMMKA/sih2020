

import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';

String rootUrl="http://192.168.0.103/DS165_NeonGenesis/web/user/";

//String rootUrl="http://fba1c84cd029.ngrok.io/sih/app/";

showToast(String msg)
{
  return  Fluttertoast.showToast(
      msg: msg,
      toastLength: Toast.LENGTH_SHORT,
      gravity: ToastGravity.BOTTOM,
      timeInSecForIosWeb: 2,
      backgroundColor: Colors.grey[800],
      textColor: Colors.white,
      fontSize: 18.0
  );
}