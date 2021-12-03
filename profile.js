var newMedia = document.getElementById("new-media");
newMedia.addEventListener("click", function() { 
  // create these elements and add them to the dom
  // <input type="text" size="50" value="" name="platform[]" placeholder="platform"/>
  // <input type="text" size="50" value="" name="handle[]" placeholder="link/handle"/> 

  var in1 = document.createElement("input");
  var in2 = document.createElement("input");
  in1.type = "text";
  in1.size = "40";
  in1.name = "platform[]";
  in1.placeholder = "platform";
  in2.type = "text";
  in2.size = "40";
  in2.name = "handle[]";
  in2.placeholder = "link/handle";

  var mediaDiv = document.getElementById("medias");
  mediaDiv.append(in1);
  mediaDiv.append(in2);
}); 

var delMedia = document.getElementById("del-media");
delMedia.addEventListener("click", function() { 
  if (document.getElementById("medias").childNodes.length != 5) {
    document.getElementById("medias").lastElementChild.remove();
    document.getElementById("medias").lastElementChild.remove();
  }
});