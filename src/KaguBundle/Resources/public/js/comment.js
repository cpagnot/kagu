$(document).ready(function(){
	$('#send_comment').click(function(){
		var value = $("#comment_value").val();
		$.post(Routing.generate('kagu_comment_ambiance', { id: ambiance, comment: value}), function(result)
		{
			var date = new Date();
			var html = '<article class="row commentaire large-20">';
			html += '<div class="profil-picture large-1 small-3 columns">';
			html += '<img src="/kagu/web/img/valentin.jpg"></div>';
			html += '<div class="large-17 small-17 columns">';
			html += '<h5><a href="#">' + username + '</a> -  <span class="time-comment">' + ' le '+ date.getDate() + '/' + (date.getMonth() + 1) + '/ ' + date.getFullYear() + '</span></h5>'
			html += '<p>' + value + '</p>'
			html += '</div></article>';
			$('.commentaire-container').append(html);
			$("#comment_value").val('');
		})
	});
});