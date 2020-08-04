
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:sihapp/Login.dart';
import 'package:http/http.dart' as http;
import 'constants.dart';
import 'homeTest.dart';
import 'notification.dart';



Future<void> main() async {
  WidgetsFlutterBinding.ensureInitialized();
  SharedPreferences prefs = await SharedPreferences.getInstance();
  var status = prefs.getBool('isLoggedIn') ?? false;
  print(status.toString()+"=status");
  runApp(status == true ? HomeTest(pos: 0) : MyApp());
}


//
//Future<void> _repeatNotification() async {
//  var androidPlatformChannelSpecifics = AndroidNotificationDetails(
//      'repeating channel id',
//      'repeating channel name',
//      'repeating description');
//  var iOSPlatformChannelSpecifics = IOSNotificationDetails();
//  var platformChannelSpecifics = NotificationDetails(
//      androidPlatformChannelSpecifics, iOSPlatformChannelSpecifics);
//  await flutterLocalNotificationsPlugin.periodicallyShow(2, 'repeating title',
//      'repeating body', RepeatInterval.EveryMinute, platformChannelSpecifics);
//}

//Future<void> main() async {
//  // needed if you intend to initialize in the `main` function
//  WidgetsFlutterBinding.ensureInitialized();
//
//  notificationAppLaunchDetails =
//  await flutterLocalNotificationsPlugin.getNotificationAppLaunchDetails();
//
//  var initializationSettingsAndroid = AndroidInitializationSettings('@mipmap/ic_launcher');
//  // Note: permissions aren't requested here just to demonstrate that can be done later using the `requestPermissions()` method
//  // of the `IOSFlutterLocalNotificationsPlugin` class
//  var initializationSettingsIOS = IOSInitializationSettings(
//      requestAlertPermission: false,
//      requestBadgePermission: false,
//      requestSoundPermission: false,
//      onDidReceiveLocalNotification:
//          (int id, String title, String body, String payload) async {
//        didReceiveLocalNotificationSubject.add(ReceivedNotification(
//            id: id, title: title, body: body, payload: payload));
//      });
//  var initializationSettings = InitializationSettings(
//      initializationSettingsAndroid, initializationSettingsIOS);
//  await flutterLocalNotificationsPlugin.initialize(initializationSettings,
//      onSelectNotification: (String payload) async {
//        if (payload != null) {
//          debugPrint('notification payload: ' + payload);
//        }
//        selectNotificationSubject.add(payload);
//      });


//  _repeatNotification();
//
//  final response = await http.post(rootUrl + "get_notify.php", body: {
//    "stud_ID": '14332',
//  });
//
//
//
//  debugPrint(response.body);
//
//
//  runApp(
//    MaterialApp(
//      home: GetNotified(),
//    ),
//  );
//}



class MyApp extends StatelessWidget {
  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {

    SystemChrome.setPreferredOrientations([
      DeviceOrientation.portraitUp,
      DeviceOrientation.portraitDown,

    ]);

    return MaterialApp(
      title: 'Flutter Demo',
      theme: ThemeData(

        brightness: Brightness.light,
        primaryColor: Colors.black,
        accentColor: Colors.cyan[600],

        // Define the default font family.
        fontFamily: 'Georgia',

      ),
      home:LoginPage( ),
    );
  }
}
