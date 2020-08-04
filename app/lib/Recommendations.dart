import "package:flutter/material.dart";
import 'dart:async';
import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:sihapp/constants.dart';

import 'ModelAvailableCopies.dart';
import 'ModelBookPreview.dart';
import 'Search.dart';

class Syllabus extends StatefulWidget {
  @override
  _SyllabusState createState() => _SyllabusState();
}

class SelectedCategory {
  const SelectedCategory(this.id, this.description, this.number,
      this.generalities, this.subordinates);

  final String id, number, description, generalities;
  final Map subordinates;
}

class _SyllabusState extends State<Syllabus> {
  int _mySelection;

  final String url = rootUrl + "sem_branch.php";
  int cat1, cat2, cat3, cat4;
  String sem_branchID;

  Map mapcategory1 = Map();
  Map mapcategory2 = Map();


  List category1 = List();
  List category2 = List(); //edited line
  List availableBooks = List();


  List<BookDetails> _searchResult = [];

  getCategory1() async {
    var res = await http
        .get(Uri.encodeFull(url), headers: {"Accept": "application/json"});

    var resBody = json.decode(res.body);
    debugPrint(res.body);

    setState(() {
      //category1 = resBody;
      mapcategory1=resBody;
      category1 =mapcategory1.keys.toList();
    });

    debugPrint(mapcategory1.keys.toList().toString());

  }

  void getCategory2(key) {
    cat2=null;
    mapcategory2 = mapcategory1[category1[key]];
    debugPrint(mapcategory2.toString());


    setState(() {
      category2 =mapcategory2.keys.toList();
    });
  }


  void getBooks(key) async {
    _searchResult.clear();

   debugPrint( mapcategory2[category2[key]]);
   setState(() {
     sem_branchID= mapcategory2[category2[key]];
   });

   final response = await http.post(rootUrl + "getBooks.php", body: {
     "sem_branchID": sem_branchID,
   });


   try {
     var data = json.decode(response.body);
     debugPrint(response.body);


     setState(() {
       _searchResult.clear();
       for (Map user in data) {
         _searchResult.add(BookDetails.fromJson(user));
       }
       debugPrint(_searchResult.length.toString());
     });
   }
   catch(e)
   {
     debugPrint(response.body.toString());
     showToast("No Results Found");
   }

  }


  @override
  void initState() {
    super.initState();
    this.getCategory1();
  }

  @override
  Widget build(BuildContext context) {
    return new Scaffold(
      body: new Center(
          child: Container(
        padding: EdgeInsets.all(20),
        child: ListView(
            children: <Widget>[
                      new DropdownButton(
                        isExpanded: true,
                        hint: Text("Select Semester"),
                        items: category1.map((item) {
                          return new DropdownMenuItem(
                            child: new Text(item),
                            value: category1.indexOf(item),
                          );
                        }).toList(),
                        onChanged: (newVal) {
                          setState(() {
                            cat1 = newVal;
                            debugPrint(newVal.toString());
                            getCategory2(cat1);
                          });
                        },
                        value: cat1,
                      ),

              new DropdownButton(
                isExpanded: true,
                hint: Text("Select Branch"),
                items: category2.map((item) {
                  return new DropdownMenuItem(
                    child: new Text(item),
                    value: category2.indexOf(item),
                  );
                }).toList(),
                onChanged: (newVal) {
                  setState(() {
                    cat2 = newVal;
                    debugPrint(newVal.toString());
                    getBooks(cat2);
                  });
                },
                value: cat2,
              ),

              Container(
                height: MediaQuery.of(context).size.height/1.4,
                color: Colors.white70,
                //color: Colors.deepOrangeAccent,
                child: ListView.builder(
                  // gridDelegate:SliverGridDelegateWithFixedCrossAxisCount(crossAxisCount: 1),
                    itemCount:  _searchResult.length,
                    itemBuilder: (BuildContext context, int x) {
                      return displayBooks(x);
                    }),
              ),

        ]),
      )),
    );
  }





  Widget displayBooks(int x)
  {
    return Container(
        height: 160.0,
        child: Card(

            elevation: 4,

            semanticContainer: true,
            color: Colors.amberAccent.shade50,
            child: Container(

                child:Column(
                  children: <Widget>[

                    Row(
                      crossAxisAlignment: CrossAxisAlignment.start,

                      children: <Widget>[
                        Container(
                          height: 120.0,
                          width: MediaQuery.of(context).size.width/4,
                          decoration: BoxDecoration(
                              image: DecorationImage(image: NetworkImage(_searchResult[x].imgLink),
                                  fit: BoxFit.cover)
                          ),
                        ),
                        Container(
                            width: MediaQuery.of(context).size.width/1.6,
                            padding: EdgeInsets.all(5),
                            child:Column(
                              crossAxisAlignment: CrossAxisAlignment.start,

                              children: <Widget>[


                                Text(
                                  "Title: "+_searchResult[x].title,
                                  overflow: TextOverflow.clip,
                                  maxLines: 2,
                                  softWrap: false,
                                  style: TextStyle(fontSize: 12),

                                ),

                                Text(
                                  "Author: "+ _searchResult[x].author,
                                  overflow: TextOverflow.clip,
                                  maxLines: 1,
                                  softWrap: false,

                                  style: TextStyle(fontSize: 12),
                                ),

                                Text(
                                  "Publication: "+_searchResult[x].publisher,
                                  overflow: TextOverflow.clip,
                                  maxLines: 1,
                                  softWrap: false,
                                  style: TextStyle(fontSize: 12),
                                ),

                                Container(
                                    margin: EdgeInsets.only(top: 10),
                                    child:Row(
                                      mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                                      children: <Widget>[
                                        RaisedButton(
                                          shape: RoundedRectangleBorder(
                                            borderRadius: BorderRadius.circular(8),
                                          ),
                                          onPressed: () {
                                            // If statement is validating the input fields.
                                            final book = new Book(
                                                 _searchResult[x].title,
                                               _searchResult[x].author,
                                                 _searchResult[x].category,
                                                 _searchResult[x].subCategory,
                                               _searchResult[x].publisher,
                                             _searchResult[x].pages,
                                             _searchResult[x].quantity,
                                               _searchResult[x].imgLink,
                                             _searchResult[x].date_of_publication,
                                          _searchResult[x].isbn,
                                                 _searchResult[x].bookID,
                                               _searchResult[x].star);


                                            showDialog(
                                                context: context,
                                                builder: (BuildContext context) {
                                                  return bookPreview(context, book);
                                                });

                                          },
                                          color: Colors.grey[200],
                                          child: Text("Details "),

                                        ),

                                        RaisedButton(
                                          shape: RoundedRectangleBorder(
                                            borderRadius: BorderRadius.circular(8),
                                          ),
                                          onPressed: () {
                                            // If statement is validating the input fields.
                                            checkBooks( _searchResult[x].bookID);
                                          },
                                          color: Color(0xff4AD7D1),
                                          child: Text("Reserve "),

                                        ),

                                      ],
                                    )
                                )


                              ],

                            )
                        ),
                      ],
                    )
                  ],
                )
            )
        )
    );
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
            builder: (_) => ModelAvailableCopies(jsondata: availableBooks,state: 0,bookID: bookID,),
          );
        });
      }
      else{
        setState(() {
          showDialog(
            context: context,
            builder: (_) => ModelAvailableCopies(jsondata: availableBooks,state: 1,bookID: bookID,),
          );
        });
      }
    }
    catch(e)
    {

      showToast("Error, Make sure\nyou're connected to internet");

    }
  }


}



