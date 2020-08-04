import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:sihapp/Dashboard.dart';
import 'package:sihapp/SpeechToText.dart';
import 'package:sihapp/TestTable.dart';
import 'package:sihapp/chatScreen.dart';
import 'package:sihapp/constants.dart';
import 'package:sihapp/googleBooks.dart';
import 'package:sihapp/qrScanner.dart';
import 'package:sihapp/test.dart';
import 'package:sihapp/Settings.dart';
import 'package:sihapp/timeTable.dart';
import 'package:http/http.dart' as http;
import 'package:sihapp/wishlist.dart';
import 'LibraryCard.dart';
import 'SearchTabs.dart';
import 'cancelReservation.dart';
import 'main.dart';

class HomeTest extends StatelessWidget {
  // This widget is the root of your application.

  final int pos;
  HomeTest({Key key, this.pos}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      theme: ThemeData(
        brightness: Brightness.light,
        primaryColor: Color(0xff001730),
        accentColor: Color(0xff4AD7D1),

        // Define the default font family.
        fontFamily: 'Georgia',
      ),
      home: HomePageTest(
        pos: pos,
      ),
    );
  }
}

class HomePageTest extends StatefulWidget {
  final int pos;
  HomePageTest({Key key, this.pos}) : super(key: key);

  @override
  HomePageTestState createState() => HomePageTestState();
}




class HomePageTestState extends State<HomePageTest> {
  int selectedIndex = 0;
  String stud_ID,name,email;

  void logoutUser()async{
    SharedPreferences prefs = await SharedPreferences.getInstance();
    prefs.clear();
    showToast("Logout successful");
    print("User Sign Out");
    Navigator.push(
      context,
      MaterialPageRoute(builder: (context) => MyApp()),
    );

  }


//
//
//  Widget _offsetPopup() => PopupMenuButton<int>(
//        itemBuilder: (context) => [
//          PopupMenuItem(
//              value: 1,
//              child: GestureDetector(
//                onTap: () {
//                  debugPrint("1");
//                    Navigator.push(
//                    context,
//                    MaterialPageRoute(
//                      builder: (context) => ForgotPassPage(),
//                    ),
//                  );
//                },
//                child: Text(
//                  "Settings",
//                  style: TextStyle(
//                      color: Colors.white, fontWeight: FontWeight.w700),
//                ),
//              )),
//          PopupMenuItem(
//              value: 2,
//              child: GestureDetector(
//                onTap: () {
//                  debugPrint("1");
//                  logoutUser();
//                },
//                child: Text(
//                  "Logout",
//                  style: TextStyle(
//                      color: Colors.white, fontWeight: FontWeight.w700),
//                ),
//              )),
//        ],
//        icon: Icon(Icons.person),
//        offset: Offset(0, 100),
//        color: Color(0xff001730),
//      );



  List widgetOptions = [
    DashboardPage(),
    SearchTabs(),
    new TestTable(),
    ChatScreen(),
    new GoogleBooks(),
    new TestTable(),
  ];

