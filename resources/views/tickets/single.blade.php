@extends('main')

@section('topclass', 'event-bg')

@section('stylesheets')

{{ Html::style('css/slider/component.css')}}
{{ Html::style('css/slider/demo.css')}}


<style>

span[rel="tag"]:before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0; 
    left: 0;
    z-index:1;
    
    background: -moz-radial-gradient(.6em .6em, circle, white .55em, rgba(255,255,255,0) .6em) -.6em -.6em,
                -moz-radial-gradient(1em 50%, circle, white .35em, rgba(255,255,255,0) .4em),
                -moz-radial-gradient(1em 47%, circle, rgba(0,0,0,.4) .4em, transparent .43em);
    background: -o-radial-gradient(.6em .6em, circle, white .55em, rgba(255,255,255,0) .6em) -.6em -.6em,
                -o-radial-gradient(1em 50%, circle, white .35em, rgba(255,255,255,0) .4em),
                -o-radial-gradient(1em 47%, circle, rgba(0,0,0,.4) .4em, transparent .43em);
    background: -ms-radial-gradient(.6em .6em, circle, white .55em, rgba(255,255,255,0) .6em) -.6em -.6em,
                -ms-radial-gradient(1em 50%, circle, white .35em, rgba(255,255,255,0) .4em),
                -ms-radial-gradient(1em 47%, circle, rgba(0,0,0,.4) .4em, transparent .43em);
    background: -webkit-radial-gradient(.6em .6em, circle, white .55em, rgba(255,255,255,0) .6em) -.6em -.6em,
                -webkit-radial-gradient(1em 50%, circle, white .35em, rgba(255,255,255,0) .4em),
                -webkit-radial-gradient(1em 47%, circle, rgba(0,0,0,.4) .4em, transparent .43em);
}

span[rel="tag"]:after {
    content: '';
    position:absolute;
    top:.25em;
    right:.25em;
    bottom:.25em;
    left:.25em;
    border: 1px rgba(0,0,0,.3) dashed;
    outline: 1px rgba(255,255,255,.5) dashed;
}

span[rel="tag"] {
    display: inline-block;
    position:relative;
    padding: .7em;
    padding-left: 2em;
    margin: 0 .5em .5em 0;
    background: #{{$ticket->event->event_colour}};
    color: rgba(255,255,255,.6);
    text-decoration:none;
    font-weight: bold;
    height: 150px;
    width:310px;
}

span[rel="tag"]:hover {
    background:#{{$ticket->event->dark_event_colour}};
    color:white;
}

.custom-bg { 
    background: #{{$ticket->event->event_colour}};
 }

 .custom-bg:hover{
    background:#{{$ticket->event->dark_event_colour}};
 }

.bigger{
	margin-top:10px;
	font-size:70px;
}
</style>
@endsection


@section('scripts')
{{ Html::script('js/slider/classie.js') }}
{{ Html::script('js/slider/modernizr.min.js') }}
{{ Html::script('js/slider/photostack.js') }}

        <script>
            // [].slice.call( document.querySelectorAll( '.photostack' ) ).forEach( function( el ) { new Photostack( el ); } );
            
            new Photostack( document.getElementById( 'photostack-1' ), {
                callback : function( item ) {
                    //console.log(item)
                }
            } );
            new Photostack( document.getElementById( 'photostack-2' ), {
                callback : function( item ) {
                    //console.log(item)
                }
            } );
            new Photostack( document.getElementById( 'photostack-3' ), {
                callback : function( item ) {
                    //console.log(item)
                }
            } );
        </script>

@endsection

 @section('topcontainer')

 	<div class="">
 		<div class="col-md-6 col-md-offset-3 text-center">
 			<a href="/events/{{ $ticket->event->id }}"><h1 class="t-white">{{ $ticket->event->name }}</h1></a>
 			<input id="eventid" value="{{ $ticket->event['id'] }}" hidden>
 		</div>
 	</div>

 	<div class="">
 		<div class="col-md-2 col-md-offset-4 text-center ">
 			<span class="glyphicon glyphicon-calendar btn-lg" aria-hidden="true"></span>  {{ date('l j F, Y', strtotime($ticket->event->event_date)) }}
 		</div>
 		<div class="col-md-2 col-md-offset-0 text-center  ">
 			 <span class="glyphicon glyphicon-map-marker btn-lg" aria-hidden="true"></span>  {{ date('l j F, Y', strtotime($ticket->event->event_date)) }}
 		</div>
 	</div>

 	<div class="" >
 		<div  style="background-color:white; padding:20px; border-radius:30px; border:1px dashed #{{$ticket->event->event_colour}}" class="col-md-4 col-md-offset-4 text-center">
 			<span href="#" rel="tag" data-ticket-id=""> 
				<div class="bigger">{{ $ticket->id }}</div><br>
				 <br>
			</span>
		</div>
 	</div>


 @endsection

