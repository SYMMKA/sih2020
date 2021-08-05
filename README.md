# AlphaByte : A Modern Library Management System
**DS165_NeonGenesis**
Smart India Hackathon 2020

Our team progressed to the Finale of SIH2020 creating a library management system. 

We understood that management of a library can be a very tedious task. Along with a plentitude of books there are many other things to take care of.  Hence the need for digitization.
Also as issuers and users, we know that finding the right resources from a huge library is often difficult and time consuming.
As a solution we created AlphaByte, a voice based library management system, not only to digitize management but also to simplify and enhance everyone’s interaction with the library



![2](https://user-images.githubusercontent.com/51905437/128184397-152773ff-2261-43b6-95b5-373fdcd17f78.png)

Link to problem statement : https://www.sih.gov.in/sih2020PS/MjA=/U29mdHdhcmU=/RHIuIEIgUiBBbWJlZGthciBJbnN0aXR1dGUgb2YgVGVjaG5vbG9neQ==/QWxs


## Our Solution
Alphaβyte is a web and app based, voice navigated library management system that offers voice enabled search of books from the internet and
automatic categorization of new resources according to the [Dewey Decimal Classification System](https://www.oclc.org/en/dewey.html). 
- Google books API is used to extract information of books using REST APIs. 
- Information related to book can be searched from the internet and autofilled for faster data entry. 
- Voice based search is done by using [Web Speech API](https://www.google.com/intl/en/chrome/demos/speech.html). It enables developers to use scripting to generate text-to-speech output and to use speech recognition as an input for forms, continuous dictation and control.
- Caching of search results is done to improve performance in sparse internet availability.

The following diagram summarizes major functionalities and design of the project.
![8](https://user-images.githubusercontent.com/51905437/128184585-08f2c1bd-b4ee-4fc7-894f-0e2d04404009.png)

### The Tech Stack
![4](https://user-images.githubusercontent.com/51905437/128191530-2bef0c0f-754e-4485-91c5-c0c57cb7c739.png)



## Installation
This project has 2 parts and specific directions to install and start using them can be found at the following link:
1. [WEB README](/web/README.md#installation)
2. [APP README](/app/README.md#installation)


## Usage
The website is ideally meant to be used by the library administration. This is where the major bulk of the "management" lies. For detailed directions and help on how to use the website, refer [WEB USAGE DOC](/web/WEB%20USAGE.md).

The app can be used by any and all issuers of the library. It is an interface that eases interaction with the library for all users who are sanctioned to use the library.
For detailed directions and help on how to use the website, refer [APP USAGE DOC](/app/APP%20USAGE.md).


## Contributing to AlphaByte
We would love your input! 
For detailed guidelines on how to contribute in this project, refer [CONTRIBUTION](/CONTRIBUTIONS.md) document

## Credits

  - Team Leader: [Manjunath Naik](https://github.com/Manu1ND)
  - [Amit Ramani](https://github.com/Ichigo27)
  - [Mugdha Basak](https://github.com/basakmugdha)
  - [Shraddha Pawar](https://github.com/shraddhavijay)
  - [Kaushik Satra](https://github.com/Kaushik70)
  - [Yousha Gharpure](https://github.com/youshaaaa)

Our project has the following third party dependencies:

For Web:
 - [jsPDF](https://github.com/MrRio/jsPDF/blob/master/LICENSE)

 - [jsPDF-AutoTable](/LICENSE.txt)

 - [OCLC Classify](http://classify.oclc.org/classify2/)

 - [Google books API](https://developers.google.com/books/terms)

 - [Springer](https://dev.springernature.com/)

 - [qrious](https://github.com/neocotic/qrious/blob/master/LICENSE.md) (for generating QR code in web)
 
 - [Html5-QRCode](https://github.com/mebjas/html5-qrcode/blob/master/LICENSE) (QR code reader for web)
 
For App:
 - [Upi pay](https://pub.dev/packages/upi_pay/license)
 
 - [Qr scanner](https://pub.dev/packages/qr_code_scanner/license)

 - [Speech to text](https://pub.dev/packages/speech_to_text/license)

 - [Tabular display widget](https://pub.dev/packages/json_table)


## Copyright and Licenses
This project is open source under the [MIT license](https://opensource.org/licenses/MIT). For more information refer [LICENSE](https://github.com/SYMMKA/sih2020/edit/master/LICENSE.txt) document
