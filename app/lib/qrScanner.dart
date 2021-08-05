import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:qr_code_scanner/qr_code_scanner.dart';
import 'package:sihapp/ViewBook.dart';
import 'package:sihapp/constants.dart';
import 'package:http/http.dart' as http;

import 'Search.dart';
import 'ShelvesBooks.dart';
void main() => runApp(MaterialApp(home: QRViewExample()));

const flashOn = 'FLASH ON';
const flashOff = 'FLASH OFF';
const frontCamera = 'FRONT CAMERA';
const backCamera = 'BACK CAMERA';

class QRViewExample extends StatefulWidget {
  const QRViewExample({
    Key key,
  }) : super(key: key);

  @override
  State<StatefulWidget> createState() => _QRViewExampleState();
}

class _QRViewExampleState extends State<QRViewExample> {
  var qrText = '';
  var flashState = flashOn;
  var cameraState = frontCamera;
  String type,bookID,shelfID;
  List<BookDetails> _searchResult = [];
  QRViewController controller;
  final GlobalKey qrKey = GlobalKey(debugLabel: 'QR');

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          'Qr Code Scanner',
          style: TextStyle(color: Color(0xff001730)),
        ),
        backgroundColor: Colors.white,
        iconTheme: IconThemeData(color: Color(0xff001730)),
      ),
      body: Column(
        children: <Widget>[
          Expanded(
            flex: 2,
            child: QRView(
              key: qrKey,
              onQRViewCreated: _onQRViewCreated,
              overlay: QrScannerOverlayShape(
                borderColor: Colors.red,
                borderRadius: 10,
                borderLength: 30,
                borderWidth: 10,
                cutOutSize: 300,
              ),
            ),
          ),
          Expanded(
            flex: 1,
            child: Container(
              child: Column(
                mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                children: <Widget>[
                  Text('Scan to get Book and Shelf details: $qrText'),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.center,
                    crossAxisAlignment: CrossAxisAlignment.center,
                    children: <Widget>[
                      Container(
                        margin: EdgeInsets.all(2),
                        child: RaisedButton(
                          onPressed: () {
                            if (controller != null) {
                              controller.toggleFlash();
                              if (_isFlashOn(flashState)) {
                                setState(() {
                                  flashState = flashOff;
                                });
                              } else {
                                setState(() {
                                  flashState = flashOn;
                                });
                              }
                            }
                          },
                          child:
                              Text(flashState, style: TextStyle(fontSize: 14)),
                        ),
                      ),
                      Container(
                        padding: EdgeInsets.all(2),
                        child: RaisedButton(
                          onPressed: () {
                            if (controller != null) {
                              controller.flipCamera();
                              if (_isBackCamera(cameraState)) {
                                setState(() {
                                  cameraState = frontCamera;
                                });
                              } else {
                                setState(() {
                                  cameraState = backCamera;
                                });
                              }
                            }
                          },
                          child:
                              Text(cameraState, style: TextStyle(fontSize: 14)),
                        ),
                      )
                    ],
                  ),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.center,
                    crossAxisAlignment: CrossAxisAlignment.center,
                    children: <Widget>[
                      Container(
                        padding: EdgeInsets.all(2),
                        child: RaisedButton(
                          onPressed: () {
                            controller?.pauseCamera();
                          },
                          child: Text('pause', style: TextStyle(fontSize: 14)),
                        ),
                      ),
                      Container(
                        padding: EdgeInsets.all(2),
                        child: RaisedButton(
                          onPressed: () {
                            controller?.resumeCamera();
                          },
                          child: Text('resume', style: TextStyle(fontSize: 14)),
                        ),
                      )
                    ],
                  ),
                ],
              ),
            ),
          )
        ],
      ),
    );
  }

  bool _isFlashOn(String current) {
    return flashOn == current;
  }

  bool _isBackCamera(String current) {
    return backCamera == current;
  }

   _onQRViewCreated(QRViewController controller) async{
    this.controller = controller;
    controller.scannedDataStream.listen((scanData) {
      setState(() {
        qrText = scanData;

      });

      try {
        Map valueMap = json.decode(qrText);
        debugPrint(valueMap["Type"]);
        type = valueMap["Type"];
        if (type.contains("Shelf")) {
          shelfID = valueMap["ShelfID"];
          Navigator.pushReplacement(
            context,
            MaterialPageRoute(
                builder: (context) => ShelvesBooks(shelfid: shelfID,)),
          );
        }
        else if (type.contains("Book")) {
          bookID = valueMap["BookID"];
          getbookdetails(bookID);
        }
      }
      catch(e)
      {
        showToast("invalid qr code");
      }


    });


   }





   getbookdetails(String bookID) async
   {

     final response = await http.post(rootUrl + "onScanBook.php", body: {
       "bookID": bookID,
     });

     final responseJson = json.decode(response.body);
     debugPrint(response.body.toString());
     _searchResult.clear();


       setState(() {
         for (Map user in responseJson) {
           _searchResult.add(BookDetails.fromJson(user));
         }
         debugPrint(_searchResult.length.toString());
       });

       final book = new Book(
            _searchResult[0].title,
           _searchResult[0].author,
           _searchResult[0].category,
        _searchResult[0].subCategory,
           _searchResult[0].publisher,
          _searchResult[0].pages,
           _searchResult[0].quantity,
           _searchResult[0].imgLink,
            _searchResult[0].date_of_publication,
          _searchResult[0].isbn,
          _searchResult[0].bookID,
          _searchResult[0].star
       );

       Navigator.pushReplacement(
         context,
         MaterialPageRoute(
           builder: (context) => ViewBook(book: book,),
         ),
       );




   }

  @override
  void dispose() {
    controller.dispose();
    super.dispose();
  }
}
