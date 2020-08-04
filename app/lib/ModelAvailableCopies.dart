import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:http/http.dart' as http;
import 'constants.dart';

class ModelAvailableCopies extends StatefulWidget {
  final List jsondata;
  final int state;
  final String bookID;

  ModelAvailableCopies({Key key, this.jsondata, this.state,this.bookID}) : super(key: key);

  @override
  State<StatefulWidget> createState() => ModelAvailableCopiesState();
}

class ModelAvailableCopiesState extends State<ModelAvailableCopies>
    with SingleTickerProviderStateMixin {
  int state, tempindex;
  String stud_ID,type,name,bookID;
  Map selectedValue;



  @override
  void initState() {
    super.initState();
    _loadData();
    setState(() {
      state = widget.state;
    });
  }



  _loadData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      stud_ID = (prefs.getString('stud_ID') ?? '');
      type = (prefs.getString('type') ?? '');
      name = (prefs.getString('name') ?? '');
    });
  }

  void addtoWishList() async
  {

    debugPrint(widget.bookID);
    bookID=widget.bookID;
    final response = await http.post(rootUrl + "insertInWishlist.php", body: {
      'bookID': bookID,
      'stud_ID': stud_ID,
    });
    debugPrint("response="+response.body);

    if(response.body.contains("already present"))
      {
          showToast("already present");
      }

    else  if(response.body.contains("insert_Sucessfull"))
    {
      showToast("added to wishlist");
    }
    else
    {
      showToast("Failed");
    }

  }

  void reserveBook() async {



    try {
      int bookID = int.parse(widget.jsondata[tempindex]["bookID"]);
      int copyNO = int.parse(widget.jsondata[tempindex]["copyNO"]);
      // debugPrint(bookID.toString()+copyNO.toString()+stud_ID);

//      var response = await http.get(
//        Uri.encodeFull(rootUrl +
//            "reserveBook.php?bookID=$bookID & copyNO=$copyNO & stud_ID=$stud_ID&type=$type"),
//      );

      final response = await http.post(rootUrl + "reserveBook.php", body: {
        "bookID": bookID.toString(),
        "copyNO": copyNO.toString(),
        "stud_ID": stud_ID,
        "type": type,
      });

       debugPrint("response="+response.body);
      if(response.body.contains("out_of_limit"))
        {
          showToast("Reservation limit over");
        }
      else if (response.body.contains("one_copy_is_already_reserved")) {
        showToast("You've already reserved one\ncopy of this book");
      } else if (response.body.contains("Reservation_Sucessfull")) {
        setState(() {
          state = 2;
          debugPrint(tempindex.toString());
        });
      } else {
        showToast("Error....");
      }
    } catch (e) {
      showToast("Error, Make sure\nyou're connected to internet");
    }
  }

  @override
  Widget build(BuildContext context) {
    return Center(
      child: Material(
        color: Colors.transparent,
        child: Container(
          height: MediaQuery.of(context).size.height / 2,
          width: MediaQuery.of(context).size.width - 50,
          decoration: ShapeDecoration(
              color: Colors.white,
              shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(15.0))),
          child: state == 0
              ?Center(
              child:ListView(
                  padding: const EdgeInsets.only(
                      top: 30, bottom: 30, left: 20, right: 20),
                  children: [
                   Container(
                       child:Text(
                      "Here are the available Copies. Select one to reserve!",
                      style: TextStyle(
                          fontSize: 16,
                          color: Colors.black,
                          ),
                    )
                   ),
                    Column(

                      children: List.generate(widget.jsondata.length, (index) {
                        return Padding(
                          padding: EdgeInsets.all(5),

                          child: Container(
                            padding: EdgeInsets.all(5),

                            child: Row(
                              mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                              children: <Widget>[
                                Column(
                                  children: <Widget>[
                                    Text("Copy-ID= "+ widget.jsondata[index]["copyID"]),
                                  ],
                                ),

                                RaisedButton(
                                  onPressed: (){
                                      setState(() {
                                        tempindex = index;
                                        debugPrint(tempindex.toString());
                                      });
                                      reserveBook();
                                  },
                                  color: Colors.lightBlue.shade50,
                                  child: Text("Reserve"),
                                )
                              ],
                            ),
                          ),
                        );
                        //Text(keys[index].toString());
                      }),
                    )
                  ],
                ))
              : state == 1
                  ? ListView(
                      children: <Widget>[
                        Container(
                          padding: EdgeInsets.all(15),
                          child: Center(
                            child: Column(
                              crossAxisAlignment: CrossAxisAlignment.center,
                              mainAxisAlignment: MainAxisAlignment.center,
                              children: <Widget>[
                                Text(
                                  "Dear $name\n\n",
                                  style: TextStyle(
                                      color: Colors.black,
                                      fontWeight: FontWeight.bold,
                                      fontSize: 16),
                                ),
                                Text(
                                  "There are no copies available for this book",
                                  style: TextStyle(color: Colors.black),
                                ),
                                Text(
                                  "\n You can add this book to wishlist for getting notified regarding the availability of book.",
                                  style: TextStyle(color: Colors.black),
                                ),



                            RaisedButton(
                              color: Colors.grey[100],

                              shape: RoundedRectangleBorder(
                                borderRadius: BorderRadius.circular(4),
                              ),
                              onPressed: () {
                                // If statement is validating the input fields.
                                addtoWishList();
                              },
                              child: Text(
                                "Add to WishList",
                                style: TextStyle(color: Colors.black),
                              ),
                            ),
                              ],
                            ),
                          ),
                        )
                      ],
                    )
                  : ListView(
                      children: <Widget>[
                        Container(
                          padding: EdgeInsets.all(15),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.center,
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: <Widget>[
                              Text(
                                "Dear $name\n\n",
                                style: TextStyle(
                                    color: Colors.black,
                                    fontWeight: FontWeight.bold,
                                    fontSize: 16),
                              ),
                              Text(
                                "You have successfully reserved " +
                                    widget.jsondata[tempindex]["copyID"],
                                style: TextStyle(color: Colors.black),
                              ),
                              Text(
                                "Make sure you issue your book within 2 hrs",
                                style: TextStyle(color: Colors.black),
                              ),
                              Text(
                                "Else your reservation will be cancelled",
                                style: TextStyle(color: Colors.black),
                              ),
                              Text(
                                "\n THANKYOU.",
                                style: TextStyle(color: Colors.black),
                              ),
                            ],
                          ),
                        )
                      ],
                    ),
        ),
      ),
    );
  }
}
