import 'dart:async';

import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';

import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:sihapp/ModelBookPreview.dart';
import 'package:url_launcher/url_launcher.dart';
import 'ModelAvailableCopies.dart';
import 'constants.dart';


class Book {
  final String title,
      author,
      category,
      subCategory,
      publisher,
      pages,
      quantity,
      imgLink,
      date_of_publication,
      isbn,
      bookID,
      star;
  Book(
      this.title,
      this.author,
      this.category,
      this.subCategory,
      this.publisher,
      this.pages,
      this.quantity,
      this.imgLink,
      this.date_of_publication,
      this.isbn,
      this.bookID,
      this.star);
}

class Ebooks extends StatefulWidget {
  @override
  _EbooksState createState() => new _EbooksState();
}



class _EbooksState extends State<Ebooks> {
  TextEditingController controller = new TextEditingController();
  double _height, _width;

  String getcat1, getcat2, getcat3, getcat4;
  int cat1, cat2, cat3, cat4;
  bool catState=false;

  Map mapcategory2 = Map();
  Map mapcategory3 = Map();
  Map mapcategory4 = Map();

  List category1 = List();
  List category2 = List(); //edited line
  List category3 = List(); //edited line
  List category4 = List(); //edited line
  List availableBooks = List();





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
    return Container(


        decoration: BoxDecoration(

          borderRadius: BorderRadius.only(
              bottomLeft: Radius.circular(20),
              bottomRight: Radius.circular(20)),
        ),
        child:
        GestureDetector(
          onTap: (){
            if(x%2==0)
              {
               launch('http://africau.edu/images/default/sample.pdf');
              }
            else
              {
                launch('https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf');
              }
          },
          child:Card(

              elevation: 2,
              margin: EdgeInsets.all(10),
              semanticContainer: true,
              color: Colors.amberAccent.shade50,
              child: Container(

                  child:Column(
                    children: <Widget>[

                      Container(
                        height: 120.0,
                        decoration: BoxDecoration(
                          image: DecorationImage(image: NetworkImage( searchType?_catResult[x].imgLink :_searchResult[x].imgLink),
                              fit: BoxFit.fitWidth
                          ),

                          borderRadius: BorderRadius.only(
                              bottomLeft: Radius.circular(20),
                              topLeft: Radius.circular(20),
                              topRight: Radius.circular(20),
                              bottomRight: Radius.circular(20)),

                        ),
                      ),


                      Text(
                        searchType?_catResult[x].title: _searchResult[x].title,
                        overflow: TextOverflow.clip,
                        maxLines: 1,
                        softWrap: false,
                        style: TextStyle(fontSize: 12),
                      ),

                      Text(
                        searchType?_catResult[x].author: _searchResult[x].author,
                        overflow: TextOverflow.clip,
                        maxLines: 1,
                        softWrap: false,
                        style: TextStyle(fontSize: 12),
                      ),



                    ],
                  )
              )
          ) ,
        )


    );
  }









  Widget body() {
    return ListView(
      children: <Widget>[
        Container(
          //height: 400,
          //color: Colors.green,
          child: upperPart(),
        ),
        Container(
          height: MediaQuery.of(context).size.height/1.4,
          color: Colors.white70,
          //color: Colors.deepOrangeAccent,
//          child: ListView.builder(
//            // gridDelegate:SliverGridDelegateWithFixedCrossAxisCount(crossAxisCount: 1),
//              itemCount:  _catResult.length!=0 || catState==true? _catResult.length : _searchResult.length,
//              itemBuilder: (BuildContext context, int x) {
//                return _catResult.length!=0 || catState==true? displayBooks(x,true):displayBooks(x,false);
//              }),
            child:GridView.count(
              // Create a grid with 2 columns. If you change the scrollDirection to
              // horizontal, this produces 2 rows.
              crossAxisCount: 2,
              // Generate 100 widgets that display their index in the List.
              children: List.generate(_catResult.length!=0 || catState==true? _catResult.length : _searchResult.length, (index) {
                return _catResult.length!=0 || catState==true? displayBooks(index,true):displayBooks(index,false);
              }),
            ),

        ),

      ],
    );
  }







  getCategory1() async {

    var res = await http.get(Uri.encodeFull(rootUrl + "allcategory.php"),
        headers: {"Accept": "application/json"});

    var resBody = json.decode(res.body);

    setState(() {
      category1 = resBody;
    });

  }



  void getCategory2(int key) {
    mapcategory2 = category1[key];
    setState(() {
      getcat1 = category1[key]["description"];
      onSearchTextChanged(getcat1);
    });
    // debugPrint(mapcategory2.toString());
    if (mapcategory2.containsKey("subordinates")) {
      setState(() {
        category2 = mapcategory2["subordinates"];
        //   debugPrint(category2.toString());
      });
    }
  }

  void getCategory3(int key) {
    mapcategory3 = category2[key];
    setState(() {
      getcat2 = category2[key]["description"];
      onSearchTextChanged(getcat2);
    });
    // debugPrint(mapcategory3.toString());
    if (mapcategory3.containsKey("subordinates")) {
      setState(() {
        category3 = mapcategory3["subordinates"];
        //   debugPrint(category3.toString());
      });
    }
  }

  void getCategory4(int key) {
    mapcategory4 = category3[key];
    setState(() {
      getcat3 = category3[key]["description"];
      onSearchTextChanged(getcat3);
    });
    // debugPrint(mapcategory4.toString());
    if (mapcategory4.containsKey("subordinates")) {
      setState(() {
        category4 = mapcategory4["subordinates"];
        //   debugPrint(category4.toString());
      });
    }
  }

  // Get json result and convert it to model. Then add
  Future<Null> getAllBooks() async {
    // final response = await http.get(rootUrl + 'allbooks.php');
    final response = await http.post(rootUrl + 'allbooks.php', body: {
      "search": controller.text,
    });

    try {
      final responseJson = json.decode(response.body);

      setState(() {
        _searchResult.clear();
        for (Map user in responseJson) {
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
    // getAllBooks();
    //getCategory1();
    _searchResult.clear();
    _catResult.clear();
  }



  Widget searchButton()
  {
    return  RaisedButton(
      color: Colors.grey[100],

      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(4),
      ),
      onPressed: () {
        // If statement is validating the input fields.
        catState=false;
        _searchResult.clear();
        _catResult.clear();
        getCategory1();
        cat1=null;
        cat2=null;
        cat3=null;
        cat4=null;
        getAllBooks();

      },
      child: Row(
        mainAxisSize: MainAxisSize.min,
        children: <Widget>[

          SizedBox(width: 4),
          Text(
            "Search",
            style: TextStyle(color: Colors.black),
          ),
        ],
      ),
    );
  }

  Widget filter() {
    return Visibility(
      child:
      new Center(
          child: Container(
            padding: EdgeInsets.only(left: 10, right: 10),
            child: Column(
              children: <Widget>[
                new ExpansionTile(
                    title: new Text("Filterations"),
                    backgroundColor: Theme.of(context).accentColor.withOpacity(0.025),
                    children: <Widget>[
                      new DropdownButton(
                        isExpanded: true,
                        hint: Text("Select Category"),
                        items: category1.map((item) {
                          return new DropdownMenuItem(
                            child: new Text(item['description']),
                            value: category1.indexOf(item),
                          );
                        }).toList(),
                        onChanged: (newVal) {
                          setState(() {
                            cat1 = newVal;
                            debugPrint(cat1.toString());
                            getCategory2(cat1);
                          });
                        },
                        value: cat1,
                      ),
                      new DropdownButton(
                        isExpanded: true,
                        hint: Text("Select Sub-Category1"),
                        items: category2.map((item) {
                          return new DropdownMenuItem(
                            child: new Text(item['description']),
                            value: category2.indexOf(item),
                          );
                        }).toList(),
                        onChanged: (newVal) {
                          setState(() {
                            cat2 = newVal;
                            debugPrint(cat2.toString());
                            getCategory3(cat2);
                          });
                        },
                        value: cat2,
                      ),
                      new DropdownButton(
                        isExpanded: true,
                        hint: Text("Select Sub-Category2"),
                        items: category3.map((item) {
                          return new DropdownMenuItem(
                            child: new Text(item['description']),
                            value: category3.indexOf(item),
                          );
                        }).toList(),
                        onChanged: (newVal) {
                          setState(() {
                            cat3 = newVal;
                            debugPrint(cat3.toString());
                            getCategory4(cat3);
                          });
                        },
                        value: cat3,
                      ),
                      new DropdownButton(
                        isExpanded: true,
                        hint: Text("Select Sub-Category3"),
                        items: category4.map((item) {
                          return new DropdownMenuItem(
                            child: new Text(item['description']),
                            value: category4.indexOf(item),
                          );
                        }).toList(),
                        onChanged: (newVal) {
                          setState(() {
                            cat4 = newVal;
                            debugPrint(cat4.toString());
                            // getCategory4(cat3);
                          });
                        },
                        value: cat4,
                      ),
                    ]),
              ],
            ),
          )),
      visible: _searchResult.length!=0?true:false,
    );
  }

  Widget upperPart()
  {
    return new Column(
      children: <Widget>[
        filter(),
        //noOfBooks(),
        new Container(
          color: Theme.of(context).cardColor,
          child: new Padding(
            padding: const EdgeInsets.all(8.0),
            child: new Card(
              child: new ListTile(
                leading: new IconButton(
                  icon: new Icon(Icons.search),
                  onPressed: () {
                    catState=false;
                    _searchResult.clear();
                    _catResult.clear();
                    getCategory1();
                    cat1=null;
                    cat2=null;
                    cat3=null;
                    cat4=null;
                    getAllBooks();
                  },
                ),
                title: new TextField(
                  controller: controller,
                  decoration: new InputDecoration(
                      hintText: 'Search', border: InputBorder.none),
                  //onChanged: onSearchTextChanged,
                ),
                trailing: new IconButton(
                  icon: new Icon(Icons.cancel),
                  onPressed: () {

                    setState(() {
                      controller.clear();
                      catState=false;
                      _searchResult.clear();
                      _catResult.clear();
                      cat1=null;
                      cat2=null;
                      cat3=null;
                      cat4=null;
                    });

                  },
                ),
              ),
            ),
          ),
        ),

        //searchButton(),
      ],
    );
  }

  @override
  Widget build(BuildContext context) {

    return Scaffold(
      body :body(),
    );
  }

  onSearchTextChanged(String text) async {

    setState(() {
      catState=true;
    });

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
          // search.price.contains(text) ||
          search.quantity.contains(text) ||
          search.date_of_publication.contains(text) ||
          search.isbn.contains(text) ||
          search.bookID.contains(text) ||
          search.subCategory2.contains(text) ||
          search.subCategory3.contains(text) ||
          search.author.contains(text)) {
        _catResult.add(search);
      }
    });

    setState(() {});
  }
}

