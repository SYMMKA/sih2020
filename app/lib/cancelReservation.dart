import 'dart:convert';
import 'dart:math';

import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:http/http.dart' as http;
import 'package:sihapp/ShelvesBooks.dart';

import 'Search.dart';
import 'constants.dart';

class CancelReservation extends StatefulWidget {
  final String stud_ID;

  CancelReservation({Key key, this.stud_ID}) : super(key: key);
  @override
  _CancelReservationState createState() => _CancelReservationState();
}

class _CancelReservationState extends State<CancelReservation> {
  bool checkBoxValue = false;
  double _height, _width;

  final GlobalKey<FormState> key = GlobalKey<FormState>();
  String email, password;
  List shelfs = new List();
  int state;

  void initState() {
    super.initState();
    getShelf();
  }


  void cancelReserve(String stud_ID, String copyID) async {

    debugPrint(stud_ID);
    debugPrint(copyID);
    try {
      var response = await http.post(
          Uri.encodeFull(
              rootUrl + "cancelReservation.php"),body: {
            "stud_ID":stud_ID,
            "copyID": copyID,
        },
          headers: {"Accept": "application/json"});

      debugPrint(response.body.toString());

      if (response.body.toString().contains("TRUE")) {

        showToast("Cancelled Successfully");
        getShelf();
      } else {
        showToast("Cancellation error");
      }
    } catch (e) {
      debugPrint(e.toString());
      showToast("Make sure ur connected to internet");
    }
  }



  void getShelf() async {
    try {
      var response = await http.get(
          Uri.encodeFull(
              rootUrl + "reservedCopies.php?stud_ID=" + widget.stud_ID),
          headers: {"Accept": "application/json"});

      debugPrint(response.body.toString());

      if (response.body.toString().contains("false")) {
        setState(() {
          state = 0;
        });
      } else {
        setState(() {
          state = 1;
          shelfs = jsonDecode(response.body);
        });
      }
    } catch (e) {
      debugPrint(e.toString());
    }
  }

  @override
  Widget build(BuildContext context) {
    _height = MediaQuery.of(context).size.height;
    _width = MediaQuery.of(context).size.width;

    return Scaffold(
        appBar: AppBar(
          title: Text(
            'Your Reservations',
            style: TextStyle(color: Color(0xff001730)),
          ),
          backgroundColor: Colors.white,
          iconTheme: IconThemeData(color: Color(0xff001730)),
        ),
        body: state == 0
            ? Container(
                child: Center(
                  child: Text(
                    "No books reserved",
                  ),
                ),
              )
            : Container(
                child: ListView.builder(
                    // gridDelegate:SliverGridDelegateWithFixedCrossAxisCount(crossAxisCount: 1),
                    itemCount: shelfs.length,
                    itemBuilder: (BuildContext context, int x) {
                      return gridViewItem(
                          shelfs[x]["copyID"], shelfs[x]["time"],shelfs[x]["returnTime"],shelfs[x]["title"]);
                    }),
              ));
  }

  Widget gridViewItem(
      String copyId, String start, String end, String title) {
    return Container(
        child: Card(
            elevation: 4,
            margin: EdgeInsets.all(8),
            semanticContainer: true,
            color: Colors.amberAccent.shade50,
            child: Container(
              padding: EdgeInsets.all(10),
              //width: 100,
              height: 100,
              decoration: BoxDecoration(
                gradient: LinearGradient(colors: [Colors.white, Colors.white]),
                borderRadius: BorderRadius.all(Radius.circular(15)),
              ),
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Row(
                    children: <Widget>[
                      Expanded(
                        flex: 2,
                        child: Column(
                          children: <Widget>[
                            Text(title,  overflow: TextOverflow.clip,
                              maxLines: 1,
                              softWrap: false,),
                            Text("Copy No:" + copyId, overflow: TextOverflow.ellipsis,
                              maxLines: 1,),
                            Text("Start Time:" + start, overflow: TextOverflow.ellipsis,
                              maxLines: 1,),
                            Text("End Time:" + end, overflow: TextOverflow.ellipsis,
                              maxLines: 1,),
                          ],
                        ),
                      ),
                      Expanded(
                        flex: 1,
                        child: Container(
                          child: RaisedButton(
                            child: Text("Cancel"),
                            onPressed: (){

                              cancelReserve(widget.stud_ID, copyId);
                            },
                          ),
                        ),
                      )
                    ],
                  )
                ],
              ),
            )));
  }
}
