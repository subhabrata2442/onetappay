/* 
* GMap V3 Geocoding 
* @author : Bikash Shrestha Desar
* 2012
*/
var path = window.location.pathname;
        var base_url;
        if (path.replace('gorun/', '') != path) {
            base_url = 'http://localhost/gorun/';
        } else {
            var base_url = 'https://gorun.co.za/';
            }
var geocoder = new google.maps.Geocoder();
  var map;
  var marker;
   var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'long_name',
        country: 'long_name',
        postal_code: 'short_name'

      };
   var place;

  var image = new google.maps.MarkerImage(
                base_url+'images/map_pin.png'
              );
            
    var shadow = new google.maps.MarkerImage(
                base_url+'images/shadow.png',
                new google.maps.Size(52,40),
                new google.maps.Point(0,0),
                new google.maps.Point(14,40)
              );
  function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos,
    componentRestrictions: {
            country: 'ZA',
            
          }
    }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
    }
  });
}

function updateMarkerPosition(latlng) {
    document.getElementById('Company_latitude').value=latlng.lat();
    document.getElementById('Company_longitude').value=latlng.lng();
}

function updateMarkerAddress(str) {
  document.getElementById('formattedAddress').value = str;
}


  function initialize() {
    var lat_value=document.getElementById('Company_latitude').value; 
    var long_value=document.getElementById('Company_longitude').value;
    //set latlang to Johannesburg, South Africa initially
    if(lat_value=='0' || lat_value=="" )
    {
         lat_value=-26.2041028;
    }
    if(long_value=='0' || long_value=='')
    {
         long_value=28.047305100000017;
    }
    var latlng = new google.maps.LatLng(lat_value, long_value);
    var myOptions = {
      zoom: 14,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    marker = new google.maps.Marker({
    position: latlng,
    title: 'Johannesburg, South Africa',
    map: map,
    draggable: true,
    icon: image,
    //shadow: shadow,
  });
   // Update current position info.
  //updateMarkerPosition(latlng);
  geocodePosition(latlng);
	// Add dragging event listeners.
   

  initMap();  
  }

  function codeAddress() {
    var address="";
    if(document.getElementById("Company_street_add").value!="")
    {
        address+=document.getElementById("Company_street_add").value;
        address+=', ';
    }
    if(document.getElementById("city").value!="")
    {
        address+=document.getElementById("city").value;
         address+=', ';
    }
    province=$("#Company_province option:selected").text();
        
    address+=province+', South Africa';
    geocoder.geocode( { 'address': address,'region':'ZA','partialmatch': true}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK && results.length > 0) {
        if(marker != null)
        marker.setMap(null);//clear the previous marker from the map
        latlng=results[0].geometry.location;
        map.setCenter(latlng);
            // Update current position info.
          updateMarkerPosition(latlng);
          geocodePosition(latlng);
            marker = new google.maps.Marker({
            map: map,
			draggable: true,
            position: results[0].geometry.location,
            icon: image,
            //shadow: shadow,
        });
        	// Add dragging event listeners.
 
  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerPosition(marker.getPosition());
  });
 
  google.maps.event.addListener(marker, 'dragend', function() {
    geocodePosition(marker.getPosition());
  });
      } else {
        alert("Geocode could not locate the address. Please recheck your input again!" );
      }
    });
  }
  
  function updateMapPinPosition()
  {
     marker.setMap(null);//clear the previous marker from the map
     google.maps.Map.prototype.clearOverlays = function() {
      for (var i = 0; i < markersArray.length; i++ ) {
        markersArray[i].setMap(null);
      }
      markersArray.length = 0;
    }
     var latlng=new google.maps.LatLng(document.getElementById('Company_latitude').value,document.getElementById('Company_longitude').value);
      map.setCenter(latlng);
     marker = new google.maps.Marker({
            map: map,
			draggable: true,
            position: latlng,
            icon: image,
            //shadow: shadow,
        });
        google.maps.event.addListener(marker, 'drag', function() {
        updateMarkerPosition(marker.getPosition());
      });
     
      google.maps.event.addListener(marker, 'dragend', function() {
        geocodePosition(marker.getPosition());
      });
  }
  function initMap() {
       

        var input = /** @type {!HTMLInputElement} */(
            document.getElementById('Company_street_add'));

        var types = document.getElementById('type-selector');
       // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        autocomplete.setComponentRestrictions({'country': 'za'});

        var infowindow = new google.maps.InfoWindow();
        
       

        autocomplete.addListener('place_changed', function() {
          infowindow.close();
         
          marker.setVisible(false);
          place = autocomplete.getPlace();
          updateMarkerPosition(place.geometry.location)
         
           if(marker != null)
            marker.setMap(null);
          marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location,
          draggable: true,
          icon: image,

        });
          if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          /*marker.setIcon(({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
              })
          );*/
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);
          

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }
           
          infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
          //document.getElementById('city').value = place.address_components[3].long_name;
          infowindow.open(map, marker);
          fillInAddress();
        });
          google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerPosition(marker.getPosition());
  });
 
  google.maps.event.addListener(marker, 'dragend', function() {
    geocodePosition(marker.getPosition());
  });
        
        //autocomplete.addListener('place_changed', );


        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        /*
        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);*/
      }
function fillInAddress() {
        // Get the place details from the autocomplete object.
        //var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }
        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            
            var val = place.address_components[i][componentForm[addressType]];
            if(addressType=='locality')
            {
                document.getElementById('city').value = val;
            }
            if(addressType == 'administrative_area_level_1')
            {
                 var selectTag = document.getElementById("Company_province");
                 //console.log(place);
                  for (var i = 0; i < selectTag.options.length; i++) {
            
                        var optionTag = selectTag.options[i];
                        //alert(optionTag.text+':'+place.state);
                        if (optionTag.text== val) {
                            selectTag.options[i].selected= true;
                           continue;
                        }
                    }
            }
            document.getElementById(addressType).value = val;
          }
        }
        document.getElementById('Company_street_add').value= place.name;
        
        updateMapPinPosition(); 
      }

  
    