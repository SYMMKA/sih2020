import 'dart:convert';
import 'dart:math';

import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:http/http.dart' as http;
import 'package:sihapp/ModelAvailableCopies.dart';

import 'package:sihapp/ShelvesBooks.dart';

import 'Search.dart';
import 'constants.dart';

class Wishlist extends StatefulWidget {
  final String stud_ID;

  Wishlist({Key key, this.stud_ID}) : super(key: key);
  @override
  _WishlistState createState() => _WishlistState();
}

class _WishlistState extends State<Wishlist> {
  bool checkBoxValue = false;
  double _height, _width;

  final GlobalKey<FormState> key = GlobalKey<FormState>();
  String email, password;
  List shelfs = new List();
  int state;
  List availableBooks = List();

  void initState() {
    super.initState();
    getShelf();
  }

  void checkBooks(String bookID) async {
    try {
      var response = await http.get(
          Uri.encodeFull(rootUrl + "getAvailableCopies.php?bookID=$bookID"),
          headers: {"Accept": "application/json"});

      if (!response.body.contains("NO_BOOKS_AVAILABLE")) {
        availableBooks = jsonDecode(response.body);
        // debugPrint("AVAILABLE BOOKS="+availableBooks.toString());
        setState(() {
          showDialog(
            context: context,
            builder: (_) => ModelAvailableCopies(
              jsondata: availableBooks,
              state: 0,
              bookID: bookID,
            ),
          );
        });
      } else {
        setState(() {
          showDialog(
            context: context,
            builder: (_) => ModelAvailableCopies(
              jsondata: availableBooks,
              state: 1,
              bookID: bookID,
            ),
          );
        });
      }
    } catch (e) {
      showToast("Error, Make sure\nyou're connected to internet");
    }
  }

  void removeBook(String stud_ID, String bookID) async {
    debugPrint(stud_ID);
    debugPrint(bookID);
    try {
      var response =
          await http.post(Uri.encodeFull(rootUrl + "wishlistItems.php"), body: {
        "stud_ID": stud_ID,
        "operation": "delete",
        "bookID": bookID,
      }, headers: {
        "Accept": "application/json"
      });

      debugPrint(response.body.toString());

      if (response.body.toString().contains("delete_Sucessfull")) {
        showToast("Removed Successfully");
        getShelf();
      } else {
        showToast("Failed");
      }
    } catch (e) {
      debugPrint(e.toString());
      showToast("Make sure ur connected to internet");
    }
  }

  void getShelf() async {
    debugPrint(widget.stud_ID);
    try {
      var response =
          await http.post(Uri.encodeFull(rootUrl + "wishlistItems.php"), body: {
        "stud_ID": widget.stud_ID,
        "operation": "fetch",
      }, headers: {
        "Accept": "application/json"
      });
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
            'Your Wish list',
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
                          shelfs[x]["title"],
                          shelfs[x]["bookID"],
                          shelfs[x]["author"],
                          shelfs[x]["publisher"],
                          shelfs[x]["status"]);
                    }),
              ));
  }

  Widget gridViewItem(String title, String BookId, String author,
      String publisher, String status) {
    return Container(
        child: Card(
            elevation: 4,
            margin: EdgeInsets.all(8),
            semanticContainer: true,
            color: Colors.amberAccent.shade50,
            child: Container(
              padding: EdgeInsets.all(10),
              //width: 100,
              //height: 120,
              color: status == "1"
                  ? Color(0xff4AD7D1).withOpacity(0.3)
                  : Colors.grey[200],
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Row(
                    children: <Widget>[
                      Expanded(
                        flex: 2,
                        child: Column(
                          children: <Widget>[
                            Text(
                              title,
                              overflow: TextOverflow.clip,
                              maxLines: 1,
                              softWrap: false,
                            ),
                            Text(
                              "Book ID:" + BookId,
                              overflow: TextOverflow.ellipsis,
                              maxLines: 1,
                            ),
                            Text(
                              "Author:" + author,
                              overflow: TextOverflow.ellipsis,
                              maxLines: 1,
                            ),
                            Text(
                              "Publisher:" + publisher,
                              overflow: TextOverflow.ellipsis,
                              maxLines: 1,
                            ),
                          ],
                        ),
                      ),
                      Expanded(
                        flex: 1,
                        child: Column(
                          children: <Widget>[
                            RaisedButton(
                              child: Text("Remove"),
                              onPressed: () {
                                removeBook(widget.stud_ID, BookId);
                                // getListItems(widget.stud_ID, copyId);
                              },
                            ),
                            status == "1"
                                ? RaisedButton(
                                    child: Text("Reserve"),
                                    color: Color(0xff4AD7D1),
                                    onPressed: () {
                                      // getListItems(widget.stud_ID, copyId);
                                      checkBooks(BookId);
                                    },
                                  )
                                : Container(),
                          ],
                        ),
                      )
                    ],
                  )
                ],
              ),
            )));
  }
}
