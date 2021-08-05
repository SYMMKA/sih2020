
import 'dart:async';

import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';

import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:sihapp/ViewBook.dart';

import 'ModelAvailableCopies.dart';
import 'ModelBookPreview.dart';
import 'Search.dart';
import 'constants.dart';






class ShelvesBooks extends StatefulWidget {
  @override

  // final String uemail,  ulname, uname, umobile;
  final String shelfid;
  ShelvesBooks({Key key, @required this.shelfid}) : super(key: key);


  _ShelvesBooksState createState() => new _ShelvesBooksState();
}





class _ShelvesBooksState extends State<ShelvesBooks> {
  TextEditingController controller = new TextEditingController();
  double _height, _width;
  List availableBooks = List();

  // Get json result and convert it to model. Then add
  Future<Null> getUserDetails() async {

    try{
    var response = await http.get(
        Uri.encodeFull(
            rootUrl+"getShelfCopies.php?shelfID="+widget.shelfid),
        headers: {"Accept": "application/json"}
    );
    final responseJson = json.decode(response.body);

    setState(() {
      _searchResult.clear();
      for (Map user in responseJson) {
        _searchResult.add(ShelfBookDetails.fromJson(user));
      }
      debugPrint(_searchResult.length.toString());
    });

  }
  catch(e)
    {
      debugPrint(e.toString());
    }

  }