@section('content')

	<div class="row" style="margin-top:20px;">
		<div class="col-md-3">
                  <div class="caption text-center form-spacing-top">
                  <img src="https://graph.facebook.com/v2.10/{{ $ticket->user->facebook_id }}/picture?type=large" class="img-circle">
                    <h3>{{ $ticket->user->name }} </h3>
                </div>
            </div>

		<div class="col-md-9">

            <i>{{ $ticket->event->description }}</i>
            @if($ticket->status == 'A')
            <div class="col-md-10 col-md-offset-1 form-spacing-top">
                <div class="jumbotron jumbotron-fluid">

                    
                        <div class="row">
                            <div class="col-md-6 col-md-offset-6" style="text-align:right;"><h3>€{{ $ticket->price }}</h3></div>
                        </div>

                        

                        <form action="/cart" method="POST">
                          {!! csrf_field() !!}
                          <input type="hidden" name="id" value="{{ $ticket->id }}">
                          <input type="hidden" name="name" value="{{ $ticket->event->name }}">
                          <input type="hidden" name="price" value="{{ $ticket->price }}">
                          <input type="submit" class="btn btn-lg custom-bg btn-block" value="Nu kopen">
                        </form>

                        <div class="row">
                            <div class="col-md-12 "><h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae leo vehicula, varius est ut, aliquam purus. Ut eget vulputate purus. Class aptent taciti sociosqu ad litora torquent per conubia nostra</h5></div>
                        </div>





                </div>
            </div>  

            @elseif($ticket->status == 'R')
                <div class="row">
                <h1>Tickets are already in someone's cart</h1>

                <h4>This means the tickets will probably be sold. If they do not, they'll come back up for sale</h4>
                </div>

            @elseif($ticket->status == 'S')    

                <div class="row text-center" style="border:1px solid red; border-radius:10px; height: 50px; padding:10px; background-color:pink;">
                    <h5>This ticket is not availible anymore.</h5>
                </div>

            @endif
        </div>
	</div>

@endsection

@if(@isset($images) && count($images) > 0 && $images != "")

@section('bottom-container-class', 'bottom-container1')

@section('instagram')

<div class="row">
    <div class="col-md-2 col-md-offset-5 text-center"><h2>Hashtags</h2></div>
    <div class="tags col-md-12 text-center">
        @foreach($tags as $tag)
        <span class="label label-default">{{ $tag->name }} </span>
        @endforeach
    </div>
</div>

<section id="photostack-1" class="photostack photostack-start">
                <div>
                
                    @foreach($images as $image)
                        @if(@isset($image['carousel_media'])) 
                            @foreach($image['carousel_media'] as $carousel_image) {
                                <figure>
                                    <a href="http://goo.gl/Qw3ND4" class="photostack-img"><img src="{{ $carousel_image['images']['low_resolution']['url'] }}" width="240" height="240"></a>
                                    <figcaption>
                                        <h2 class="photostack-title">{{ $image['caption']['text'] }}</h2>
                                    </figcaption>
                                </figure>
                            }
                            @endforeach
                        
                        @else
                            <figure>
                                    <a href="http://goo.gl/Qw3ND4" class="photostack-img"><img src="{{ $image['images']['low_resolution']['url'] }}" width="240" height="240"></a>
                                    <figcaption>
                                        <h2 class="photostack-title">{{ $image['caption']['text'] }}</h2>
                                    </figcaption>
                            </figure>
                        
                        @endif
                    @endforeach


                    
                    <figure data-dummy>
                        <a href="#" class="photostack-img"><img src="img/7.jpg" alt="img07"/></a>
                        <figcaption>
                            <h2 class="photostack-title">Lovely Green</h2>
                        </figcaption>
                    </figure>
                    <figure data-dummy>
                        <a href="#" class="photostack-img"><img src="img/8.jpg" alt="img08"/></a>
                        <figcaption>
                            <h2 class="photostack-title">Wonderful</h2>
                        </figcaption>
                    </figure>
                    <figure data-dummy>
                        <a href="#" class="photostack-img"><img src="img/9.jpg" alt="img09"/></a>
                        <figcaption>
                            <h2 class="photostack-title">Love Addict</h2>
                        </figcaption>
                    </figure>
                    <figure data-dummy>
                        <a href="#" class="photostack-img"><img src="img/10.jpg" alt="img10"/></a>
                        <figcaption>
                            <h2 class="photostack-title">Friendship</h2>
                        </figcaption>
                    </figure>
                    <figure data-dummy>
                        <a href="#" class="photostack-img"><img src="img/11.jpg" alt="img11"/></a>
                        <figcaption>
                            <h2 class="photostack-title">White Nights</h2>
                        </figcaption>
                    </figure>
                    <figure data-dummy>
                        <a href="#" class="photostack-img"><img src="img/12.jpg" alt="img12"/></a>
                        <figcaption>
                            <h2 class="photostack-title">Serendipity</h2>
                        </figcaption>
                    </figure>
                    <figure data-dummy>
                        <a href="#" class="photostack-img"><img src="img/13.jpg" alt="img13"/></a>
                        <figcaption>
                            <h2 class="photostack-title">Pure Soul</h2>
                        </figcaption>
                    </figure>
                    <figure data-dummy>
                        <a href="#" class="photostack-img"><img src="img/14.jpg" alt="img14"/></a>
                        <figcaption>
                            <h2 class="photostack-title">Winds of Peace</h2>
                        </figcaption>
                    </figure>
                    <figure data-dummy>
                        <a href="#" class="photostack-img"><img src="img/15.jpg" alt="img15"/></a>
                        <figcaption>
                            <h2 class="photostack-title">Shades of blue</h2>
                        </figcaption>
                    </figure>
                    <figure data-dummy>
                        <a href="#" class="photostack-img"><img src="img/16.jpg" alt="img16"/></a>
                        <figcaption>
                            <h2 class="photostack-title">Lightness</h2>
                        </figcaption>
                    </figure>

                
                </div>
            </section>


@endsection

@endif