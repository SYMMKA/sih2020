$('#mainCategorySelect1').change( function () {
    $('.container .row.row-cols-1.row-cols-md-4 .col.mb-4').show();
	var option = $(this).find('option:selected').val();
	if (option != ''){
		var value = $(this).find('option:selected').text(); // get the value of the input, which we filter on
		$('.container .row.row-cols-1.row-cols-md-4 .col.mb-4').filter(function() {
			$(this).toggle($(this).find('.card.h-100 .card-body .Category1').val().indexOf(value) > -1);
		});
	}
});

$('#mainCategorySelect2').change( function () {
    $('.container .row.row-cols-1.row-cols-md-4 .col.mb-4').show();
	var option = $(this).find('option:selected').val();
	if (option != ''){
		var value = $(this).find('option:selected').text(); // get the value of the input, which we filter on
		$('.container .row.row-cols-1.row-cols-md-4 .col.mb-4').filter(function() {
			$(this).toggle($(this).find('.card.h-100 .card-body .Category2').val().indexOf(value) > -1);
		});
	}
});

$('#mainCategorySelect3').change( function () {
    $('.container .row.row-cols-1.row-cols-md-4 .col.mb-4').show();
	var option = $(this).find('option:selected').val();
	if (option != ''){
		var value = $(this).find('option:selected').text(); // get the value of the input, which we filter on
		$('.container .row.row-cols-1.row-cols-md-4 .col.mb-4').filter(function() {
			$(this).toggle($(this).find('.card.h-100 .card-body .Category3').val().indexOf(value) > -1);
		});
	}
});

$('#mainCategorySelect4').change( function () {
    $('.container .row.row-cols-1.row-cols-md-4 .col.mb-4').show();
	var option = $(this).find('option:selected').val();
	if (option != ''){
		var value = $(this).find('option:selected').text(); // get the value of the input, which we filter on
		$('.container .row.row-cols-1.row-cols-md-4 .col.mb-4').filter(function() {
			$(this).toggle($(this).find('.card.h-100 .card-body .Category4').val().indexOf(value) > -1);
		});
	}
});

$('#book_audio').change( function () {
    $('.container .row.row-cols-1.row-cols-md-4 .col.mb-4').show();
	var option = $(this).find('option:selected').val();
	if (option != ''){
		var value = $(this).find('option:selected').val(); // get the value of the input, which we filter on
		$('.container .row.row-cols-1.row-cols-md-4 .col.mb-4').filter(function() {
			$(this).toggle($(this).find('.card.h-100 .card-body .book').val().indexOf(value) > -1);
		});
	}
});

$('#dig_phy').change( function () {
    $('.container .row.row-cols-1.row-cols-md-4 .col.mb-4').show();
	var option = $(this).find('option:selected').val();
	if (option != ''){
		var value = $(this).find('option:selected').val(); // get the value of the input, which we filter on
		$('.container .row.row-cols-1.row-cols-md-4 .col.mb-4').filter(function() {
			$(this).toggle($(this).find('.card.h-100 .card-body .digital').val().indexOf(value) > -1);
		});
	}
});