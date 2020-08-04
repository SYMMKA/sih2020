import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:json_table/json_table.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:sihapp/leaderBoard.dart';
import 'package:slimy_card/slimy_card.dart';

class DashboardPage extends StatefulWidget {
  @override
  _DashboardPageState createState() => _DashboardPageState();
}

class _DashboardPageState extends State<DashboardPage>
    with TickerProviderStateMixin {
  Animation<double> animation1, animation2, animation3, animation4, animation5;
  AnimationController _controller1,
      _controller2,
      _controller3,
      _controller4,
      _controller5;
  String i, phybooks, audiobooks, ebooks, journals;
  String stud_ID, password, name, email, mobile, points, type, block;

  @override
  void dispose() {
    _controller1.dispose();
    _controller2.dispose();
    _controller3.dispose();
    _controller4.dispose();
    _controller5.dispose();
    super.dispose();
  }

  _loadData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      stud_ID = (prefs.getString('stud_ID') ?? '');
      name = (prefs.getString('name') ?? '');
      email = (prefs.getString('email') ?? '');
      points = (prefs.getString('points') ?? '');
      type = (prefs.getString('type') ?? '');
      block = (prefs.getString('block') ?? '');
    });
  }

  @override
  void initState() {
    super.initState();
    _loadData();

    debugPrint(type);
    _controller1 =
        AnimationController(duration: const Duration(seconds: 2), vsync: this);
    animation1 = Tween<double>(begin: 0, end: 1043).animate(_controller1)
      ..addListener(() {
        setState(() {
          // The state that has changed here is the animation objects value
          phybooks = animation1.value.toStringAsFixed(0);
        });
      });
    _controller1.forward();

    _controller2 =
        AnimationController(duration: const Duration(seconds: 2), vsync: this);
    animation2 = Tween<double>(begin: 0, end: 382).animate(_controller2)
      ..addListener(() {
        setState(() {
          // The state that has changed here is the animation objects value
          audiobooks = animation2.value.toStringAsFixed(0);
        });
      });
    _controller2.forward();

    _controller3 =
        AnimationController(duration: const Duration(seconds: 2), vsync: this);
    animation3 = Tween<double>(begin: 0, end: 567).animate(_controller3)
      ..addListener(() {
        setState(() {
          // The state that has changed here is the animation objects value
          ebooks = animation3.value.toStringAsFixed(0);
        });
      });
    _controller3.forward();

    _controller4 =
        AnimationController(duration: const Duration(seconds: 2), vsync: this);
    animation4 = Tween<double>(begin: 0, end: 149).animate(_controller4)
      ..addListener(() {
        setState(() {
          // The state that has changed here is the animation objects value
          journals = animation4.value.toStringAsFixed(0);
        });
      });
    _controller4.forward();

    _controller5 =
        AnimationController(duration: const Duration(seconds: 2), vsync: this);
    animation5 = Tween<double>(begin: 0, end: 113).animate(_controller5)
      ..addListener(() {
        setState(() {
          // The state that has changed here is the animation objects value
          i = animation5.value.toStringAsFixed(0);
        });
      });
    _controller5.forward();
  }

  Widget typesOfMaterial(String text, String count) {
    return Container(
      height: MediaQuery.of(context).size.height/8.5,
      padding: EdgeInsets.all(15),
      child: Row(children: <Widget>[
        Expanded(
          flex: 1,
          child: Text(
            "$text",
            style: TextStyle(
                fontSize: 18, fontWeight: FontWeight.w500, color: Color(0xff001730)),
          ),
        ),
        Expanded(
            flex: 1,
            child: Center(
              child: Text(
                "$count",
                textDirection: TextDirection.rtl,
                style: TextStyle(
                  fontSize: 25,
                  fontWeight: FontWeight.bold,
                  color: Color(0xff001730),
                ),
              ),
            ))
      ]),
    );
  }

  Widget title() {
    return Container(
        height: MediaQuery.of(context).size.height / 3.5,
        margin: EdgeInsets.only(bottom: 15),
        decoration: BoxDecoration(
          gradient: LinearGradient(
              colors: <Color>[Colors.blueAccent, Colors.tealAccent]),
          borderRadius: BorderRadius.only(
              bottomLeft: Radius.circular(30),
              bottomRight: Radius.circular(30)),
        ),
        child: Column(
          children: [
            Expanded(
              flex: 1,
              child: Center(
                  child: Text("Welcome",
                      style: TextStyle(
                          fontStyle: FontStyle.italic,
                          fontWeight: FontWeight.bold,
                          fontSize: 25))),
            ),
            Expanded(
              flex: 1,
              child: Center(
                child: Column(children: [
                  Text("$email",
                      style: TextStyle(fontStyle: FontStyle.italic)),
                  Text("\nGo anywhere. Learn anything. Read every day.",
                      style: TextStyle(fontStyle: FontStyle.italic)),
                ]),
              ),
            )
          ],
        ));
  }

