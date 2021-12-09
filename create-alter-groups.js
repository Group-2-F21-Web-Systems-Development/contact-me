var newMedia = document.getElementById("new-media");
newMedia.addEventListener("click", function() { 
  // create these elements and add them to the dom
  // <input type='text' class="platform" size='40' value='' name='platform[]' placeholder='platform'/>

  var in1 = document.createElement("input");
  in1.type = "text";
  in1.className = "platform";
  in1.size = "40";
  in1.name = "platform[]";
  in1.placeholder = "platform";

  var mediaDiv = document.getElementById("platform-container");
  mediaDiv.append(in1);
});


var delMedia = document.getElementById("del-media");
delMedia.addEventListener("click", function() { 
  console.log(document.getElementById("platform-container").childNodes.length);
  if (document.getElementById("platform-container").childNodes.length != 9) {
    document.getElementById("platform-container").lastElementChild.remove();
  }
});