List<BookDetails> _catResult = [];

List<BookDetails> _searchResult = [];

final String url = rootUrl + 'allbooks.php';

class BookDetails {
  final String title,
      author,
      category,
      subCategory,
      publisher,
      pages,
  // price,
      quantity,
      imgLink,
      date_of_publication,
      isbn,
      bookID,
      star,
      subCategory2,
      subCategory3;

  BookDetails(
      {this.title,
        this.author,
        this.category,
        this.subCategory,
        this.publisher,
        this.pages,
        // this.price,
        this.quantity,
        this.imgLink,
        this.date_of_publication,
        this.isbn,
        this.bookID,
        this.star,
        this.subCategory2,
        this.subCategory3});

  factory BookDetails.fromJson(Map<String, dynamic> json) {
    return new BookDetails(
      isbn: json['isbn'],
      title: json['title'],
      author: json['author'],
      category: json['Category1'],
      subCategory: json['Category2'],
      subCategory2: json['Category3'],
      subCategory3: json['Category4'],
      publisher: json['publisher'],
      pages: json['pages'],
      // price: json['price'],
      quantity: json['quantity'],
      imgLink: json['imgLink'],
      date_of_publication: json['date_of_publication'],
      bookID: json['bookID'],
      star: json['star'],
    );
  }
}
