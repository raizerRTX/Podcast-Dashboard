function getPageInfo(url,form, callback) {
	$.ajax({
		url: url,
		type: 'POST',
		dataType: 'JSON', 
		data: form,  
		success: callback,
		error: function(xhr, textStatus, errorThrown) {
			//__19e1919c83ck(xhr);
		}
	});
}

function numberWithCommas(number) {
	var parts = number.toString().split(".");
	parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	return parts.join(".");
}