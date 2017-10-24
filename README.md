# tickets
A Ticketing System - In  Progress

The project is built in the Laravel Framework.

Visitors can view the entire website, scroll and look threw various events and their tickets.
Users can be logged in with the Facebook API. Once logged in they can buy tickets to various events. 
Payments will be executed with Mollie (currently in testmode).

Shortcut to some PHP code: https://github.com/dianchelo/tickets/tree/master/app/Http/Controllers
Shortcut to some Templating: https://github.com/dianchelo/tickets/blob/master/resources/views/tickets/single.blade.php
Shortcut to some Javascript/JQuery: https://github.com/dianchelo/tickets/blob/master/public/js/eventHandlers.js


Things is progress : 

- Add price when creating a event and generating tickets
- Remove unneccessary url add-ons when login in using FB
- Set all text messages to english or dutch!
- Display purchased tickets in user profile
- Display users tickets for sale in user profile
- Pagination on Tags/Categories pages
- Render view after AJAX request in JS
- Change event urls from id to slug
- Make a PublicEventController and seperate users view with admin view
