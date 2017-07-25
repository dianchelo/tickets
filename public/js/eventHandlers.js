var checkSim;
var flag = 0;
var eventid = $('#eventid').val();

$(document).ready(function(){

	
	
	allowAutoLoad = false;
	//checkSimulationOnLoad(eventid);

	toggleOff();

	console.log(eventid);

	

	if(flag == 0) {
		$.ajax({
			type: "GET",
			url: "/tickets/getbyeventid",
			async: false,
			data: {
				'event_id' : eventid,
				'case' : 'tickets',
				'offset': flag,
				'limit': 6,
			},
			success: function(data){
				console.log(data);
				$('.event-tickets').append(data);
				flag += 6;
				console.log(flag);
				return false;
			}
		});
	}

	$('#ticketLoader').on('click', function(){
		$(this).hide();
		allowAutoLoad = true;
		loadMore();
	})
	
	$(window).scroll(function() {

		 if($(window).scrollTop() >= $(document).height() - $(window).height()) {

			if(allowAutoLoad === true) {
				loadMore();
			}


		 }

	});


function loadMore() {
	$.ajax({
		type: "GET",
		url: "/tickets/getbyeventid",
		async: false,
		data: {
			'event_id' : eventid,
			'case' : 'tickets',
			'offset': flag,
			'limit': 6,
		},
		success: function(data){
			console.log(data);
			$('.event-tickets').append(data);
			flag += 6;
			console.log(flag);
			return false;
		}
	});
}


	// Show the loader but loading is going too fast right now..

	// $(document).ajaxStart(function(){
	//     $('#iZ').html('<div class="ajaxload" style="width:100%; background-color:#ccc; height:50px; margin:-top:5px; margin-bottom:5px; border-radius:5px; border:1px solid #5b5b5b; text-align:center;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
	// });
	// $(document).ajaxComplete(function(){
	// 	//$('.ajaxload').css("display", "none");
	// });

	$('#sim-event').on('change', function(){
		var eventid =  $('#eventid').val();

		if($(this).prop('checked') === true) {
			$('#ticketLoader').hide();

			showAllTickets();


			simulation(eventid);
			$('#sim-notice').html('The simulator is active');

			countDifferentTickets();
		}
		else {
			stopSimulation(eventid);
			$('#sim-notice').html('The simulator is ready to be used');
		}	
	});

	$('.reserved-tick-amount').on('click', function(){
		$('.event-tickets-reserved').show();
		$('.event-tickets').hide();
		$('.event-tickets-sold').hide();
		$('.ticket-title').html('Reserved Tickets');
		

	});
	$('.avail-tick-amount').on('click', function(){
		$('.event-tickets-reserved').hide();
		$('.event-tickets').show();
		$('.event-tickets-sold').hide();
		$('.ticket-title').html('Available Tickets');

	});
	$('.sold-tick-amount').on('click', function(){
		$('.event-tickets-reserved').hide();
		$('.event-tickets').hide();
		$('.event-tickets-sold').show();
		$('.ticket-title').html('Sold Tickets');
	});


});

function countDifferentTickets() {
	var countReserved = $(".event-tickets-reserved a").length;
	$('.reserved-badge').html(countReserved);

	var countAvailable = $(".event-tickets a").length;
	$('.avail-badge').html(countAvailable);

	var countSold = $(".event-tickets-sold a").length;
	$('.sold-badge').html(countSold);
}

function toggleOn() {
    $('#sim-event').bootstrapToggle('on')
}
function toggleOff() {
	$('#sim-event').bootstrapToggle('off')  
}

function showAllTickets() {
	$.ajax({
		type: "GET",
		url: "/tickets/getbyeventid",
		async: false,
		data: {
			'event_id' : eventid,
			'case' : 'alltickets',
			'offset': flag
		},
		success: function(data){
			console.log(data);
			$('.event-tickets').append(data);
			//flag += 6;
			console.log(flag);
			return false;
		}
	});
}

// Start the event simulation
function simulation(eventid) {
	clearTimeout(checkSim);
	console.log('active');



	$.ajax({
		type: "GET",
		url: "/events/simulate",
		async: false,
		data: {
			'event_id': eventid
		},
		success: function(data){

			$(data).each(function(i, val){

				if(this.status == 'R') {

					var element = $('a[data-ticket-id="'+ this.ticket_id +'"]').detach();
					$('.event-tickets-reserved').append(element);
				}

				if(this.status == 'S') {

					var element = $('a[data-ticket-id="'+ this.ticket_id +'"]').detach();
					$('.event-tickets-sold').append(element);
				}

			var correct = $('a').find("[data-ticket-id='" + this.ticket_id + "']");
			});
			
		},
		complete : function(data) {
			//var obj = JSON.parse(data.responseText);
			//console.log(obj[0].ticket_id);
			//var arr = $.map(data.responseText, function(el) { return el; })
			//console.log(arr);

			//simulation(eventid);
			//setTimeout(function(){ simulation(eventid); }, 30000);
		}  
    });
}

// Stop the simulation
function stopSimulation(eventid) {
	clearTimeout(checkSim);
	console.log('stopped');

	$.ajax({
		type: "GET",
		url: "/events/stopsimulate",
		async: false,
		data: {
			'event_id': eventid
		},
		success: function(data){
		},
		complete : function(data) {
		}  
    });
}


// Check if the simulation is already running to disable/enable toggle.
function checkSimulationOnLoad(eventid) {
	console.log('onload check');
	$.ajax({
		type: "GET",
		url: "/events/checksimulateonload",
		async: false,
		data: {
			'event_id': eventid
		},
		success: function(data){
			if(data == 'A') {
				$('#sim-event').bootstrapToggle('disable')
				$('#sim-notice').html('Someone else is already running the script, the tickets will load');
			}
			if(data == 'N') {
				$('#sim-event').bootstrapToggle('enable')
				$('#sim-notice').html('The simulator is ready to be used 1');
			}
			checkSim = setTimeout(function(){ checkSimulationOnLoad(eventid); }, 3000);
		},
		complete : function(data) {
		}  
    });
}