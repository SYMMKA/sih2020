import 'package:flutter/material.dart';
import 'package:sihapp/Login.dart';
import 'package:sihapp/Search.dart';
import 'package:sihapp/Shelves.dart';
import 'package:sihapp/ebooks.dart';

import 'Recommendations.dart';



class SearchTabs extends StatefulWidget {
  @override
  _SearchTabsState createState() => _SearchTabsState();
}

class _SearchTabsState extends State<SearchTabs> {
  @override
  Widget build(BuildContext context) {
    return DefaultTabController(
      length: 4,
      child: Scaffold(

          body:
          Column(
            children: <Widget>[
              TabBar(
                labelColor: Colors.blue[700],
                indicatorColor: Colors.blue[700],
                unselectedLabelColor: Colors.black,
                tabs: [
                  Tab(text: "All",),
                  Tab(text: "Shelves",),
                  Tab(text: "Syllabus",),
                  Tab(text: "E books",),
                ],
              ),
              Expanded(
                flex: 1,
                child: TabBarView(
                  children: [
                    Search(),
                    Shelves(),
                    Syllabus(),
                    Ebooks(),
                  ],
                ),
              )
            ],
          )

      ),
    );

  }
}