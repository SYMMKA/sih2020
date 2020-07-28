'use strict';
 
const functions = require('firebase-functions');
const {WebhookClient} = require('dialogflow-fulfillment');
const {Card, Suggestion} = require('dialogflow-fulfillment');
const admin = require('firebase-admin');
var config = {
    apiKey: "***********REPLACE**********",
    authDomain: "***********REPLACE**********",
    databaseURL: "***********REPLACE**********",
    projectId: "***********REPLACE**********",
    storageBucket: "***********REPLACE**********",
    messagingSenderId: "***********REPLACE**********"
  };
admin.initializeApp(config);
var database = admin.database();

process.env.DEBUG = 'dialogflow:debug'; // enables lib debugging statements
 
exports.dialogflowFirebaseFulfillment = functions.https.onRequest((request, response) => {
  const agent = new WebhookClient({ request, response });
  console.log('Dialogflow Request body: ' + JSON.stringify(request.body));
 
  function takeUserDetails(agent) {
    return database.ref('users')
       .push({
            phoneNumber: agent.parameters.phoneNumber,
            email: agent.parameters.email
          })
      .then(()=> {
	    agent.add(`Thanks for sharing the details! Which programming language course do you wish to join?`);
    });
  }
  
  function takeCoursePreference(agent) {
    return database.ref('courses').child(agent.parameters.ProgrammingLanguages)
        .once('value').then(snapshot => {
          if (snapshot.exists()) { 
            agent.add(`Sure, would you like to register for a `+ agent.parameters.ProgrammingLanguages +` class?`);
          } else {
            agent.add(`Oops, we don't offer `+ agent.parameters.ProgrammingLanguages +` at this time, let us know if you want to try some other course!`);
          }
        });
  }

  let intentMap = new Map();
  intentMap.set('take_user_details', takeUserDetails);
  intentMap.set('take_course_preference', takeCoursePreference);
  
  agent.handleRequest(intentMap);
});