//  Widget viewLeaderBoard() {
//    return Card(
//        elevation: 0,
//        margin: EdgeInsets.all(8),
//        semanticContainer: true,
//        color: Color(0xff001730),
//        child: Container(
//            padding: EdgeInsets.all(15),
//            child: Row(
//              children: <Widget>[
//                new Expanded(
//                  child: Text(
//                    'Leaderboard ',
//                    textAlign: TextAlign.center,
//                    style: TextStyle(
//                        color: Colors.white,
//                        fontSize: 18,
//                        fontWeight: FontWeight.w500),
//                  ),
//                ),
//                Expanded(
//                  child: new Container(
//                    margin: const EdgeInsets.symmetric(horizontal: 8.0),
//                    child: new IconButton(
//                      color: Colors.white,
//                      icon: new Icon(Icons.send),
//                      onPressed: () {
//                        debugPrint("lead pressed");
//                        Navigator.push(
//                          context,
//                          MaterialPageRoute(
//                            builder: (context) => LeaderBoard(),
//                          ),
//                        );
//                      },
//                    ),
//                  ),
//                )
//              ],
//            )));
//  }

  Widget welcomeCard(String name, String points) {
    return Container(
//      elevation: 0,
//      //margin: EdgeInsets.all(8),
//      semanticContainer: true,

      height: MediaQuery.of(context).size.height/3.5,

      decoration: BoxDecoration(
        gradient: LinearGradient(
            colors: <Color>[Color(0xff4AD7D1), Colors.tealAccent]),
        borderRadius: BorderRadius.only(
            bottomLeft: Radius.circular(30),
            bottomRight: Radius.circular(30)),
      ),

      //color: Color(0xff4AD7D1),
      child: Container(
          padding: EdgeInsets.all(25),
          child: Column(
            children: <Widget>[

              Text(
                'Welcome',
                textAlign: TextAlign.center,
                overflow: TextOverflow.ellipsis,
                maxLines: 2,
                style: TextStyle(
                  color: Colors.black,
                  fontSize: 18,
                  fontStyle: FontStyle.italic,
                ),
              ),

              SizedBox(
                height: 10,
              ),

              Text(
                '$name',
                textAlign: TextAlign.center,
                overflow: TextOverflow.ellipsis,
                maxLines: 2,
                style: TextStyle(
                  color: Colors.black,
                  fontSize: 25,
                  fontStyle: FontStyle.italic,
                ),
              ),


//              RichText(
//                text: TextSpan(
//                  text: 'Hi ',
//                  style: TextStyle(
//                      color: Colors.black,
//                      fontSize: 28,
//                      fontWeight: FontWeight.bold),
//                  children: <TextSpan>[
//                    TextSpan(
//                        text: '$name',
//                        style: TextStyle(fontWeight: FontWeight.bold)),
//                  ],
//                ),
//              ),
              SizedBox(
                height: 20,
              ),
              Text(
                'Go everywhere. Learn anything. Read every day.',
                textAlign: TextAlign.center,
                overflow: TextOverflow.ellipsis,
                maxLines: 2,
                style: TextStyle(
                    color: Colors.black,
                    fontSize: 16,
                    fontStyle: FontStyle.italic,
                    ),
              ),
              SizedBox(
                height: 30,
              ),
//              type == "student"
//                  ? RichText(
//                      text: TextSpan(
//                        text: 'Your Points  ',
//                        style: TextStyle(
//                          color: Colors.black,
//                          fontSize: 25,
//                        ),
//                        children: <TextSpan>[
//                          TextSpan(
//                            text: '  $i',
//                            style: TextStyle(
//                              fontWeight: FontWeight.bold,
//                              color: Color(0xff001730),
//                              fontSize: 25,
//                            ),
//                          ),
//                        ],
//                      ),
//                    )
//                  : Container(),
            ],
          )),
    );
  }

  @override
  Widget build(BuildContext context) {
    return ListView(
      children: <Widget>[
        welcomeCard(name, "$i"),
    Container(
//      elevation: 0,
//      //margin: EdgeInsets.all(8),
//      semanticContainer: true,
          color: Colors.white,
          child: Container(

              padding: EdgeInsets.all(15),
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: <Widget>[
                  typesOfMaterial("Physical Books", "$phybooks"),
                  typesOfMaterial("Audio Books", "$audiobooks"),
                  typesOfMaterial("E-Books ", "$ebooks"),
                  typesOfMaterial("Journals & Papers", "$journals"),
                ],
              )),
        ),
        //type == "student" ? viewLeaderBoard() : Container(),
      ],
    );
  }
}
