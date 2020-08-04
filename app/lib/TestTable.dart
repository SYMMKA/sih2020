import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'dart:async';
import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:json_table/json_table.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:sihapp/ModelPayFine.dart';

import 'ModelAvailableCopies.dart';
import 'ViewActivity.dart';
import 'cancelReservation.dart';
import 'constants.dart';


class TestTable extends StatefulWidget {

  @override
  _TestTableState createState() => _TestTableState();
}

class _TestTableState extends State<TestTable> {

  String stud_ID;

  String _textFromFile = "";
  bool toggle = true;
  List activities=new List();
  List dues=new List();

  var columns = [
    JsonTableColumn("title", label: "Title"),
    JsonTableColumn("copyID", label: "Copy Id",),
    JsonTableColumn("time", label: "Issue Time"),
    JsonTableColumn("returnTime", label: "Return Time"),
    JsonTableColumn("fine", label: "Fine"),
    JsonTableColumn("due", label: "Due"),

  ];




  _loadData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      stud_ID = (prefs.getString('stud_ID') ?? '');
      debugPrint(stud_ID);
    });
  }

  @override
  void initState() {
    super.initState();
    _loadData();
    print("hello");
  }


//
//  @override
//  void didUpdateWidget(TestTable testTable)
//  {
//    debugPrint("from didUpdateWidget");
//    super.didUpdateWidget(testTable);
//  }
//
//  @override
//  void deactivate() {
//    print('A deactivated');
//    super.deactivate();
//  }
//
//
//  @override
//  void dispose() {
//    print('A disposed');
//    super.dispose();
//  }

  Future<List> getPosts() async {
    http.Response response = await http.get(rootUrl+'libraryCard.php?stud_ID='+stud_ID);
    activities =  jsonDecode(response.body);
    debugPrint(response.body);
    return activities;
  }

  getDues()
  {
    dues.clear();
    for(int i=0;i<activities.length;i++) {
      Map activityMap = Map<String, dynamic>.from(activities[i]);

      if(activityMap["due"]=="1")
        {
            dues.add(activityMap);
        }
    }
    if(dues.length!=0)
      {
        debugPrint(dues.toString());
        setState(() {
          showDialog(
            context: context,
            builder: (_) => ModelPayFine(dues),
          );
        });
      }
    else{
      debugPrint("all paid");
      showToast("All paid");
     }
  }



  Widget pageHeader()
  {
    return
      Container(
        width: MediaQuery.of(context).size.width,
        child:Card(
        elevation: 0,
        margin: EdgeInsets.only(bottom: 15),
        semanticContainer: true,
        color: Colors.amberAccent.shade50,
        child: Container(
            padding: EdgeInsets.all(15),

            child: Column(
              children: <Widget>[

                  Text(
                    'Your Activities',
                    textAlign: TextAlign.center,

                    style: TextStyle(
                        fontSize: 18,
                        fontWeight: FontWeight.bold),
                  ),

                SizedBox(
                  height: 10,
                ),

               Row(
                  mainAxisAlignment: MainAxisAlignment.center,

                  children: <Widget>[
                    RaisedButton(
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(8),
                      ),
                      onPressed: () {
                        // If statement is validating the input fields.
                        getDues();

                      },
                      color: Color(0xff4AD7D1),
                      child: Text("Pay Fine",
                        style: TextStyle(
                          fontSize: 15,
                        ),
                      ),

                    ),



                  ],
                ),


              ],
            )
        )
       )
      );

  }

  @override
  Widget build(BuildContext context) {
    return Container(
      child: FutureBuilder(
        future: getPosts(),
        builder: (BuildContext context, AsyncSnapshot<List<dynamic>> snapshot){
          if(snapshot.hasData){
            var json = activities;
            return Scaffold(

              body: SingleChildScrollView(
                padding: EdgeInsets.all(16.0),
                child: Container(
                  child: toggle
                      ? Column(
                    children: [
                      pageHeader(),
                      JsonTable(
                        json,
                        columns:columns,
                        //howColumnToggle: true,
                        allowRowHighlight: true,
                        rowHighlightColor: Color(0xff4AD7D1).withOpacity(0.5),
                        paginationRowCount: 50,
                          onRowSelect: (index, map) {
                          print(index);
                          if(activities[index]["title"].toString()!="") {
                            Map activityMap = Map<String, dynamic>.from(
                                activities[index]);

                            debugPrint(activityMap.toString());
                            Navigator.push(
                              context,
                              MaterialPageRoute(
                                  builder: (context) =>
                                      ViewActivity(activityMap: activityMap)
                              ),
                            );
                          }
                        },

                        tableHeaderBuilder: (String header) {
                          return Container(
                            height: 60,
                            //width:MediaQuery.of(context).size.width/2,
                            padding: EdgeInsets.symmetric(horizontal: 8.0, vertical: 4.0),
                            decoration: BoxDecoration(border: Border.all(width: 0.5),color: Colors.grey[100]),
                            child: Text(
                              header,
                              textAlign: TextAlign.center,
                              style: Theme.of(context).textTheme.display1.copyWith(fontWeight: FontWeight.w700, fontSize: 14.0,color: Colors.black87),
                            ),
                          );
                        },
                        tableCellBuilder: (value) {
                          return Container(
                            height: 60,

                            padding: EdgeInsets.symmetric(horizontal: 4.0, vertical: 2.0),
                            decoration: BoxDecoration(border: Border.all(width: 0.5, color: Colors.grey.withOpacity(0.5))),
                            child: Text(
                              value,
                              textAlign: TextAlign.center,
                              maxLines: 2,
                              style: Theme.of(context).textTheme.display1.copyWith(fontSize: 14.0, color: Colors.grey[900]),
                            ),
                          );
                        },


                      ),
                      SizedBox(
                        height: 40.0,
                      ),

                    ],
                  )
                      : Center(
                    child: Text(getPrettyJSONString(_textFromFile)),
                  ),
                ),
              ),

            );

          }else{
            return Center(child: CircularProgressIndicator());
          }
        },
      ),
    );
  }


  String getPrettyJSONString(jsonObject) {
    JsonEncoder encoder = new JsonEncoder.withIndent('  ');
    String jsonString = encoder.convert(json.decode(jsonObject));
    return jsonString;
  }
}
