$(document).on('ready', function() {
	$(".comparebtn").click(function(){
		//check validation
		var oldtext = $('#oldtext').val();
		var newtext = $('#newtext').val();
		if(oldtext == '' && newtext == '') {
			alert('Введите текст');
			return false;
		}
		$("#result").html('');
		$.ajax({
			url: '/index.php?r=site%2Fcompare',
			type: 'POST',
			dataType: 'JSON',
			data: {
				oldtext: oldtext,
				newtext: newtext,
			},
			success: function(res) {
				$("#result").html(res.response);
				$(".modified").mouseover(function() {
					var key = $(this).data('key');
					$(this).hide();
					$("#modifiedpreview"+key).css('display','block');
				}).mouseout(function(){
					var key = $(this).data('key');
					$(this).show();
					$("#modifiedpreview"+key).css('display','none');
				});
			}
		});
		return false;
	});

		
		
	
});