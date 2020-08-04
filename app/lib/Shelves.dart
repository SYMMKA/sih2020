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


class Shelves extends StatefulWidget {
  @override
  _ShelvesState createState() => _ShelvesState();
}

class _ShelvesState extends State<Shelves> {
  bool checkBoxValue = false;
  double _height, _width;

  final GlobalKey<FormState> key = GlobalKey<FormState>();
  String email, password;
  List shelfs=new List();


  void initState() {
    super.initState();
    _loadData();
    getShelf();

  }

  _loadData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      email = (prefs.getString('email') ?? '');
    });
  }



  void getShelf() async
  {
    try {
      var response = await http.get(
          Uri.encodeFull(
              rootUrl+"shelf.php"),
          headers: {"Accept": "application/json"}
      );

      setState(() {
        shelfs = jsonDecode(response.body);
      });

    }
    catch(e)
    {
      debugPrint(e.toString());
    }

  }


  @override
  Widget build(BuildContext context) {
    _height = MediaQuery
        .of(context)
        .size
        .height;
    _width = MediaQuery
        .of(context)
        .size
        .width;

    return Scaffold(

        body:Container(
//            child: GridView.count(
//              // Create a grid with 2 columns. If you change the scrollDirection to
//              // horizontal, this produces 2 rows.
//              crossAxisCount: 1,
//
//              // Generate 100 widgets that display their index in the List.
//              children: List.generate(shelfs.length, (index) {
//                return gridViewItem(shelfs[index]["shelfID"],shelfs[index]["count"],index);
//              }),
//            )

            child: ListView.builder(
        // gridDelegate:SliverGridDelegateWithFixedCrossAxisCount(crossAxisCount: 1),
            itemCount: shelfs.length,
                itemBuilder: (BuildContext context, int x) {
                  return gridViewItem(shelfs[x]["shelfID"],shelfs[x]["count"],x);
            }),
        )

    );
  }





  Widget gridViewItem(String shelfId,var noOfBooks, int index) {

    return GestureDetector(
        onTap: noOfBooks!=0? () {
          Navigator.push(
            context,
            MaterialPageRoute(builder: (context) => ShelvesBooks(shelfid: shelfId,)),
          );
        }: () {
          showToast("This shelf is empty");

        },

        child:Card(

              elevation: 4,
              margin: EdgeInsets.all(8),
              semanticContainer: true,
              color: Colors.amberAccent.shade50,
        child: Container(
          //width: 100,
          height: 70,
          decoration: BoxDecoration(
            gradient: LinearGradient(
                colors: [Colors.white, Colors.white] ),
            borderRadius: BorderRadius.all(Radius.circular(15)),
          ),
          child: Column(

            mainAxisAlignment: MainAxisAlignment.center,
            children: [

            Row(

              children: <Widget>[

                Expanded(
                  flex: 1,
                  child: Container(
                    child: Center( child:Text(shelfId.toUpperCase(),style: TextStyle(fontSize: 16,),)),
                  ),
                ),
                Expanded(
                  flex: 1,
                  child: Container(
                    child: Text("No of Books= $noOfBooks",style: TextStyle(fontSize: 16),),
                  ),
                )
              ],
            )
            ],
          ),
        )));

  }


}
