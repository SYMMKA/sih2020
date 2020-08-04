import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:http/http.dart' as http;
import 'package:sihapp/payFinePage.dart';
import 'constants.dart';

class ModelPayFine extends StatefulWidget {

  final List dues;
  ModelPayFine(this.dues);

  @override
  State<StatefulWidget> createState() => ModelPayFineState();
}

class ModelPayFineState extends State<ModelPayFine>
    with SingleTickerProviderStateMixin {
  int state, tempindex;
  String stud_ID;
  Map selectedValue;
  List dues=new List();

  @override
  void initState() {
    super.initState();
    dues.clear();
    dues=widget.dues;
    debugPrint(dues.toString());
    _loadData();
  }



  showToast(String msg) {
    return Fluttertoast.showToast(
        msg: msg,
        toastLength: Toast.LENGTH_SHORT,
        gravity: ToastGravity.BOTTOM,
        timeInSecForIosWeb: 2,
        backgroundColor: Colors.grey[800],
        textColor: Colors.white,
        fontSize: 18.0);
  }

  _loadData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      stud_ID = (prefs.getString('stud_ID') ?? '');
    });
  }


  @override
  Widget build(BuildContext context) {
    return dues.length!=0?
    Center(
      child: Material(
        color: Colors.transparent,
        child: Container(
          height: MediaQuery.of(context).size.height / 2,
          width: MediaQuery.of(context).size.width - 50,
          decoration: ShapeDecoration(
              color: Colors.white,
              shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(15.0))),
          child: Center(
              child:ListView(
                padding: const EdgeInsets.only(
                    top: 30, bottom: 30, left: 20, right: 20),
                children: [
                  Container(
                      child:Text(
                        "Following are the dues you're yet to pay",
                        style: TextStyle(
                          fontSize: 16,
                          color: Colors.black,
                        ),
                      )
                  ),
                  Column(

                    children: List.generate(dues.length, (index) {
                      return Padding(
                        padding: EdgeInsets.all(5),
                        child: Container(
                          padding: EdgeInsets.all(5),

                          child: Row(
                              mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                              children: <Widget>[
                                Column(
                                  children: <Widget>[
                                    Text("Copy-ID=" +dues[index]["copyID"]),
                                    Text("Fine= "+dues[index]["fine"] ),
                                  ],
                                ),

                                RaisedButton(
                                  color: Colors.lightBlue.shade50,
                                  onPressed: (){

                                    Navigator.pushReplacement(
                                      context,
                                      MaterialPageRoute(
                                        builder: (context) => PayFine(fine: dues[index]["fine"],stud_ID:dues[index]["stud_ID"],copyID:dues[index]["copyID"] ,),
                                      ),
                                    );
                                  },
                                  child: Text("Pay"),
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

        ),
      ),
    ):
    Center(child: CircularProgressIndicator());
  }
}
