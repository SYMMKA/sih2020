# DS165_NeonGenesis
SIH 2020

## Problem Statement
**Library Software for Andaman College**

Computerization of Library Activities and Book Transactions.

Design a library management system for Andaman college that has voice-based search of books and automatic categorization of books in genres based on title. The system should search from the internet and get information about the book and put them into appropriate categories based on title, authors and information collected online.

Link to problem statement : https://www.sih.gov.in/sih2020PS/MjA=/U29mdHdhcmU=/RHIuIEIgUiBBbWJlZGthciBJbnN0aXR1dGUgb2YgVGVjaG5vbG9neQ==/QWxs


## Our Solution
Alphaβyte is a web and app based, voice navigated library management system that offers voice enabled search of books from the internet and
automatic categorization of books or CDs or magazines new to the library, according to the Dewey Decimal Classification System (most widely used
and standardised classification of knowledge). Google books API is used to extract information of books using REST APIs. Information related to book can be searched from the internet and autofilled for faster data entry. 
Voice based search is done by using Web Speech API. It enables developers to use scripting to generate text-to-speech output and to use speech
recognition as an input for forms, continuous dictation and control.

### 1. Management
A sample of the books displayed as search result can be previewed and downloaded. E-books, audiobooks and papers published by the college can
be manually added. A unique printable qr code [catID+unique title and author ID+copy number] for each copy of a book added to the library, are
generated. This will help us identify and keep track of each book efficiently. Also unique printable qr code [catID] for each shelf is generated which
can be scanned from mobile to track books (issued or in library) belonging to that particular shelf. Relational (MySQL) and non-relational (NoSQL)
database will store all book information.

### 2. Admin Interaction
Firebase authentication and Realtime Database will be used for designing login sessions for admin and users and storing other useful information.
Admin profiles will be authenticated to view, add, delete and modify the database and monitor all activity in the management system. Users will be
verified with phone authentication (OTP verification). Books can be issued to users by admin by scanning a QR code printed on library cards of
students. Books can also be issued by recognizing book title using OCR. A non-relational database (Firebase) is used along with a relational
database (MySQL) to store data for issued books, returned books and all other book information for efficient categorization.

### 3. User Interaction
Registered user profiles will have personalised dashboards where they will be able to check availability of required books, status of books already
issued, reserve books, wishlist books (if all copies are issued) and suggest to add new books. Reserved books will have to be physically issued within a
few hours as reservation will have an expiry time. Users will be notified of the wishlisted books if they are available and also be updated if new edition
of existing books are brought in. Automatic Emails/notification to remind issue deadlines and fines due will also be sent to registered users.
If the user has an issued book overdue, attempt for reservation of new book will be blocked and will be redirected to fine payment page. Users can pay
their fines through an online payment gateway.

### 4. Student Rewarding System
To make this system more interactive and interesting for students, users & admin will have a personalised dashboard where a graphical report of their
interactions with the library will be generated and they will be rewarded with points and batches for various achievements. A leader board on both
website and application will display the top students based on these points and badges. For enhanced interactions and easy flow of information, a
common chat section for all users and admin will also be created. Users can also provide suggestions and feedback to the admin in feedback section.
