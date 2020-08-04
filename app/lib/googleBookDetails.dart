

import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_rating_bar/flutter_rating_bar.dart';
import 'package:sihapp/googleBooks.dart';
import 'package:url_launcher/url_launcher.dart';

import 'Search.dart';

Widget GoogleBookPreview(BuildContext context , GoogleBookClass book)
{

  _launchURL(String url) async {
    if (await canLaunch(url)) {
      await launch(url);
    } else {
      throw 'Could not launch $url';
    }
  }


  return AlertDialog(

      content: Container(

          child: Container(
            height: MediaQuery.of(context).size.height-200,
            width: MediaQuery.of(context).size.width-100,

            color: Colors.white,
            child: Container(

                child: ListView(

                  children: [
                    //displayIcon(),



                    SizedBox(
                        height: 15
                    ),

//                    Center(
//
//                      child:Text(
//                        "Average Rating:",
//                        style: TextStyle(color: Colors.black,
//                            fontWeight: FontWeight.bold,
//                            fontSize: 16),
//                      ),
//
//
//                    ),
//
//                    Center(
//                      child:
//
//                      RatingBarIndicator(
//                        rating: book.averageRating!=null || book.averageRating!=""?double.parse(book.averageRating):0,
//                        itemBuilder: (context, index) => Icon(
//                          Icons.star,
//                          color: Colors.amber,
//                        ),
//                        itemCount: 5,
//                        itemSize: 40.0,
//                        direction: Axis.horizontal,
//                      ),
//                    ),


                    Text(
                      "Title:",
                      style: TextStyle(color: Colors.black,
                          fontWeight: FontWeight.bold,
                          fontSize: 16),
                    ),

                    Text(
                      book.title,
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
                      book.author,
                      style: TextStyle(color: Colors.blue[900],
                          fontSize: 16),
                    ),

                    SizedBox(
                        height: 10
                    ),

                    Text(
                      "Average Ratings:",
                      style: TextStyle(color: Colors.black,
                          fontWeight: FontWeight.bold,
                          fontSize: 16),
                    ),
                    Text(
                      book.averageRating,
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
                      book.category,
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
                      book.publisher,
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
                      book.pages,
                      style: TextStyle(color: Colors.blue[900],
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
                      book.isbn,
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
//                        launch(book.previewLink);
//                        launch(
//                            'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf');

                      debugPrint(book.previewLink);

                      _launchURL(book.previewLink);

                      },
                      child: Text(
                        "Preview",
                        style: TextStyle(color: Colors.white),
                      ),
                    ),

                    book.pdf!=""?RaisedButton(
                      color: Colors.black,

                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(4),
                      ),
                      onPressed: () {
                        // If statement is validating the input fields.
//                        launch(book.previewLink);
//                        launch(
//                            'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf');

                        debugPrint(book.pdf);

                        _launchURL(book.pdf);

                      },
                      child: Text(
                        "Download pdf",
                        style: TextStyle(color: Colors.white),
                      ),
                    ):Container(),

                  ],
                )),
          )
      ));
}