import 'dart:convert';

import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_rating_bar/flutter_rating_bar.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:http/http.dart' as http;
import 'Search.dart';
import 'constants.dart';


class ViewActivity extends StatefulWidget {
  Map activityMap;
  // final String ustud_ID,  ulname, uname, umobile;
  ViewActivity({this.activityMap});
  @override
  _ViewActivityState createState() => _ViewActivityState();
}

class _ViewActivityState extends State<ViewActivity> {
  bool status = false;
  int count = 0,state=0;
  double _height, _width;
  List availableBooks = List();
  String copyID,star,stud_ID,type;


  final _key = GlobalKey<ScaffoldState>();

  void initState() {
    super.initState();
    _loadData();
    copyID = widget.activityMap["copyID"];
    star = widget.activityMap["star"];
    stud_ID= stud_ID;
  }

  setNewRating() async
  {

    try {
      var response = await http.post(
        Uri.encodeFull(
            rootUrl+"updateRatings.php")
        , body: {
        "copyID": copyID,
        "stud_ID": stud_ID,
        "star":star,
        "type":type,
      }
      );

      debugPrint("response=" + response.body);
      if (response.body.contains("Update_Sucessfull")) {
        Fluttertoast.showToast(
            msg: "Updated Successfully",
            toastLength: Toast.LENGTH_SHORT,
            gravity: ToastGravity.BOTTOM,
            timeInSecForIosWeb: 2,
            backgroundColor: Colors.grey[800],
            textColor: Colors.white,
            fontSize: 18.0
        );

      }
      else if(response.body.contains("Update_Failed"))
        {
          Fluttertoast.showToast(
              msg: "Sorry, Update Failed",
              toastLength: Toast.LENGTH_SHORT,
              gravity: ToastGravity.BOTTOM,
              timeInSecForIosWeb: 2,
              backgroundColor: Colors.grey[800],
              textColor: Colors.white,
              fontSize: 18.0
          );
        }
    }
    catch(e)
    {
        debugPrint(e.toString());

        Fluttertoast.showToast(
            msg: "Error, Make sure\nyou're connected to internet",
            toastLength: Toast.LENGTH_SHORT,
            gravity: ToastGravity.BOTTOM,
            timeInSecForIosWeb: 2,
            backgroundColor: Colors.grey[800],
            textColor: Colors.white,
            fontSize: 18.0
        );
    }
  }


