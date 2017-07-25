$('#home-search').keyup(function() {
	$('#home-search-results').empty();
	var searchKey = $(this).val();
	if(searchKey == '') {
		return false;
	}


  		$.ajax({
			type: "GET",
			url: "/events/geteventlist",
			async: false,
			data: {
				'searchKey' : searchKey,
				'limit': 5,
			},
			success: function(data){
				console.log(data);
				$('#home-search-results').append(data);
				return false;
			}
		});
});