import 'dart:convert';

import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_rating_bar/flutter_rating_bar.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:http/http.dart' as http;
import 'ModelAvailableCopies.dart';
import 'Search.dart';
import 'constants.dart';


class ViewBook extends StatefulWidget {
  final Book book;
  // final String uemail,  ulname, uname, umobile;
  ViewBook({this.book});
  @override
  _ViewBookState createState() => _ViewBookState();
}

class _ViewBookState extends State<ViewBook> {
  bool status = false;
  int count = 0,state=0;
  double _height, _width;
  List availableBooks = List();
  String email;


  final _key = GlobalKey<ScaffoldState>();

  void initState() {
    super.initState();
    _loadData();
    // debugPrint(widget.book.star);
  }


  _loadData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      email = (prefs.getString('email') ?? '');
    });
  }

  void checkBooks(String bookID) async
  {
    try {

      var response = await http.get(
          Uri.encodeFull(
              rootUrl+"getAvailableCopies.php?bookID=$bookID"),
          headers: {"Accept": "application/json"}
      );



      if(!response.body.contains("NO_BOOKS_AVAILABLE")) {
        availableBooks = jsonDecode(response.body);
        // debugPrint("AVAILABLE BOOKS="+availableBooks.toString());
        setState(() {
          showDialog(
            context: context,
            builder: (_) => ModelAvailableCopies(jsondata: availableBooks,state: 0,),
          );
        });
      }
      else{
        setState(() {
          showDialog(
            context: context,
            builder: (_) => ModelAvailableCopies(jsondata: availableBooks,state: 1,),
          );
        });
      }
    }
    catch(e)
    {

      showToast("Error, Make sure\nyou're connected to internet");

    }
  }



  @override
  Widget build(BuildContext context) {

    _height = MediaQuery.of(context).size.height;
    _width = MediaQuery.of(context).size.width;



    return Scaffold(
      key: _key,

      appBar: AppBar(
        title: Text(
          'Scanned Book',
          style: TextStyle(color: Color(0xff001730)),
        ),
        backgroundColor: Colors.white,
        iconTheme: IconThemeData(color: Color(0xff001730)),
      ),
      body: Container(
          padding: EdgeInsets.all(15),
          child: ListView(

            children: [
              //displayIcon(),


              Center(
                  child:Container(
                    child:Image(
                      image: NetworkImage(widget.book.imgLink),
                    ),
                  )
              ),

              SizedBox(
                  height: 15
              ),

              Center(

                child:Text(
                  "Average Rating:",
                  style: TextStyle(color: Colors.black,
                      fontWeight: FontWeight.bold,
                      fontSize: 16),
                ),


              ),

              Center(
                child:

                RatingBarIndicator(
                  rating: widget.book.star!=null?double.parse(widget.book.star):5,
                  itemBuilder: (context, index) => Icon(
                    Icons.star,
                    color: Colors.amber,
                  ),
                  itemCount: 5,
                  itemSize: 40.0,
                  direction: Axis.horizontal,
                ),
              ),


              Text(
                "Title:",
                style: TextStyle(color: Colors.black,
                    fontWeight: FontWeight.bold,
                    fontSize: 16),
              ),

              Text(
                widget.book.title,
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
                widget.book.author,
                style: TextStyle(color: Colors.blue[900],
                    fontSize: 16),
              ),

              SizedBox(
                  height: 10
              ),

              Text(
                "Quantity:",
                style: TextStyle(color: Colors.black,
                    fontWeight: FontWeight.bold,
                    fontSize: 16),
              ),
              Text(
                widget.book.quantity,
                style: TextStyle(color: Colors.blue[900],
                    fontSize: 16),
              ),
              SizedBox(
                  height: 10
              ),

              Text(
                "Category:",
                style: TextStyle(color: Colors.black,
                    fontWeight: FontWeight.bold,
                    fontSize: 16),
              ),
              Text(
                widget.book.category,
                style: TextStyle(color: Colors.blue[900],
                    fontSize: 16),
              ),


              SizedBox(
                  height: 10
              ),
              Text(
                "Sub-Category:",
                style: TextStyle(color: Colors.black,
                    fontWeight: FontWeight.bold,
                    fontSize: 16),
              ),
              Text(
                widget.book.subCategory,
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
                widget.book.publisher,
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
                widget.book.pages,
                style: TextStyle(color: Colors.blue[900],
                    fontSize: 16),
              ),
              SizedBox(
                  height: 10
              ),
              Text(
                "Price:",
                style: TextStyle(color: Colors.black,
                    fontWeight: FontWeight.bold,
                    fontSize: 16),

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
                widget.book.isbn,
                style: TextStyle(color: Colors.blue[900],
                    fontSize: 16),
              ),

              SizedBox(
                  height: 20
              ),


              RaisedButton(
                color: Colors.black,

                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(4),
                ),
                onPressed: () {
                  // If statement is validating the input fields.
                  checkBooks(widget.book.bookID);
                },
                child: Row(
                  mainAxisSize: MainAxisSize.min,
                  children: <Widget>[
                    Icon(
                      Icons.lock_open,
                      color: Colors.white,
                    ),

                    SizedBox(width: 4),
                    Text(
                      "Reserve Book",
                      style: TextStyle(color: Colors.white),
                    ),
                  ],
                ),
              )


            ],
          )),

      //This trailing comma makes auto-formatting nicer for build methods.
    );
  }
}

//  (a>b)? print( : false statement