  _loadData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      stud_ID = (prefs.getString('stud_ID') ?? '');
      type = (prefs.getString('type') ?? '');
    });
  }





  Future<void> _showMyDialog(String rating) async {
    return showDialog<void>(
      context: context,
      barrierDismissible: false, // user must tap button!
      builder: (BuildContext context) {
        return AlertDialog(
          title: Text('Dear user'),
          content: SingleChildScrollView(
            child: ListBody(
              children: <Widget>[
                Text('Would you like to save your ratings?'),
              ],
            ),
          ),
          actions: <Widget>[
            FlatButton(
              child: Text('Cancel'),
              onPressed: () {
                Navigator.of(context).pop();
              },
            ),

            FlatButton(
              child: Text('Continue'),
              onPressed: () {
                setState(() {
                  star=rating.toString();
                });
                setNewRating();
                Navigator.of(context).pop();
              },
            ),
          ],
        );
      },
    );
  }


  @override
  Widget build(BuildContext context) {

    _height = MediaQuery.of(context).size.height;
    _width = MediaQuery.of(context).size.width;



    return Scaffold(
      key: _key,

      appBar: AppBar(
        title: Text("Book Details"),
        backgroundColor: Colors.black,
      ),

      body: Container(
          padding: EdgeInsets.all(15),
          child: ListView(

            children: [
              //displayIcon(),


              Center(
                  child:Container(
                    child:Image(
                      image: NetworkImage(widget.activityMap["imgLink"]),
                    ),
                  )
              ),

              SizedBox(
                  height: 15
              ),

              Center(

                child:Text(
                  "Your Rating:",
                  style: TextStyle(color: Colors.black,
                      fontWeight: FontWeight.bold,
                      fontSize: 16),
                ),


              ),

              Center(
                child:

                RatingBar(
                  initialRating:   widget.activityMap["star"]!=null?double.parse( widget.activityMap["star"]):0,
                  minRating: 1,
                  direction: Axis.horizontal,
                  allowHalfRating: true,
                  itemCount: 5,
                  unratedColor: Colors.black12,
                  itemPadding: EdgeInsets.symmetric(horizontal: 4.0),
                  itemBuilder: (context, _) => Icon(
                    Icons.star,
                    color: Colors.amber,
                  ),
                  onRatingUpdate: (rating) {
                    print(rating);
                    _showMyDialog(rating.toString());

                  },
                )
              ),


              SizedBox(
                  height: 10
              ),
              Text(
                "Title:",
                style: TextStyle(color: Colors.black,
                    fontWeight: FontWeight.bold,
                    fontSize: 16),
              ),

              Text(
                widget.activityMap["title"],
                style: TextStyle(color: Colors.blue[900],
                    fontSize: 16),
              ),

              SizedBox(
                  height: 10
              ),


              Text(
                "Author:",
                style: TextStyle(color: Colors.black,
                    fontWeight: FontWeight.bold,
                    fontSize: 16),
              ),

              Text(
                widget.activityMap["author"],
                style: TextStyle(color: Colors.blue[900],
                    fontSize: 16),
              ),

              SizedBox(
                  height: 10
              ),

              Text(
                "Issue Date",
                style: TextStyle(color: Colors.black,
                    fontWeight: FontWeight.bold,
                    fontSize: 16),
              ),
              Text(
                widget.activityMap["time"],
                style: TextStyle(color: Colors.blue[900],
                    fontSize: 16),
              ),
              SizedBox(
                  height: 10
              ),

              Text(
                "Return Date",
                style: TextStyle(color: Colors.black,
                    fontWeight: FontWeight.bold,
                    fontSize: 16),
              ),
              Text(
                widget.activityMap["returnTime"],
                style: TextStyle(color: Colors.blue[900],
                    fontSize: 16),
              ),
              SizedBox(
                  height: 10
              ),

              Text(
                "Issued Copy Id:",
                style: TextStyle(color: Colors.black,
                    fontWeight: FontWeight.bold,
                    fontSize: 16),
              ),
              Text(
                widget.activityMap["copyID"],
                style: TextStyle(color: Colors.blue[900],
                    fontSize: 16),
              ),




              SizedBox(
                  height: 10
              ),
              Text(
                "Fine:",
                style: TextStyle(color: Colors.black,
                    fontWeight: FontWeight.bold,
                    fontSize: 16),
              ),
              Text(
                widget.activityMap["fine"],
                style: TextStyle(color: Colors.blue[900],
                    fontSize: 16),
              ),

              SizedBox(
                  height: 10
              ),
              Text(
                "Publisher:",
                style: TextStyle(color: Colors.black,
                    fontWeight: FontWeight.bold,
                    fontSize: 16),
              ),
              Text(
                widget.activityMap["publisher"],
                style: TextStyle(color: Colors.blue[900],
                    fontSize: 16),
              ),
              SizedBox(
                  height: 10
              ),

              Text(
                "Pages:",
                style: TextStyle(color: Colors.black,
                    fontWeight: FontWeight.bold,
                    fontSize: 16),
              ),
              Text(
                widget.activityMap["pages"],
                style: TextStyle(color: Colors.blue[900],
                    fontSize: 16),
              ),
              SizedBox(
                  height: 10
              ),
              SizedBox(
                  height: 10
              ),

              Text(
                "ISBN:",
                style: TextStyle(color: Colors.black,
                    fontWeight: FontWeight.bold,
                    fontSize: 16),
              ),
              Text(
                widget.activityMap["isbn"],
                style: TextStyle(color: Colors.blue[900],
                    fontSize: 16),
              ),

              SizedBox(
                  height: 10
              ),



            ],
          )),

      //This trailing comma makes auto-formatting nicer for build methods.
    );
  }
}

//  (a>b)? print( : false statement





