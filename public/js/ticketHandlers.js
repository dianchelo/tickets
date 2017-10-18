
$('#event-search').keyup(function() {
	$('#event-search-results').empty();
	//$('#age').empty();
	var searchKey = $(this).val();
	if(searchKey == '') {
		return false;
	}


  		$.ajax({
			type: "GET",
			url: "/events/geteventdata",
			async: false,
			data: {
				'searchKey' : searchKey,
				'limit': 5,
			},
			success: function(data){
				console.log(data);
				$('#event-search-results').append(data);
				//$('#age').append(data);
				return false;
			}
		});
});

