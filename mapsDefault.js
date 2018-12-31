 // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
 // Sumber :
 // https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete-directions
 // http://findnerd.com/list/view/Calculate-distance-between-two-addresses--points--locations-using-Google-map-API-/26285/

      var infoWindow;
      function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
          mapTypeControl: false,
          center: {lat: -6.232934, lng: 107.086914},
          animation: google.maps.Animation.BOUNCE,
          zoom: 13,

        });
        var trafficLayer = new google.maps.TrafficLayer();
        trafficLayer.setMap(map);
        var bikeLayer = new google.maps.BicyclingLayer();
        bikeLayer.setMap(map);
        new AutocompleteDirectionsHandler(map);

        $('#gunakanlokasi').click(function(){
          infoWindow = new google.maps.InfoWindow;
            // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            var marker = new google.maps.Marker({
                  position: pos,
                  map: map,
                  draggable:true,
                  title: "Anda Disini"
              });
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
 
        });

    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
       /**
        * @constructor
       */
      function AutocompleteDirectionsHandler(map) {
        this.map = map;
        this.originPlaceId = null;
        this.destinationPlaceId = null;
        this.travelMode = 'DRIVING';
        var originInput = document.getElementById('asal');
        var destinationInput = document.getElementById('tujuan');
        var modeSelector = document.getElementById('mode-selector');
        this.directionsService = new google.maps.DirectionsService;
        this.directionsDisplay = new google.maps.DirectionsRenderer;
        //this.directionsDisplay.draggable = true;
        this.directionsDisplay.setMap(map);

        var originAutocomplete = new google.maps.places.Autocomplete(
            originInput, {placeIdOnly: true});
        var destinationAutocomplete = new google.maps.places.Autocomplete(
            destinationInput, {placeIdOnly: true});

        this.setupClickListener('changemode-walking', 'WALKING');
        this.setupClickListener('changemode-transit', 'TRANSIT');
        this.setupClickListener('changemode-driving', 'DRIVING');

        this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
        this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');

        //this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(asal);
        //this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(tujuan);
        this.map.controls[google.maps.ControlPosition.TOP_RIGHT].push(modeSelector);
        this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(gunakanlokasi);
      }

      // Sets a listener on a radio button to change the filter type on Places
      // Autocomplete.
      AutocompleteDirectionsHandler.prototype.setupClickListener = function(id, mode) {
        var radioButton = document.getElementById(id);
        var me = this;
        radioButton.addEventListener('click', function() {
          me.travelMode = mode;
          me.route();
        });
      };

      AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(autocomplete, mode) {
        var me = this;
        autocomplete.bindTo('bounds', this.map);
        autocomplete.addListener('place_changed', function() {
          var place = autocomplete.getPlace();
          if (!place.place_id) {
            window.alert("Please select an option from the dropdown list.");
            return;
          }
          if (mode === 'ORIG') {
            me.originPlaceId = place.place_id;
          } else {
            me.destinationPlaceId = place.place_id;
          }
          me.route();
        });

      };

      AutocompleteDirectionsHandler.prototype.route = function() {
        if (!this.originPlaceId || !this.destinationPlaceId) {
          return;
        }
        var me = this;

        this.directionsService.route({
          origin: {'placeId': this.originPlaceId},
          destination: {'placeId': this.destinationPlaceId},
          travelMode: this.travelMode
        }, function(response, status) {
          if (status === 'OK') {
            me.directionsDisplay.setDirections(response);
            var service = new google.maps.DistanceMatrixService();
    service.getDistanceMatrix({
        origins: [document.getElementById("asal").value],
        destinations: [document.getElementById("tujuan").value],
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC,
        avoidHighways: false,
        avoidTolls: true
    }, function (response, status) {
        if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS") {
            var distance = response.rows[0].elements[0].distance.text;
            var duration = response.rows[0].elements[0].duration.text;
            var dvDistance = document.getElementById("distance");
           dvDistance.value = "";
           $( "#distance" ).prop( "readonly", true );
           $("#billing").prop("readonly",true);
            dvDistance.value += distance + "dan" + "Waktu Tempuh" +duration;
            //dvDistance.innerHTML += "Duration:" + duration;
             var str = distance;
          var distance1 = str.replace(' km', '');
          var distance2 = distance1.replace(',','.');
          var d = new Date();
          /*          
          
          /*          
            jumlah kilometer dikalikan dengan 1700 di jam non sibuk, 2000 jam sibuk, dan argo diatas 100 km dikalikan 6000
            setelah itu hasilnya kita konversikan kedalam format kurs rupiah
          */
          if (distance2 >=0 && distance2<= 5){
            var tarif =  formatNumber(8000);  
          document.getElementById("billing").value = tarif;

          }
          else if (distance2 <= 100,0){
            var tarif =  formatNumber(distance2*6000);  
          document.getElementById("billing").value = tarif;

          }
          else if(d.getHours()>=6 && d.getHours()<= 9){
            var tarif =  formatNumber(distance2 * 2000); 
          document.getElementById("billing").value = tarif;

          }
          else if(d.getHours()>=16 && d.getHours()<= 20){
            var tarif = formatNumber(distance2 * 2000); 
          document.getElementById("billing").value = tarif;

          }
          else{
          var tarif = formatNumber(distance2 * 1700); 
          document.getElementById("billing").value = tarif;
        }
          
        } else {
            alert("Unable to find the distance via road.");
        }
    });
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      };

      /*      
    menghitung jarak dari data yg dikirim dari form
    disini saya setting untuk mode DRIVING dan menggunakan jalan raya atau juga tol,
    jika ingin mengganti rute yang ingin dilewatkan silahkan konfigurasi di bagian avoidHighways dan avoidTolls dengan pilihan true yaitu ingin menghindari 
    dan false tidak menghindari
    */
      
      // fungsi sederhana untuk mengkonversi bilangan bulat menjadi format kurs rupiah
    function formatNumber (angka) {
      var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
    return rupiah.split('',rupiah.length-1).reverse().join('');
    }

