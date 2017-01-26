// Launch express and server
var express = require('express');
var app = express();

//connect to DB
var mongoose = require('mongoose');
var db = mongoose.connect('mongodb://127.0.0.1/test');

// Define Model
var Schema = mongoose.Schema;

var johnschema = new Schema({
firstname : String,
lastname : String
});

mongoose.model('johncollections', johnschema);
var Johncollections = mongoose.model('johncollections');

function collect_john(firstname, lastname){
  var johncollections = new Johncollections();

  johncollections.firstname = firstname;
  johncollections.lastname = lastname;

  johncollections.save(function(err, johncollections_Saved){
    if(err){
      throw err;
      console.log(err);
    }else{
      console.log('saved!');
    }
  });
}

app.get('/john/:firstname/:lastname', function(req, res){
  res.send('Your Name:' + req.params.firstname + ' for:' + req.params.lastname);
  collect_john(req.params.firstname,req.params.lastname);
});

app.get('/name', function(req, res) {
    Johncollections.find({}, function(err, links) {
      res.send(links.map(function(d) {
          console.log(d.toObject());
          return JSON.stringify(d.toObject());
          }));
      });
    });
//Launch Server
app.listen(3333);
