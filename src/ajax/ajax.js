$(document).ready(function() { // after everything in html loads
  $.ajax({
    type: "GET",
    url: "./src/ajax/data.json",
    dataType: "json",
    cache: "false",
    success: function(responseData, status) {
      // acquire php session super global as json object
      var sessionExists = 0;
      $.ajaxSetup({cache: false, async: false})
      $.get('./src/ajax/getsession.php', function (data) {
        jsObj =  JSON.parse(data);
        if (!(Object.keys(jsObj).length === 0)) {
          sessionExists = 1;
        }
      });
      // header
      header = document.createElement("header");
      nav = document.createElement("nav");
      ul = document.createElement("ul");
      $.each(responseData.header.nav, function(i, liEl) { // add internal navagation links to header
        li = document.createElement("li");
        // create anchor tags nested in li with text and href
        a = document.createElement("a");
        if ( i === 3 && sessionExists === 1) {
          // login

        } else if ( i === 4 && sessionExists === 1) {
          // signup
          a.append("Logout");
          a.setAttribute("href", "./src/ajax/logout.php");
        } else {
          a.append(Object.keys(liEl));
          a.setAttribute("href", Object.values(liEl));
        }
        
        if (i==0) { // add logo class
          a.classList.toggle("logo");
        }
        li.append(a);
        ul.append(li);
      });
      // append nav and ul with li children to header      
      nav.append(ul);
      header.append(nav);
      

      // add entire header to body
      document.body.prepend(header);

    }, error: function(msg) {
      alert("There was a problem: " + msg.status + " " + msg.statusText);
    }
  });

});