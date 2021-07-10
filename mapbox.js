mapboxgl.accessToken = 'pk.eyJ1IjoidGhpZWYxMjMxOCIsImEiOiJja3B1azZkbW0xYnB5MnVxY3Fva3ZxN3liIn0.AtpmrQgGaofQmeNWyMTp2Q'


    navigator.geolocation.getCurrentPosition(successLocation, errorLocation, {
        enableHighAccuracy: true
    })

    function successLocation(position){
        console.log(position)
        setupMap([position.coords.longitude, position.coords.latitude])
    }

    function errorLocation(){
        setupMap([125.62407,7.09053])
    }

    function setupMap(center){

        const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: center,
        zoom: 13
        })

        var directions = new MapboxDirections({
          accessToken: mapboxgl.accessToken
        })


       map.addControl(new mapboxgl.NavigationControl(), 'bottom-right');
       map.addControl(directions, 'bottom-left')


       var marker = new mapboxgl.Marker()
        .setLngLat([125.62407,7.09053])
        .addTo(map)

    }
