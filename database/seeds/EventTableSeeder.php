<?php

use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $event = new \App\Event([
        	'name' => 'Latin Village', 
        	'slug' => 'latin-village', 
        	'category_id' => '1',
            'amount_tickets' => '50',  
        	'hash' => hash('ripemd160', preg_replace('/[^A-Za-z0-9\-]/', '', 'latin-village')), 
        	'description' => '
Met meer dan 11 prachtige stages varierend van Salsa, Kizomba, Latinhouse, Moombathon, eclectic beats en te gekke live optredens van grote Latin artiesten wordt dit een editie om niet te vergeten!

LatinVillage is één grote familie en we zien je graag terug! Zet 20 Augustus groot in je agenda, want je wil LatinVillage niet missen!

Love,

LatinVillage Family', 
        	'event_date' => '2020-08-20 20:00:00', 
        	'location_id' => '1', 
        	'event_colour' => 'f45942', 
        	'creator' => '127.0.0.1', 
        	'dark_event_colour' => 'bc4432'
        ]);
        $event->save();

                $event = new \App\Event([
        	'name' => 'Tomorrowland', 
        	'slug' => 'tomorrowland', 
        	'category_id' => '2', 
            'amount_tickets' => '50',  
        	'hash' => hash('ripemd160', preg_replace('/[^A-Za-z0-9\-]/', '', 'tomorrowland')), 
        	'description' => 'The dates of TomorrowLand 2017 run from Friday, July 21th through Sunday, July 30th in Boom, Belgium. The event includes the most impressive lineup of electronic music acts performing on 15 stages.

What is TomorrowLand?


Founded in 2005, TomorrowLand is a major electronic music festival held during the final weekend of July every year in Brussels, Belgium. It is so major that it is actually the biggest electronic music festival in the world. Currently, it is managed by a team made up of the original founders along with ID&T, a Dutch entertainment company. Typically, TomorrowLand is said to be held in Brussels but it is actually held in a small town called Boom, which is just south of Antwerp and a little north of Brussels. 
The number of people attending TomorrowLand has increased from 50,000+ to over 400,000+ attendees in 2014, which was held over two consecutive weekends in July. Some of the most notable acts to perform at the festival include Armin van Buuren, Axwell, David Guetta, Swedish House Mafia, Avicii, Tiesto, Paidback Luke, Hardwell, Afrojack, Steve Aoki, Chuckie, Fatboy Slim, Skrillex and Pendulum. Some other fun facts regarding TorromowLand Music Festival include people from 214 nations attend the festival each year, Brussels Airlines has to schedule 140+ additional flights from 67 cities to transport the festival attendees, and the festival itself boasts the tallest ferris wheel in Europe. 


Founded in 2005, TomorrowLand is a major electronic music festival held during the final weekend of July every year in Brussels, Belgium. It is so major that it is actually the biggest electronic music festival in the world. Currently, it is managed by a team made up of the original founders along with ID&T, a Dutch entertainment company. Typically, TomorrowLand is said to be held in Brussels but it is actually held in a small town called Boom, which is just south of Antwerp and a little north of Brussels. 
The number of people attending TomorrowLand has increased from 50,000+ to over 400,000+ attendees in 2014, which was held over two consecutive weekends in July. Some of the most notable acts to perform at the festival include Armin van Buuren, Axwell, David Guetta, Swedish House Mafia, Avicii, Tiesto, Paidback Luke, Hardwell, Afrojack, Steve Aoki, Chuckie, Fatboy Slim, Skrillex and Pendulum. Some other fun facts regarding TorromowLand Music Festival include people from 214 nations attend the festival each year, Brussels Airlines has to schedule 140+ additional flights from 67 cities to transport the festival attendees, and the festival itself boasts the tallest ferris wheel in Europe.', 
        	'event_date' => '2020-10-10 20:00:00', 
        	'location_id' => '2', 
        	'event_colour' => 'c37cea', 
        	'creator' => '127.0.0.1', 
        	'dark_event_colour' => '8b32bc'
        ]);
        $event->save();

                $event = new \App\Event([
        	'name' => 'Soranje', 
        	'slug' => 's-oranje', 
        	'category_id' => '3', 
            'amount_tickets' => '50',  
        	'hash' => hash('ripemd160', preg_replace('/[^A-Za-z0-9\-]/', '', 's-oranje')), 
        	'description' => '☆☆☆ S\'ORANJE \'KINGSDAY\' FESTIVAL 2017 ☆☆☆

Na tien uitverkochte edities pakken we deze Koningsdag extra groot uit! Met drie dikke stages, de beste dj’s, kleurrijk entertainment en de lekkerste beats zal Rotterdam en omgeving op zijn grondvesten trillen.

We zijn trots op het feit dat niemand minder dan AFROJACK de grote headliner is in zijn geliefde thuisbasis Rotterdam. Hij zal ondersteund worden door onder andere Quintino, Benny Rodrigues, Gregor Salto en aanstormend talent Ravitez.

Maar we hebben meer! Urban, hiphop, classics, r&b en latin... Met veel internationaal succes voor nationale urban artiesten kan een Eclectic stage dus eigenlijk niet ontbreken in 2017. Wat hebben we voor jou in petto? Je kan de heupen laten bewegen op de lekkerste live-acts van dit moment, wat te denken van Jairzinho, Gio, Equalz en Angelo King? Deze live optredens zullen heerlijk gemixt worden door oa. Irwan, Superior, Don James, Wessel S en Suspect!

Krijg jij al zin in 1 van de meest speciale dagen van het jaar? We kunnen het ons voorstellen! Wacht niet te lang met beslissen en join S’Oranje tijdens deze knallende Kings Day. De ticketverkoop is inmiddels begonnen en kaarten zijn in de voorverkoop verkrijgbaar via www.soranjefestival.nl. 

De minimumleeftijd voor het S\'Oranje Festival 2017 is 18 jaar en het evenement duurt van 12.00 tot 23:00 uur. 
Locatie: PLEIN 1940, Rotterdam', 
        	'event_date' => '2020-04-05 12:00:00', 
        	'location_id' => '3', 
        	'event_colour' => 'efc05b', 
        	'creator' => '127.0.0.1', 
        	'dark_event_colour' => 'fcb825'
        ]);
        $event->save();

                $event = new \App\Event([
        	'name' => 'Encore Festival', 
        	'slug' => 'encore-festival', 
        	'category_id' => '4', 
            'amount_tickets' => '50',  
        	'hash' => hash('ripemd160', preg_replace('/[^A-Za-z0-9\-]/', '', 'encore-festival')), 
        	'description' => 'After 3 sold-out editions, Encore is back on the NDSM-warf in Amsterdam! 4 stages with : Migos, Tory Lanez, Maleek Berry, Jonna Fraser and many more.', 
        	'event_date' => '2020-10-28 13:00:00', 
        	'location_id' => '4', 
        	'event_colour' => '25fc94', 
        	'creator' => '127.0.0.1', 
        	'dark_event_colour' => '1abf6f'
        ]);
        $event->save();

                $event = new \App\Event([
        	'name' => 'WooHah', 
        	'slug' => 'woohah', 
        	'category_id' => '5', 
            'amount_tickets' => '50',  
        	'hash' => hash('ripemd160', preg_replace('/[^A-Za-z0-9\-]/', '', 'woohah')), 
        	'description' => 'WOO HAH! We back! This year WOO HAH! takes place on Friday June 30 and Saturday July 1. On both days the festival will start at 13.30 and end at 01.00. 

WOO HAH! festival 2017 is:

TRAVIS SCOTT · BRYSON TILLER · NAS · GUCCI MANE · G-EAZY · MAC MILLER · RAE SREMMURD · FRENCH MONTANA · STORMZY · POST MALONE · MHD · HOPSIN · PLAYBOI CARTI · LIL DICKY · ONEMAN · FLATBUSH ZOMBIES · YOUNG M.A · FREDDIE GIBBS · PRINCESS NOKIA · CLAMS CASINO · TROYBOI · FRESKU · MOCROMANIAC · BRAZ · PIETJU BELL · WOENZELAAR · KILLER KAMAL · KEMPI · JONNA FRASER · $UICIDEBOY$ · GRANDTHEFT · HUCCI · COELY · AJ TRACEY · IVY LAB ·BENJI B · 67 · HILLTOP HOODS · TASHA THE AMAZON · JARREAU VANDAL · GRAVEZ · YUNG INTERNET · YUNG NNELG · RAY FUEGO · KEVIN · JOSYLVIO · HANNAH FAITH · NICK HOOK · ROMÉO ELVIS & LE MOTEL · ANBU · SIROJ · VIC CREZÉE · ILIASSOPDEBEAT · KRINGILI & ALEX MEGAS · ARISTOTELES MENDES · PAQUITO MONIZ · ODIN 

This year we will have a bigger terrain with an extra mainstage and more facilities, we will also increase the capacity of our camping grounds. 

For the latest information + Tickets check www.woohahfestival.com', 
        	'event_date' => '2020-07-15 11:00:00', 
        	'location_id' => '5', 
        	'event_colour' => '7291e0', 
        	'creator' => '127.0.0.1', 
        	'dark_event_colour' => '4d6bb7'
        ]);
        $event->save();
    }
}
