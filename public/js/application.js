$(function() {

    //Set-up options to retrieve coordinates from onery/geolocator plugin.
    //link to plugin script MUST be include BEFORE this script file.
    geolocator.config({
        language: "en",
        google: {
            version: "3",
            key: "AIzaSyAmWSqkBqc_7UeK9EtLXmuSPLRK7UCf2gI"
        }
    });

    function displayWeatherWidget() {
        $.get(url + "home/getlocation", function(data, status){
            console.log(data);

            if (!data) {
                displayWeatherForCurrentLocation();
            } else {
                displayWeatherForUserLocation(data);
            }
        });
    }

    function displayWeatherForCurrentLocation() {

        var options = {
            enableHighAccuracy: true,
            timeout: 2000,
            maximumWait: 2000,     // max wait time for desired accuracy
            maximumAge: 0,          // disable cache
            desiredAccuracy: 30,    // meters
            fallbackToIP: true,     // fallback to IP if Geolocation fails or rejected
            addressLookup: false,    // requires Google API key if true
            timezone: false,         // requires Google API key if true
            map: null,      // interactive map element id (or options object)
            staticMap: false        // map image URL (boolean or options object)
        };

        //Use onury/geolocator plugin to obtain current user's coordinates.
        geolocator.locate(options, function (err, location) {
            if (err) return console.log(err);

            //Set lat/long coordinates from geolocator-returned data.
            var coords = {
                latitude: location.coords.latitude,
                longitude: location.coords.longitude
            };

            getWeatherData(coords)
        });
    }

    function displayWeatherForUserLocation(userLocation) {
       
        var options = {
            address: userLocation,
            map: null,      // interactive map element id (or options object)
            staticMap: false        // map image URL (boolean or options object)
        };

        geolocator.geocode(options, function (err, location) {
            if (err) return console.log(err);

            //Set lat/long coordinates from geolocator-returned data.
            var coords = {
                latitude: location.coords.latitude,
                longitude: location.coords.longitude
            };

            getWeatherData(coords)
        });
    }


    function getWeatherData(coords) {
        //Obtain the city,region,country using onury/geolocator
        //reverse-geocode functionality.
        geolocator.reverseGeocode(coords, function (err, location) {

            //Declare, initialise, set variable for city,region,country.
            var cityRegionCountry = location.address.city + "," + location.address.region + "," + location.address.countryCode;

            //Finally, use OpenWeather plugin to obtain weather data.
            $('.weather-temperature').openWeather({
                key: 'f33ba4d8b64c56769203399c3c5766ce',
                units: 'metric',
                lang: 'en',
                city: cityRegionCountry,
                placeTarget: '.weather-place',
                descriptionTarget: '.weather-description',
                minTemperatureTarget: '.weather-min-temperature',
                maxTemperatureTarget: '.weather-max-temperature',
                windSpeedTarget: '.weather-wind-speed',
                windSpeedUnit: 'Kph',
                windDirectionUnit: 'compass',
                clickConvertWindSpeed: true,
                clickConvertTemperature: true,
                clickConvertWindDirection: true,
                windDirectionTarget: '.weather-wind-direction',
                humidityTarget: '.weather-humidity',
                sunriseTarget: '.weather-sunrise',
                sunsetTarget: '.weather-sunset',
                iconTarget: '.weather-icon',
                customIcons: 'public/js/plugins/open-weather/icons/weather/',
                customBackgroundImages: 'public/js/plugins/open-weather/images/weather/backgrounds/',
                lat: coords.latitude != null ? coords.latitude : null,
                lng: coords.longitude != null ? coords.longitude : null,
                timeLastUpdatedTarget: '.weather-time-last-updated',
                success: function() {

                    $('.weather-wrapper').show();
                },
                error: function(message) {
                    console.log(message);
                }
            });
        });
    }

    if (top.location.pathname === '/weather') {
        displayWeatherWidget();
    }

});
