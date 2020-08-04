

import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_rating_bar/flutter_rating_bar.dart';

import 'Search.dart';

Widget bookPreview(BuildContext context , Book book)
{
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


              Center(
                  child:Container(
                    child:Image(
                      image: NetworkImage(book.imgLink),
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
                  rating: book.star!=null?double.parse(book.star):5,
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
                "Quantity:",
                style: TextStyle(color: Colors.black,
                    fontWeight: FontWeight.bold,
                    fontSize: 16),
              ),
              Text(
                book.quantity,
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
                "Sub-Category:",
                style: TextStyle(color: Colors.black,
                    fontWeight: FontWeight.bold,
                    fontSize: 16),
              ),
              Text(
                book.subCategory,
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
                book.isbn,
                style: TextStyle(color: Colors.blue[900],
                    fontSize: 16),
              ),

              SizedBox(
                  height: 20
              ),

            ],
          )),
    )
  ));
}