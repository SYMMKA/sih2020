import 'dart:async';

import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';

import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';
import 'package:sihapp/ModelBookPreview.dart';
import 'ModelAvailableCopies.dart';
import 'constants.dart';
import 'googleBookDetails.dart';


class GoogleBooks extends StatefulWidget {
  @override
  _GoogleBooksState createState() => new _GoogleBooksState();
}


class GoogleBookClass {
  final String title,
      author,
      category,
      publisher,
      pages,
      date_of_publication,
      previewLink,
      isbn,
      averageRating,pdf;
  GoogleBookClass(
      this.title,
      this.author,
      this.category,
      this.publisher,
      this.pages,
      this.date_of_publication,
      this.previewLink,
      this.isbn,
      this.averageRating,
      this.pdf,
     );
}



class _GoogleBooksState extends State<GoogleBooks> {
  TextEditingController controller = new TextEditingController();
  double _height, _width;

  int noOfBooks=0;
  bool catState=false;
  Map searchResult = Map();
  Map getmap = Map();
  List items = List();
  String title="",author="",isbn="",publisher="",category="",pages="",preview="",averageRating="",date_of_publication="",pdfLink="",stud_ID;


  void sendRequest() async
  {
    debugPrint(title+" "+author+" "+isbn+" "+stud_ID);

    try {
      var response = await http.post(
          Uri.encodeFull(
              rootUrl+"requestBook.php"), body: {
        "title": title,
        "author": author,
        "isbn": isbn,
        "stud_ID": stud_ID,
      });

      debugPrint(response.body);
      
      if(response.body.contains("true"))
        showToast("request sent");
      else
        showToast("failed");

    }
    catch(e)
    {
      debugPrint(e.toString());
    }


  }



