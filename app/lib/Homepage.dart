import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:sihapp/Dashboard.dart';
import 'package:sihapp/LibraryCard.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:sihapp/Login.dart';
import 'package:sihapp/Search.dart';
import 'package:sihapp/Shelves.dart';
import 'package:sihapp/test.dart';




import 'ChatScreen.dart';
import 'AddMessage.dart';





class HomePage extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    return new HomePageState();
  }
}

class HomePageState extends State<HomePage> {
  int _selectedDrawerIndex = 0;
  String appbartitle = "Dashboard";

  String stud_ID;


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

  }

  void logoutUser()async{
    SharedPreferences prefs = await SharedPreferences.getInstance();
    prefs.clear();


    Fluttertoast.showToast(
        msg: "LOGOUT SUCCESSFUL",
        toastLength: Toast.LENGTH_LONG,
        gravity: ToastGravity.BOTTOM,
        timeInSecForIosWeb: 1,
        backgroundColor: Colors.blueGrey,
        textColor: Colors.white,
        fontSize: 16.0
    );


    Navigator.push(
      context,
      MaterialPageRoute(builder: (context) => LoginPage()),
    );

  }



  showAlertDialog(BuildContext context) {
    // set up the buttons
    Widget cancelButton = FlatButton(
      child: Text("Cancel"),
      onPressed:  () {
        Navigator.pop(context);
      },
    );
    Widget continueButton = FlatButton(
      child: Text("Continue"),
      onPressed:  () {
        logoutUser();
      },
    );
    // set up the AlertDialog
    AlertDialog alert = AlertDialog(
      title: Text("Dear user"),
      content: Text("Are you sure you want logout?"),
      actions: [
        cancelButton,
        continueButton,
      ],
    );
    // show the dialog
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return alert;
      },
    );
  }





  _getDrawerItemWidget(int pos) {
    switch (pos) {
      case 0:
        return new DashboardPage();
      case 1:
        return new Search();
      case 2:
        return new Shelves();

      case 3:
        return new LibraryCard(userID: stud_ID,);

      case 4:
        return new ChatScreen();
      case 6:
        return new SecondFragment();
      case 7:
        return new ThirdFragment();
      case 8:
        return new SecondFragment();
      case 9:
        return new SecondFragment();



      default:
        return new Text("Error");
    }
  }

  _onSelectItem(int index) {
    setState(() => _selectedDrawerIndex = index);
    Navigator.of(context).pop(); // close the drawer
    print(index);
    // Navigator.pop(context);
  }

  @override
  Widget build(BuildContext context) {

    return new Scaffold(
      appBar: new AppBar(
        // here we display the title corresponding to the fragment
        // you can instead choose to have a static title
        title: new Text(appbartitle),
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
                  accountName: Text("User Name"),
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
                        "A",
                        style: TextStyle(fontSize: 40.0),
                      ),
                    ),
                  ),
                ),
                ListTile(
                    title: Row(children: <Widget>[
                      Icon(Icons.star),
                      Text(" Dashboard")
                    ]),
                    onTap: () {
                      _onSelectItem(0);
                      appbartitle = "Dashboard";
                    }),

                ListTile(
                    title: Row(children: <Widget>[
                      Icon(Icons.star),
                      Text(" Dashboard")
                    ]),
                    onTap: () {
                      _onSelectItem(0);
                      appbartitle = "Dashboard";
                    }),

                ListTile(
                    title: Row(children: <Widget>[
                      Icon(Icons.star),
                      Text(" Dashboard")
                    ]),
                    onTap: () {
                      _onSelectItem(0);
                      appbartitle = "Dashboard";
                    }),

                ListTile(
                    title: Row(children: <Widget>[
                      Icon(Icons.star),
                      Text(" Dashboard")
                    ]),
                    onTap: () {
                      _onSelectItem(0);
                      appbartitle = "Dashboard";
                    }),


                ListTile(
                    title: Row(children: <Widget>[
                      Icon(Icons.search),
                      Text("Search Books")
                    ]),
                    onTap: () {
                      _onSelectItem(1);
                      appbartitle = "Search Books";
                    }),

                ListTile(
                    title: Row(children: <Widget>[
                      Icon(Icons.find_in_page),
                      Text("Shelves")
                    ]),
                    onTap: () {
                      _onSelectItem(2);
                      appbartitle = "Shelves";
                    }),
                ListTile(
                    title: Row(children: <Widget>[
                      Icon(Icons.credit_card),
                      Text("Library Card")
                    ]),
                    onTap: () {
                      _onSelectItem(3);
                      appbartitle = "Library Card";
                    }),


                ListTile(
                    title: Row(children: <Widget>[
                      Icon(Icons.check_circle),
                      Text("Recommendations")
                    ]),
                    onTap: () {
                      _onSelectItem(5);
                      appbartitle = "Recommendations";
                    }),

                ListTile(
                    title: Row(children: <Widget>[
                      Icon(Icons.check_circle),
                      Text("Chat")
                    ]),
                    onTap: () {
                      _onSelectItem(4);
                      appbartitle = "Recommendations";
                    }),

                SizedBox(
                  height: MediaQuery.of(context).size.height/5,
                ),





                ListTile(
                    title: Row(children: <Widget>[
                      Icon(Icons.settings),
                      Text("Settings")
                    ]),
                    onTap: () {
                      _onSelectItem(8);
                      appbartitle = "Settings";
                    }),
                ListTile(
                    title: Row(children: <Widget>[
                      Icon(Icons.exit_to_app),
                      Text("Logout")
                    ]),
                    onTap: () {
                      showAlertDialog(context);
                    }),
              ],
            ),
          ),
        ),
      ),
      body: _getDrawerItemWidget(_selectedDrawerIndex),
    );
  }
}

class FirstFragment extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    // TODO: implement build

    return new Container(
        color: Colors.grey[100],
        child: Center(
          child: new Text("Hello Fragment 1",
              style: TextStyle(color: Colors.black.withOpacity(0.8))),
        ));
  }
}

class SecondFragment extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    // TODO: implement build
    return new Center(
      child: new Text("Hello Fragment 2"),
    );
  }
}

class ThirdFragment extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    // TODO: implement build
    return new Center(
      child: new Text("Hello Fragment 3"),
    );
  }
}