  @override
  void initState() {
    super.initState();
    getUserDetails();

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


  Widget displayBooks(int x, bool searchType)
  {
    String status;
    if(searchType)
      {

          status=_catResult[x].status;
      }
    else{
        status=_searchResult[x].status;
    }

    return Container(

        height: 160.0,
        child: Card(

            color: status==""? Colors.white:Colors.white70,
            elevation: 4,
            margin: EdgeInsets.all(10),
            semanticContainer: true,
            //color: Colors.amberAccent.shade50,
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
                              image: DecorationImage(image: NetworkImage( searchType?_catResult[x].imgLink :_searchResult[x].imgLink),
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
                                  searchType?"Title: "+_catResult[x].title: "Title: "+_searchResult[x].title,
                                  overflow: TextOverflow.clip,
                                  maxLines: 1,
                                  softWrap: false,

                                ),

                                Text(
                                  searchType?"Author: "+_catResult[x].author:"Author: "+ _searchResult[x].author,
                                  overflow: TextOverflow.clip,
                                  maxLines: 1,
                                  softWrap: false,
                                ),

                                Text(
                                  searchType?"Publication: "+_catResult[x].publisher: "Publication: "+_searchResult[x].publisher,
                                  overflow: TextOverflow.clip,
                                  maxLines: 1,
                                  softWrap: false,
                                ),

                                Container(
                                    margin: EdgeInsets.only(top: 10),
                                    child:Row(
                                      mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                                      children: <Widget>[
                                        Text(
                                          searchType?_catResult[x].copyID:_searchResult[x].copyID,
                                          overflow: TextOverflow.ellipsis,
                                          maxLines: 1,
                                        ),


                                      //might be used later
//                                        RaisedButton(
//                                          shape: RoundedRectangleBorder(
//                                            borderRadius: BorderRadius.circular(8),
//                                          ),
//                                          onPressed: () {
//                                            // If statement is validating the input fields.
//                                            final book = new Book(
//                                                searchType? _catResult[x].title : _searchResult[x].title,
//                                                searchType?_catResult[x].author : _searchResult[x].author,
//                                                searchType? _catResult[x].category : _searchResult[x].category,
//                                                searchType?_catResult[x].subCategory : _searchResult[x].subCategory,
//                                                searchType?_catResult[x].publisher : _searchResult[x].publisher,
//                                                searchType?_catResult[x].pages : _searchResult[x].pages,
//                                                searchType?_catResult[x].price : _searchResult[x].price,
//                                                searchType? _catResult[x].quantity : _searchResult[x].quantity,
//                                                searchType?_catResult[x].imgLink : _searchResult[x].imgLink,
//                                                searchType?_catResult[x].date_of_publication : _searchResult[x].date_of_publication,
//                                                searchType? _catResult[x].isbn : _searchResult[x].isbn,
//                                                searchType?_catResult[x].bookID : _searchResult[x].bookID,
//                                                searchType? _catResult[x].star : _searchResult[x].star);
//
//
//                                            showDialog(
//                                                context: context,
//                                                builder: (BuildContext context) {
//                                                  return bookPreview(context, book);
//                                                });
//
//                                          },
//                                          color: Colors.grey[200],
//                                          child: Text("Preview "),
//
//                                        ),

                                        status==""?RaisedButton(
                                          shape: RoundedRectangleBorder(
                                            borderRadius: BorderRadius.circular(8),
                                          ),
                                          onPressed: () {
                                            // If statement is validating the input fields.
                                            checkBooks(searchType?_catResult[x].bookID : _searchResult[x].bookID);
                                          },
                                          color: Color(0xff4AD7D1),
                                          child: Text("Reserve "),

                                        ):Text(status),

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



  @override
  Widget build(BuildContext context) {
    _height = MediaQuery.of(context).size.height;
    _width = MediaQuery.of(context).size.width;


    return new Scaffold(
      appBar: new AppBar(

        title: new Text('Books of '+widget.shelfid),
        backgroundColor: Colors.white,
        iconTheme: IconThemeData(color: Color(0xff001730)),
        elevation: 0.0,
      ),
      body: new Column(
        children: <Widget>[
          new Container(

            color: Theme.of(context).cardColor,
            child: new Padding(
              padding: const EdgeInsets.all(8.0),
              child: new Card(
                child: new ListTile(
                  leading: new Icon(Icons.search),
                  title: new TextField(
                    controller: controller,
                    decoration: new InputDecoration(
                        hintText: 'Search', border: InputBorder.none),
                    onChanged: onSearchTextChanged,
                  ),
                  trailing: new IconButton(icon: new Icon(Icons.cancel), onPressed: () {
                    controller.clear();
                    onSearchTextChanged('');
                  },),
                ),
              ),
            ),
          ),
          new Expanded(
          child: ListView.builder(
          // gridDelegate:SliverGridDelegateWithFixedCrossAxisCount(crossAxisCount: 1),
          itemCount:  _catResult.length!=0 || controller.text.isNotEmpty? _catResult.length : _searchResult.length,
            itemBuilder: (BuildContext context, int x) {
            return _catResult.length!=0 || controller.text.isNotEmpty? displayBooks(x,true):displayBooks(x,false);
            }),
            ),
          ]),
    );

  }

  onSearchTextChanged(String text) async {
    _catResult.clear();
    if (text.isEmpty) {
      setState(() {});
      return;
    }

    debugPrint(text);
    _searchResult.forEach((search) {
      if (search.title.contains(text) ||
          search.author.contains(text) ||
          search.category.contains(text) ||
          search.subCategory.contains(text) ||
          search.publisher.contains(text) ||
          search.pages.contains(text) ||
          search.price.contains(text) ||
          search.quantity.contains(text) ||
          search.date_of_publication.contains(text) ||
          search.isbn.contains(text) ||
          search.bookID.contains(text) ||
          search.author.contains(text)) {
        _catResult.add(search);
      }
    });
    debugPrint(_catResult.length.toString());

    setState(() {});
  }
}

List<ShelfBookDetails> _catResult = [];

List<ShelfBookDetails> _searchResult = [];


class ShelfBookDetails {

  final String title, author, category, subCategory, publisher, pages, price, quantity, imgLink, date_of_publication, isbn,bookID,copyID,status,star;


  ShelfBookDetails({ this.title, this.author, this.category, this.subCategory,
    this.publisher, this.pages, this.price, this.quantity, this.imgLink,
    this.date_of_publication, this.isbn,this.bookID,this.copyID,this.status,this.star});

  factory ShelfBookDetails.fromJson(Map<String, dynamic> json) {
    return new ShelfBookDetails(
      isbn: json['isbn'],
      title: json['title'],
      status: json['status'],
      author: json['author'],
      category: json['Category1'],
      subCategory: json['Category2'],
      publisher: json['publisher'],
      pages: json['pages'],
      price: json['price'],
      quantity: json['quantity'],
      imgLink: json['imgLink'],
      date_of_publication: json['date_of_publication'],
      bookID: json['bookID'],
      copyID: json['copyID'],
      star: json['star'],
    );
  }
}


