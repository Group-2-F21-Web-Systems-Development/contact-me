$(document).ready(function() { // after everything in html loads
  $.ajax({
    type: "GET",
    url: "./src/ajax/data.json",
    dataType: "json",
    success: function(responseData, status) {
      // header
      header = document.createElement("header");
      nav = document.createElement("nav");
      ul = document.createElement("ul");
      $.each(responseData.header.nav, function(i, liEl) { // add internal navagation links to header
        li = document.createElement("li");
        // create anchor tags nested in li with text and href
        a = document.createElement("a");
        a.append(Object.keys(liEl));
        a.setAttribute("href", Object.values(liEl));
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