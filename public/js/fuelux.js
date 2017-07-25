console.log('ssss');

$(document).ready(function(){

	var eventid =  $('#eventid').val();
	var checkSim;
	checkSimulationOnLoad(eventid);


	toggleOff();

	var flag = 0;

	if(flag == 0) { 
		$.ajax({
			type: "GET",
			url: "/events/data",
			async: false,
			data: {
				'offset': flag,
				'limit': 15,
			},
			success: function(data){
				$('.events-tbody').append(data)
				flag += 15;
				console.log(flag);
				return false;
			}
		});
	}
	
	$(window).scroll(function() {

		if($(window).scrollTop() >= $(document).height() - $(window).height()) {

		}

	});


	$('#iS').on('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            
			$.ajax({
				type: "GET",
				url: "/events/data",
				async: false,
				data: {
					'offset': flag,
					'limit': 3,
				},
				success: function(data){
					$('.events-tbody').append(data)
					flag += 3;
					console.log(flag);

					
				}
			});
			return false;

        }
    })

	$(document).ajaxStart(function(){
	    $('#iZ').html('<div class="ajaxload" style="width:100%; background-color:#ccc; height:50px; margin:-top:5px; margin-bottom:5px; border-radius:5px; border:1px solid #5b5b5b; text-align:center;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>');
	});
	$(document).ajaxComplete(function(){
		//$('.ajaxload').css("display", "none");
	});

	$('#sim-event').on('change', function(){
		var eventid =  $('#eventid').val();

		if($(this).prop('checked') === true) {
			simulation(eventid);
			$('#sim-notice').html('The simulator is active');			
		}
		else {
			stopSimulation(eventid);
			$('#sim-notice').html('The simulator is ready to be used');
		}	
	});


});

function toggleOn() {
    $('#sim-event').bootstrapToggle('on')
}
function toggleOff() {
	$('#sim-event').bootstrapToggle('off')  
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

			//console.log(data[0].ticket_id);
			$(data).each(function(){
				console.log(this.ticket_id);

			// if( $('a').attr('data-ticket-id') == this.ticket_id ) {
			// 	$('a').html('OKE?');
			// }

			$('a[data-ticket-id="'+ this.ticket_id +'"]').addClass('not-active');

			var correct = $('a').find("[data-ticket-id='" + this.ticket_id + "']");
			console.log(correct);
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