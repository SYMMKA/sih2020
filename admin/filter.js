$('.filter').change(function () {
	//$('.container .row.row-cols-1.row-cols-md-4 .col.mb-4').show();
	var cat1 = '';
	var cat2 = '';
	var cat3 = '';
	var cat4 = '';
	var book_audio = '';
	var dig_phy = '';
	var cat1Option = $('#mainCategorySelect1').find('option:selected').val();
	if (cat1Option != '')
		var cat1 = $(this).find('#mainCategorySelect1 option:selected').text();
	var cat2Option = $('#mainCategorySelect2').find('option:selected').val();
	if (cat2Option != '')
		var cat2 = $(this).find('#mainCategorySelect2 option:selected').text();
	var cat3Option = $('#mainCategorySelect3').find('option:selected').val();
	if (cat3Option != '')
		var cat3 = $(this).find('#mainCategorySelect3 option:selected').text();
	var cat4Option = $('#mainCategorySelect4').find('option:selected').val();
	if (cat4Option != '')
		var cat4 = $(this).find('#mainCategorySelect4 option:selected').text();
	var book_audioOption = $('#book_audio').find('option:selected').val();
	if (book_audioOption != '')
		var book_audio = $(this).find('#book_audio option:selected').val();
	var dig_phyOption = $('#dig_phy').find('option:selected').val();
	if (dig_phyOption != '')
		var dig_phy = $(this).find('#dig_phy option:selected').val();
		
	$('.container .row.row-cols-1.row-cols-md-4 .col.mb-4').filter(function () {
		$(this).toggle(
			$(this).find('.card.h-100 .card-body .Category1').val().indexOf(cat1) > -1 &&
			$(this).find('.card.h-100 .card-body .Category2').val().indexOf(cat2) > -1 &&
			$(this).find('.card.h-100 .card-body .Category3').val().indexOf(cat3) > -1 &&
			$(this).find('.card.h-100 .card-body .Category4').val().indexOf(cat4) > -1 &&
			$(this).find('.card.h-100 .card-body .book').val().indexOf(book_audio) > -1 &&
			$(this).find('.card.h-100 .card-body .digital').val().indexOf(dig_phy) > -1
		);
	});
});