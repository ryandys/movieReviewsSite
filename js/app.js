$(document).foundation();
(function() {
	"use strict";

var thumbnailCon = document.querySelector("#thumbnailCon");
var thumbnails = document.querySelectorAll('#thumbnailCon img');
//console.log(thumbnails.length);
	
$('#thumbnailCon img').on('click', function() {
		currentVid = this.id;

	$.getJSON('admin/ajaxQuery.php', {gallery_id : currentVid}, function(data) {
		//console.log(data);

		$('#mainImg img').attr('src',"images/uploads/" + data.gallery_img);
		$('#thumbnailCon div').addClass('nonActive');
		$('#'+data.gallery_id).parent().removeClass('nonActive');

	});
});

var videoContainer = document.querySelector("#videoContainer"),
	video = document.querySelector("video"),
	theControls = document.querySelector("#controls"),
	pausePlayButton = document.querySelector("#pausePlay"),
	seekBar = document.querySelector("#seekBar"),
	muteButton = document.querySelector("#muteButton"),
	volumeBar = document.querySelector("#volumeBar"),
	fullScreenButton = document.querySelector("#fullScreen");

video.controls = false;
theControls.classList.remove("hidden");

/*-----Pause/Play Button-----*/
function pausePlay() {
	if (video.paused) {
		video.play();
		pausePlayButton.src = "images/pause.svg";
	}else{
		video.pause();
		pausePlayButton.src = "images/play.svg";
	}
}
function switchImg() {
	pausePlayButton.src = "images/play.svg";
}

/*-----Seek Bar-----*/	
function seek() {
	var time = video.duration * (seekBar.value / 100);
	video.currentTime = time;
}
function updateTime() {
	var value = (100 / video.duration) * video.currentTime;
	seekBar.value = value;
}
function mouseDown() {
	video.pause();
	pausePlayButton.src = "images/play.svg";
}
function mouseUp() {
	video.play();
	pausePlayButton.src = "images/pause.svg";
}
	

/*-----Mute Button-----*/	
function vidMute() {
	if (video.muted) {
		video.muted = false;
		muteButton.src = "images/mute.svg";
	}else{
		video.muted = true;
		muteButton.src = "images/unmute.svg";
	}
}

/*-----Volume Slider-----*/	
function volume() {
  video.volume = volumeBar.value;
}

/*-----Full Screen Button-----*/
function fullScreen() {
	if (video.requestFullscreen) {
		video.requestFullscreen();
	}else if(video.mozRequestFullScreen) {
		video.mozRequestFullScreen();
	}else if(video.webkitRequestFullscreen) {
		video.webkitRequestFullscreen();
	}
}

/*-----Event Listeners-----*/
pausePlayButton.addEventListener("click", pausePlay, false);
muteButton.addEventListener("click", vidMute, false);
fullScreenButton.addEventListener("click", fullScreen, false);
volumeBar.addEventListener("change", volume, false);
seekBar.addEventListener("change", seek, false);
video.addEventListener("timeupdate", updateTime, false);
seekBar.addEventListener("mousedown", mouseDown, false);
seekBar.addEventListener("mouseup", mouseUp, false);

})();