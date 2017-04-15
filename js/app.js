$(document).foundation();
(function() {
	"use strict";

var videoContainer = document.querySelector("#videoContainer");
var video = document.querySelector("#vidPlayer");
var theControls = document.querySelector("#controls");
var pausePlayButton = document.querySelector("#pausePlay");
var seekBar = document.querySelector("#seekBar");
var muteButton = document.querySelector("#muteButton");
var volumeBar = document.querySelector("#volumeBar");
var fullScreenButton = document.querySelector("#fullScreen");

var currentVid = 1;

video.controls = false;
theControls.classList.remove("hidden");

/*-----JSON-----*/
$('.movieThumbCon').on('click', function() {
		currentVid = this.id;

	$.getJSON('admin/ajaxQuery.php', {movies_id : currentVid}, function(data) {
		//console.log(data);

		video.src = "videos/" + data.movies_trailer;
		video.load();
		pausePlayButton.src = "images/play.svg";
		seekBar.value = 0;
	});
});

/*-----Pause/Play-----*/
function pausePlay() {
	if (video.paused) {
		video.play();
		pausePlayButton.src = "images/pause.svg";
	}else{
		video.pause();
		pausePlayButton.src = "images/play.svg";
	}
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
	

/*-----Mute-----*/	
function vidMute() {
	if (video.muted) {
		video.muted = false;
		muteButton.src = "images/unmute.svg";
	}else{
		video.muted = true;
		muteButton.src = "images/mute.svg";
	}
}

/*-----Volume-----*/	
function volume() {
  video.volume = volumeBar.value;
}

/*-----Full Screen-----*/
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

})();