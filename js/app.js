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

})();