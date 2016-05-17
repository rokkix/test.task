$(document).ready(function() {
	$(".sidebar__item").click(function () {
		var id  = $(this).attr('id');
		$("#page").hide();
		$.ajax({
			url:'index.php',
			data:'sort_id='+id,
			type:'get',
			success:function (html) {
				$("#tovar").html(html).hide().fadeIn(2000);
				//$("#yui").html(html).hide().fadeIn(2000);
				
			}
		});
	});
});