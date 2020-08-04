import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:flutter/material.dart';
import 'dart:async';
import 'package:json_table/json_table.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:sihapp/constants.dart';

import 'ViewActivity.dart';

class LibraryCard extends StatefulWidget {
  final String userID;

  LibraryCard({Key key, @required this.userID}) : super(key: key);

  @override
  _LibraryCardState createState() => _LibraryCardState(userID);
}

class _LibraryCardState extends State<LibraryCard> {
  String userID,stud_ID;
  String _textFromFile = "";
  bool toggle = true;
  List activities=new List();

  var columns = [
    JsonTableColumn("title", label: "Title"),
    JsonTableColumn("copyID", label: "Copy Id",),
    JsonTableColumn("time", label: "Issue Time"),
    JsonTableColumn("returnTime", label: "Return Time"),
    JsonTableColumn("fine", label: "Fine"),
    JsonTableColumn("due", label: "Due"),

  ];

  _LibraryCardState(String uid) {
    this.userID = uid;
    print(userID);
    getTextFromFile().then((val) => setState(() {
      _textFromFile = val;
    }));
  }




  Future<String> getFileData() async {
    var url = rootUrl+'libraryCard.php?stud_ID='+userID;
    http.Response response = await http.get(url);
    setState(() {
      activities =  jsonDecode(response.body);
    });
    return response.body.toString();
  }

  Future<String> getTextFromFile() async {
    return await getFileData();
  }

  @override
  Widget build(BuildContext context) {
    double _height;
    double _width;
    _height = MediaQuery.of(context).size.height;
    _width = MediaQuery.of(context).size.width;

    if (_textFromFile != "") {
      var json = jsonDecode(_textFromFile);

      return Scaffold(



        body: SingleChildScrollView(
          padding: EdgeInsets.all(16.0),
          child: Container(
            child: toggle
                ? Column(
              children: [
                JsonTable(
                  json,
                  columns:columns,
                  showColumnToggle: true,
                  allowRowHighlight: true,
                  rowHighlightColor: Colors.blue[200].withOpacity(0.7),
                  paginationRowCount: 50,
                  onRowSelect: (index, map) {
                    print(index);
                    debugPrint(activities[index].toString());
                    debugPrint(activities[index].runtimeType.toString());

                    Map activityMap= Map<String, dynamic>.from(activities[index]);
                    debugPrint("the map"+activityMap.runtimeType.toString());
                    debugPrint(activityMap["bookID"]);

                    Navigator.push(
                      context,
                      MaterialPageRoute(
                          builder: (context) =>
                              ViewActivity(activityMap : activityMap)
                      ),

                    );

                  },


                  tableHeaderBuilder: (String header) {
                    return Container(
                      height: 60,
                      //width:MediaQuery.of(context).size.width/2,
                      padding: EdgeInsets.symmetric(horizontal: 8.0, vertical: 4.0),
                      decoration: BoxDecoration(border: Border.all(width: 0.5),color: Colors.grey[300]),
                      child: Text(
                        header,
                        textAlign: TextAlign.center,
                        style: Theme.of(context).textTheme.display1.copyWith(fontWeight: FontWeight.w700, fontSize: 14.0,color: Colors.black87),
                      ),
                    );
                  },
                  tableCellBuilder: (value) {
                    return Container(
                      height: 60,

                      padding: EdgeInsets.symmetric(horizontal: 4.0, vertical: 2.0),
                      decoration: BoxDecoration(border: Border.all(width: 0.5, color: Colors.grey.withOpacity(0.5))),
                      child: Text(
                        value,
                        textAlign: TextAlign.center,
                        style: Theme.of(context).textTheme.display1.copyWith(fontSize: 14.0, color: Colors.grey[900]),
                      ),
                    );
                  },


                ),
                SizedBox(
                  height: 40.0,
                ),

              ],
            )
                : Center(
              child: Text(getPrettyJSONString(_textFromFile)),
            ),
          ),
        ),

      );
    } else {
      return new Scaffold(

          body:SimpleDialog(
              backgroundColor: Colors.white,
              children: <Widget>[
                Center(
                  child: Column(children: [
                    CircularProgressIndicator(),
                    SizedBox(height: 10,),
                    Text("Please Wait....",style: TextStyle(color: Colors.black),)
                  ]),
                )
              ])
      );
    }
  }

  String getPrettyJSONString(jsonObject) {
    JsonEncoder encoder = new JsonEncoder.withIndent('  ');
    String jsonString = encoder.convert(json.decode(jsonObject));
    return jsonString;
  }
}



