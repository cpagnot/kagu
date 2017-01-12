$(document).ready(function(){
	$('#send_comment').click(function(){
		var value = $("#comment_value").val();
		$.post(Routing.generate('kagu_comment_ambiance', { id: ambiance, comment: value}), function(result)
		{
			var date = new Date();
			var html = "<p>" + value + "</p>";
			html += 	'<p>Par ' + username +' le '+ date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
			html +=		'<hr>';
			$('#section_commentaire').append(html);
			$("#comment_value").val('');
		})
	});
});