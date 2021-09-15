alert("Start date.js");
var today = new Date();

var dateString = today.toLocaleString();
var day = today.getDay();
var month = today.getMonth();
var year = today.getFullYear();
var timeMilliseconds = today.getTime();
var hour = today.getHours();

document.write(
    "Date: " + dateString + "<br />",
    "Day: " + day + "<br />",
    "Month: " + month + "<br />",
)

var dum1 = 1.0012425, product = 1;
var start = new Date();

for (var count = 0; count < 10000; count ++)
    product = product + 1.000002 * dum1/ 1.000001;

var end = new Date();
var diff = end.getTime() - start.getTime();
document.write("<br /> The loop took " + diff + " milliseconds <br />");
