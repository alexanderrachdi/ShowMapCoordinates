To start the project you need to run the Simfony server with the command:
symfony server:start
Then open the application at:
http://localhost:8000/

                FOR Symfony only project
Open http://localhost:8000/app_geolocation
1. I started developing application as a symfony project first:
in /src I have FrontController communicating with twig template leaflet.html.twig files. From controller we can easily
choose the map providers by changing them in constructor: OpenMapClient / GoogleMapClient.
They implements same interface MapAddressInterface witch make switch them or mix them very easily. And code will easily expandable
this way. In client classes get the requested address and fetch coordinates from API services.Make response for the front-end witch in
this case is symfony twig template with show it on the client's map. We have submit form in view to create requests.

Open http://localhost:8000/app_geolocation
2. The second implementation is using Symfony back end as API from React front end. I installed React JS into symfony project.
Create API route in /config/routes.yaml witch leads to FrontController and after to service client controller to fetch coordinates.
And return request to the React app. We show the coordinates on the page in React app. I'm using leaflet map.

3. Create PHPUnit test in /test folder
I use mockHttpClient who return actual responses witch I generate before that to optimize the speed for requests.

4. After that I create all task only on React js with requests to OpenStreetMap provider directly with autocomplete and etc.

The task took me about 12h, lot of them on react app because I haven't work with Ract, Vue and Angular and that was new for me.
Have some js css issues with OpenStreetMap component for React, the card shows partially, but finally I handle it.

For the work environment things are much complicated of course but for testing task I think it's enough.

PS:
For google client the api key work only for geocoding so I made only that part fetching coordinates. When I try to
render the map with given key - shows me that I have to enable some api's from account that I dont have, so proceed with
OpenStreetMap, but the logic is exact the same.