  _loadData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      stud_ID = (prefs.getString('stud_ID') ?? '');
      debugPrint(stud_ID);
    });
  }




  void getSearchResult(String search) async {


    try {
      var response = await http.get(
          Uri.encodeFull(
              "https://www.googleapis.com/books/v1/volumes?q=$search&key=AIzaSyAMdQdnL1mLwZSFbbOZhprDUX5bhlqH_Jk"),
          headers: {"Accept": "application/json"});

      var resBody = json.decode(response.body);

      items= resBody["items"];
      debugPrint(items.toString());

      setState(() {
        noOfBooks=items.length;
      });

    }
    catch(e)
    {
      debugPrint(e.toString());
      showToast("make sure u have good internet");
    }

  }


  Widget pageHeader()
  {
    return
      Container(
          width: MediaQuery.of(context).size.width,
          child:Container(
              color: Colors.white,
              //color: Colors.amberAccent.shade50,
              child: Container(
                  padding: EdgeInsets.all(15),

                  child: Column(
                    children: <Widget>[

                      Text(
                        'Request for new books',
                        textAlign: TextAlign.center,

                        style: TextStyle(
                            fontSize: 18,
                            fontWeight: FontWeight.bold),
                      ),

                      SizedBox(
                        height: 10,
                      ),

                    ],
                  )
              )
          )
      );

  }

  Future<bool> checkUrlExistance(String url) async
  {
    bool flag;

    final response =
        await http.get('https://jsonplaceholder.typicode.com/posts/1');

    debugPrint(response.statusCode.toString());

    if (response.statusCode == 200) {
      flag=true;
    }
    else
      flag=false;

      return flag;
  }



  Widget displayBooks(int x,Map currentBookMap)
  {
    return Container(
        height: 160.0,
        child: Card(

            elevation: 4,
            margin: EdgeInsets.all(10),
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

                          child: currentBookMap.containsKey("imageLinks")? Image.network(
                            items[x]["volumeInfo"]["imageLinks"]["thumbnail"],
                            fit: BoxFit.cover,
                            loadingBuilder:(BuildContext context, Widget child,ImageChunkEvent loadingProgress) {
                              if (loadingProgress == null) return child;
                              return Center(
                                child: CircularProgressIndicator(
                                  value: loadingProgress.expectedTotalBytes != null ?
                                  loadingProgress.cumulativeBytesLoaded / loadingProgress.expectedTotalBytes
                                      : null,
                                ),
                              );
                            },
                          ): Container(),

//

                        ),

                        Container(
                            width: MediaQuery.of(context).size.width/1.6,
                            padding: EdgeInsets.all(5),
                            child:Column(
                              crossAxisAlignment: CrossAxisAlignment.start,

                              children: <Widget>[


                                currentBookMap.containsKey("title")?Text(
                                  "Title:"+items[x]["volumeInfo"]["title"],
                                  overflow: TextOverflow.clip,
                                  maxLines: 2,
                                  softWrap: false,
                                  style: TextStyle(fontSize: 12),

                                ):Text("Title:"),

                                currentBookMap.containsKey("authors")?Text(
                                  "Author:"+items[x]["volumeInfo"]["authors"][0],
                                  overflow: TextOverflow.clip,
                                  maxLines: 1,
                                  softWrap: false,
                                  style: TextStyle(fontSize: 12),
                                ):Text("Author:"),

                                currentBookMap.containsKey("publisher")? Text(
                                  "Publisher:"+ items[x]["volumeInfo"]["publisher"],
                                  overflow: TextOverflow.clip,
                                  maxLines: 1,
                                  softWrap: false,
                                  style: TextStyle(fontSize: 12),
                                ):Text("Publisher:"),

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
                                            int isbn13Found=0;

                                            if(currentBookMap.containsKey("industryIdentifiers"))
                                            {
                                              List temp = items[x]["volumeInfo"]["industryIdentifiers"];


                                              for(int i =0 ;i<temp.length;i++)
                                              {
                                                if(items[x]["volumeInfo"]["industryIdentifiers"][i]["type"].toString().contains("ISBN_13"))
                                                {
                                                  setState(() {
                                                    isbn=items[x]["volumeInfo"]["industryIdentifiers"][i]["identifier"];
                                                    isbn13Found=1;
                                                  });

                                                }

                                              }
                                              if(isbn13Found==0)
                                              {
                                                setState(() {
                                                  isbn=items[x]["volumeInfo"]["industryIdentifiers"][0]["identifier"];
                                                });

                                              }

                                            }
                                            if(currentBookMap.containsKey("title"))
                                            {
                                              setState(() {
                                                title=items[x]["volumeInfo"]["title"].toString();
                                              });

                                            }
                                            if(currentBookMap.containsKey("authors"))
                                            {
                                              setState(() {
                                                author=items[x]["volumeInfo"]["authors"][0].toString();
                                              });

                                            }

                                            if(currentBookMap.containsKey("publisher"))
                                            {
                                              setState(() {
                                                publisher=items[x]["volumeInfo"]["publisher"].toString();
                                              });

                                            }

                                            if(currentBookMap.containsKey("categories"))
                                            {
                                              setState(() {
                                                category=items[x]["volumeInfo"]["categories"][0].toString();
                                              });

                                            }

                                            if(currentBookMap.containsKey("previewLink"))
                                            {
                                              setState(() {
                                                preview=items[x]["volumeInfo"]["previewLink"].toString();
                                              });

                                            }

                                            if(currentBookMap.containsKey("averageRating"))
                                            {
                                              setState(() {
                                                averageRating=items[x]["volumeInfo"]["averageRating"].toString();
                                              });

                                            }

                                            if(currentBookMap.containsKey("publishedDate"))
                                            {
                                              setState(() {
                                                date_of_publication=items[x]["volumeInfo"]["publishedDate"].toString();
                                              });

                                            }

                                            if(currentBookMap.containsKey("pageCount"))
                                            {
                                              setState(() {
                                                pages=items[x]["volumeInfo"]["pageCount"].toString();
                                              });

                                            }

                                            if(currentBookMap.containsKey("pageCount"))
                                            {
                                              setState(() {
                                                pages=items[x]["volumeInfo"]["pageCount"].toString();
                                              });

                                            }



                                            if(currentBookMap.containsKey("accessInfo"))
                                            {

                                              Map tempMap= currentBookMap["accessInfo"];

                                              if(tempMap.containsKey("pdf"))
                                                {

                                                  if(items[x]["volumeInfo"]["accessInfo"]["pdf"]["isAvailable"]=="true")
                                                    {
                                                      setState(() {
                                                        pdfLink=items[x]["volumeInfo"]["accessInfo"]["pdf"]["isAvailable"]["acsTokenLink"].toString();
                                                      });
                                                    }
                                                }

                                              debugPrint(items[x]["volumeInfo"]["accessInfo"]["pdf"]["isAvailable"]["acsTokenLink"].toString());
                                            }



                                            debugPrint(title);
                                            debugPrint(isbn);
                                            debugPrint(pages);
                                            debugPrint(averageRating);
                                            debugPrint(category);
                                            debugPrint(publisher);
                                            debugPrint(preview);
                                            debugPrint(author);
                                            debugPrint(date_of_publication);
                                            debugPrint(pdfLink);

                                            final googleBook= GoogleBookClass(title,author,category,publisher,pages,date_of_publication,preview,isbn,averageRating,pdfLink);

                                            showDialog(
                                                context: context,
                                                builder: (BuildContext context) {
                                                  return GoogleBookPreview(context, googleBook);
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
                                            int isbn13Found=0;

                                            if(currentBookMap.containsKey("industryIdentifiers"))
                                            {
                                              List temp = items[x]["volumeInfo"]["industryIdentifiers"];


                                              for(int i =0 ;i<temp.length;i++)
                                                {
                                                  if(items[x]["volumeInfo"]["industryIdentifiers"][i]["type"].toString().contains("ISBN_13"))
                                                    {
                                                      setState(() {
                                                        isbn=items[x]["volumeInfo"]["industryIdentifiers"][i]["identifier"];
                                                        isbn13Found=1;
                                                      });

                                                    }

                                                }
                                              if(isbn13Found==0)
                                                {
                                                  setState(() {
                                                    isbn=items[x]["volumeInfo"]["industryIdentifiers"][0]["identifier"];
                                                  });

                                                }

                                            }
                                            if(currentBookMap.containsKey("title"))
                                            {
                                              setState(() {
                                                title=items[x]["volumeInfo"]["title"];
                                              });

                                            }
                                            if(currentBookMap.containsKey("authors"))
                                            {
                                              setState(() {
                                                author=items[x]["volumeInfo"]["authors"][0];
                                              });

                                            }

                                           sendRequest();

                                          },
                                          color:  Color(0xff4AD7D1),
                                          child: Text("Request"),

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









  Widget body() {
    return ListView(

      children: <Widget>[
        pageHeader(),
        Container(
          //height: 400,
          //color: Colors.green,
          child: upperPart(),
        ),
        Container(
          height: MediaQuery.of(context).size.height/1.4,
          color: Colors.white70,
          //color: Colors.deepOrangeAccent,
          child: ListView.builder(
            // gridDelegate:SliverGridDelegateWithFixedCrossAxisCount(crossAxisCount: 1),
              itemCount: noOfBooks,
              itemBuilder: (BuildContext context, int x) {
                getmap = items[x]["volumeInfo"];
                return displayBooks(x,getmap);
              }),
        ),

      ],
    );
  }










  @override
  void initState() {
    super.initState();
    _loadData();

  }


  onSubmit()
  {
    items.clear();

    if(controller.text.isNotEmpty)
    {
      debugPrint(controller.text);
      getSearchResult(controller.text);
    }
    else
    {
      showToast("invalid input");
    }


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
        items.clear();

        if(controller.text.isNotEmpty)
          {
            debugPrint(controller.text);
            getSearchResult(controller.text);
          }
        else
          {
            showToast("invalid input");
          }


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


  Widget upperPart()
  {
    return new Column(
      children: <Widget>[

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
                    onSubmit();
                  },
                ),
                title: new TextField(
                 // onSubmitted: onSubmit(),
                  controller: controller,
                  decoration: new InputDecoration(
                      hintText: 'Search books on google', border: InputBorder.none),
                  //onChanged: onSearchTextChanged,
                ),
                trailing: new IconButton(
                  icon: new Icon(Icons.cancel),
                  onPressed: () {

                    setState(() {
                      controller.clear();

                    });

                  },
                ),
              ),
            ),
          ),
        ),

       // searchButton(),
      ],
    );
  }

  @override
  Widget build(BuildContext context) {

    return Scaffold(
      body :body(),
    );
  }


}