  _loadData() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    setState(() {
      stud_ID = (prefs.getString('stud_ID') ?? '');
      name = (prefs.getString('name') ?? '');
      email = (prefs.getString('email') ?? '');
      debugPrint(stud_ID);
      debugPrint(name);
    });
  }

  @override
  void initState() {
    super.initState();
    debugPrint("the pos = " + widget.pos.toString());
    _loadData();
    if (widget.pos == null) {
      setState(() {
        selectedIndex = 0;
      });
    } else {
      setState(() {
        selectedIndex = widget.pos;
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('AlphaByte',style: TextStyle(color: Color(0xff001730)),),
        backgroundColor: Colors.white,
        iconTheme: IconThemeData(
            color: Color(0xff001730), //change your color here
        ),

        actions: <Widget>[
//          IconButton(
//            icon: Icon(
//              Icons.scanner,
//              color: Colors.white,
//            ),
//            onPressed: () {
//              // do something
//              Navigator.push(
//                context,
//                MaterialPageRoute(
//                  builder: (context) => QRViewExample(),
//                ),
//              );
//            },
//          ),
          IconButton(
            icon: Icon(
              Icons.settings_voice,

            ),
            onPressed: () {
              // do something

              showDialog(
                context: context,
                builder: (_) => VoiceNavigation(),
              );
//              Navigator.push(
//                context,
//                MaterialPageRoute(
//                  builder: (context) => VoiceNavigation(),
//                ),
//              );
            },
          ),
         // _offsetPopup(),
        ],
      ),

      drawer: ClipRRect(
        borderRadius: BorderRadius.circular(20),
        child: MediaQuery.removePadding(
          context: context,
          removeTop: true,
          child: new Drawer(
            child: ListView(
              children: <Widget>[
                UserAccountsDrawerHeader(
                  accountName: Text('$name'),
                  accountEmail: Text('$stud_ID'),
                  currentAccountPicture: InkWell(
                    onTap: () {
                      print("image clicked");
                    },
                    child: CircleAvatar(
                      backgroundColor:
                      Theme.of(context).platform == TargetPlatform.iOS
                          ? Colors.blue
                          : Colors.white,
                      child: Text(
                        "S",
                        style: TextStyle(fontSize: 40.0),
                      ),
                    ),
                  ),
                ),



                ListTile(
                    title: Row(children: <Widget>[
                      Icon(Icons.scanner),
                      Text(" Scan Qr Code")
                    ]),
                    onTap: () {
                      Navigator.push(
                        context,
                        MaterialPageRoute(
                          builder: (context) => QRViewExample(),
                        ),
                      );
                    }),

                ListTile(
                    title: Row(children: <Widget>[
                      Icon(Icons.flag),
                      Text(" Reserved Books")
                    ]),
                    onTap: () {
                      Navigator.push(
                        context,
                        MaterialPageRoute(
                            builder: (context) =>
                                CancelReservation(stud_ID: stud_ID,)
                        ),
                      );
                    }),
                ListTile(
                    title: Row(children: <Widget>[
                      Icon(Icons.favorite_border),
                      Text(" Wishlist")
                    ]),
                    onTap: () {
                      Navigator.push(
                        context,
                        MaterialPageRoute(
                          builder: (context) => Wishlist(stud_ID: stud_ID,),
                        ),
                      );
                    }),


                ListTile(
                    title: Row(children: <Widget>[
                      Icon(Icons.calendar_today),
                      Text(" Library Timings")
                    ]),
                    onTap: () {
                      Navigator.push(
                        context,
                        MaterialPageRoute(
                            builder: (context) =>
                                TimeTable(),
                        ),
                      );
                    }),



                SizedBox(
                  height: MediaQuery.of(context).size.height/5,
                ),





                ListTile(
                    title: Row(children: <Widget>[
                      Icon(Icons.settings),
                      Text(" Settings")
                    ]),
                    onTap: () {
                      Navigator.push(
                        context,
                        MaterialPageRoute(
                            builder: (context) =>
                                ForgotPassPage()
                        ),
                      );
                    }),
                ListTile(
                    title: Row(children: <Widget>[
                      Icon(Icons.exit_to_app),
                      Text(" Logout")
                    ]),
                    onTap: () {
                      debugPrint("1");
                      logoutUser();
                    }),
              ],
            ),
          ),
        ),
      ),
      body: Center(
        child: widgetOptions.elementAt(selectedIndex),
      ),
      bottomNavigationBar: BottomNavigationBar(
        items: <BottomNavigationBarItem>[
          BottomNavigationBarItem(icon: Icon(Icons.home), title: Text('Home')),
          BottomNavigationBarItem(
              icon: Icon(Icons.search), title: Text('Search')),
          BottomNavigationBarItem(
              icon: Icon(Icons.account_circle), title: Text('Activities')),
          BottomNavigationBarItem(icon: Icon(Icons.chat), title: Text('Chat')),
//          BottomNavigationBarItem(
//              icon: Icon(Icons.calendar_today), title: Text('Timings')),

          BottomNavigationBarItem(
              icon: Icon(Icons.add_shopping_cart), title: Text('Suggest WishList')),
        ],
        currentIndex: selectedIndex,
        onTap: onItemTapped,


        unselectedItemColor: Color(0xff001730),
        selectedItemColor: Color(0xff4AD7D1),
      ),
    );
  }

  void onItemTapped(int index) {
    setState(() {
      selectedIndex = index;
    });
  }
}
