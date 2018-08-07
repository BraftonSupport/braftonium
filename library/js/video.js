var video = document.getElementById("video"); 
var button = document.getElementById("vidpause");
// var iconpause = document.getElementsByClassName("icon-pause"); 
// var iconplay = document.getElementsByClassName("icon-play"); 

button.addEventListener("click", function() {
	if (video.paused == true) {
      video.play();
	} else {
	  video.pause();
	}
});

//someone help, I can't do this with js
jQuery(document).ready(function($){
    $("#vidpause").click(function() {
        $(".icon-pause").toggle();
        $(".icon-play").toggle();
    });
});