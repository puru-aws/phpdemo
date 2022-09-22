<!DOCTYPE html>
<html lang="en"> 
<head>
  <meta charset="UTF-8">
  <title>@yield('head_title', getcong('site_name'))</title>
  <meta name="description" content="@yield('head_description', getcong('site_description'))">
    <meta property="keywords" content="@yield('head_keywords', getcong('site_keywords'))" />
    
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="@yield('head_title',  getcong('site_name'))"/>
    <meta property="og:description" content="@yield('head_description', getcong('site_description'))"/>
    
    <meta property="og:image" content="@yield('head_image', url('/upload/logo.png'))" />
    <meta property="og:url" content="@yield('head_url', url('/'))" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=no">
  <link href="https://fonts.googleapis.com/css?family=Scada:400,700|Open+Sans:400,300,700" rel="stylesheet" type="text/css">

  <!-- Fav and touch icons -->
  <link href="{{ URL::asset('upload/'.getcong('site_favicon')) }}" rel="shortcut icon" type="image/x-icon" />

    <link href="{{ URL::asset('site_assets/css/style.css') }}" rel="stylesheet" />
    <link id="main-style-file-css" rel="stylesheet" href="{{ URL::asset('site_assets/css/style_new.css') }}"/>
    <link href="{{ URL::asset('site_assets/css/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    
    @if(request()->segment('1')=='login' or request()->segment('1')=='register')
      
      <script src='https://www.google.com/recaptcha/api.js'></script>
    
    @endif

    <link rel="stylesheet" href="{{ URL::asset('site_assets/css/jquery-eu-cookie-law-popup.css') }}"> 

</head>
<body class="home-page-2 property-listing-page row-listing submit-property property-details not-found @if(request()->segment('1')=='user') agent-details-page @endif @if(request()->segment('1')=='agents') agents-page @endif">
	  
	  @include("_particles.header")

     
	  @yield("content")
	  
	   
	  @include("_particles.footer")
	  
    <div class="eupopup eupopup-bottom"></div>


    <!-- JS Include Section -->
  <script type="text/javascript" src="{{ URL::asset('site_assets/js/jquery-1.11.1.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('site_assets/js/helper.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('site_assets/js/select2.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('site_assets/js/ion.rangeSlider.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('site_assets/js/owl.carousel.min.js') }}"></script>

  <script src="{{ URL::asset('site_assets/js/jquery-eu-cookie-law-popup.js') }}"></script> 

  <!-- Map Js -->
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{getcong('google_map_key')}}&libraries=places"></script>
  <script type="text/javascript" src="{{ URL::asset('site_assets/js/infobox_packed.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('site_assets/js/richmarker-compiled.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('site_assets/js/markerclusterer_packed.js') }}"></script>
   <!-- END OF Map Js -->
   
   @if(classActivePathPublic('') AND getcong('home_properties_layout')=='map')
      @include("_particles.footer_map")
   @endif

  <script type="text/javascript" src="{{ URL::asset('site_assets/js/template.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('site_assets/js/bootstrap-tagsinput.js') }}"></script>
  <!-- End of JS Include Section -->


  <script type="text/javascript">
  
  $(document).ready( function() {
  if ($(".eupopup").length > 0) {
    $(document).euCookieLawPopup().init({
       'cookiePolicyUrl' : '{{stripslashes(getcong('gdpr_cookie_url'))}}',
       'buttonContinueTitle' : '{{trans('words.gdpr_continue')}}',
       'buttonLearnmoreTitle' : '{{trans('words.gdpr_learn_more')}}',
       'popupPosition' : 'bottom',
       'colorStyle' : 'default',
       'compactStyle' : false,
       'popupTitle' : '{{stripslashes(getcong('gdpr_cookie_title'))}}',
       'popupText' : '{{stripslashes(getcong('gdpr_cookie_text'))}}'
    });
  }
});
</script>

  
  @if(request()->segment('1')=='submit-property' or request()->segment('1')=='update-property') 
  <script type="text/javascript">
    function initialize() {

       
      @if(isset($property->id) AND isset($property->map_latitude) AND isset($property->map_longitude))
        var myLatLng = new google.maps.LatLng({{ $property->map_latitude }}, {{ $property->map_longitude }});
      
      @else
      
        var myLatLng = new google.maps.LatLng(51.509865, -0.118092);
      
      @endif
       
      var mapOptions = {
        zoom: 12,
        center: myLatLng,
        // This is where you would paste any style found on Snazzy Maps.
        styles: [{featureType:"landscape",stylers:[{saturation:-100},{lightness:65},{visibility:"on"}]},{featureType:"poi",stylers:[{saturation:-100},{lightness:51},{visibility:"simplified"}]},{featureType:"road.highway",stylers:[{saturation:-100},{visibility:"simplified"}]},{featureType:"road.arterial",stylers:[{saturation:-100},{lightness:30},{visibility:"on"}]},{featureType:"road.local",stylers:[{saturation:-100},{lightness:40},{visibility:"on"}]},{featureType:"transit",stylers:[{saturation:-100},{visibility:"simplified"}]},{featureType:"administrative.province",stylers:[{visibility:"off"}]},{featureType:"administrative.locality",stylers:[{visibility:"off"}]},{featureType:"administrative.neighborhood",stylers:[{visibility:"on"}]},{featureType:"water",elementType:"labels",stylers:[{visibility:"off"},{lightness:-25},{saturation:-100}]},{featureType:"water",elementType:"geometry",stylers:[{hue:"#ffff00"},{lightness:-25},{saturation:-97}]}],

        // Extra options
        mapTypeControl: false,
        panControl: false,
        zoomControlOptions: {
          style: google.maps.ZoomControlStyle.SMALL,
          position: google.maps.ControlPosition.LEFT_BOTTOM
        }
      };
      var map = new google.maps.Map(document.getElementById('p-map'), mapOptions);
      var image = '{{ URL::asset("site_assets/img/marker-1.png") }}';

      var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        draggable: true,
        icon: image
      });
      if (jQuery('#p-address').length > 0) {
        var input = document.getElementById('p-address');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
          var place = autocomplete.getPlace();
          jQuery('#p-lat').val(place.geometry.location.lat());
          jQuery('#p-long').val(place.geometry.location.lng());
          marker.setPosition(place.geometry.location);
          map.setCenter(place.geometry.location);
          map.setZoom(15);
        });
      }
      google.maps.event.addListener(marker, 'dragend', function (event) {
        jQuery('#p-lat').val(event.latLng.lat());
        jQuery('#p-long').val(event.latLng.lng());
      });
    }


    google.maps.event.addDomListener(window, 'load', initialize);
  
  </script>
  @endif

  @if(Request::is('properties/*') AND isset($property->id) AND isset($property->map_latitude) AND isset($property->map_longitude))
  <script type="text/javascript">
    function initialize() {
      
      @if(isset($property->id) AND isset($property->map_latitude) AND isset($property->map_longitude))
        var myLatLng = new google.maps.LatLng({{ $property->map_latitude }}, {{ $property->map_longitude }});
       
      @endif

      var mapOptions = {
        zoom: 12,
        center: myLatLng,
        // This is where you would paste any style found on Snazzy Maps.
        styles: [{featureType:"landscape",stylers:[{saturation:-100},{lightness:65},{visibility:"on"}]},{featureType:"poi",stylers:[{saturation:-100},{lightness:51},{visibility:"simplified"}]},{featureType:"road.highway",stylers:[{saturation:-100},{visibility:"simplified"}]},{featureType:"road.arterial",stylers:[{saturation:-100},{lightness:30},{visibility:"on"}]},{featureType:"road.local",stylers:[{saturation:-100},{lightness:40},{visibility:"on"}]},{featureType:"transit",stylers:[{saturation:-100},{visibility:"simplified"}]},{featureType:"administrative.province",stylers:[{visibility:"off"}]},{featureType:"administrative.locality",stylers:[{visibility:"off"}]},{featureType:"administrative.neighborhood",stylers:[{visibility:"on"}]},{featureType:"water",elementType:"labels",stylers:[{visibility:"off"},{lightness:-25},{saturation:-100}]},{featureType:"water",elementType:"geometry",stylers:[{hue:"#ffff00"},{lightness:-25},{saturation:-97}]}],

        // Extra options
        scrollwheel: false,
        mapTypeControl: false,
        panControl: false,
        zoomControlOptions: {
          style   : google.maps.ZoomControlStyle.SMALL,
          position: google.maps.ControlPosition.LEFT_BOTTOM
        }
      }
      var map = new google.maps.Map(document.getElementById('property-details-map'),mapOptions);

      var image = '{{ URL::asset("site_assets/img/marker.png") }}';

      var beachMarker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: image
      });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
  </script>
  @endif

<script type="text/javascript">
var abc = 0;
//function increment() {
    
//};
$(document).ready(function() {
    $('#add_more').click(function() {//When Add More Files button Clicked these function Willbe Called (new file field is added dynamically)
        $(this).before($("<div/>", {id: 'filediv'}).fadeIn('slow').append(
                $("<input/>", {name: 'gallery_file[]', type: 'file', id: 'file'}),        
                $("")
                ));
    });

$('body').on('change', '#file', function(){
            if (this.files && this.files[0]) {
                //increment();
                abc += 1;
                var z = abc - 1;
                var x = $(this).parent().find('#previewimg' + z).remove();
                $(this).before("<div id='abcd"+ abc +"' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
                $(this).hide();
                $("#abcd"+ abc).append($("<img/>", {id: 'img', src: '{{ URL::asset('site_assets/img/x.png') }}', alt: 'delete'}).click(function() {
                //$(this).parent().parent().remove();
                $(this).parent().remove();
                }));
            }
        });
        
    function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
    };

    $('#upload').click(function(e) {
        var name = $(":file").val();
        if (!name)
        {
            alert("First Image Must Be Selected");
            e.preventDefault();
        }
    });
});
  

@if(request()->segment('1')!='update-property' AND request()->segment('1')!='submit-property')

 $(document).on('change',function(){$("#interest").val($("#interest").val().replace(/,/g,'.'));});function mortgageCalc(){var amount=parseFloat($("#amount").val().replace(/[^0-9\.]+/g,"")),months=parseFloat($("#years").val().replace(/[^0-9\.]+/g,"")*12),down=parseFloat($("#downpayment").val().replace(/[^0-9\.]+/g,"")),annInterest=parseFloat($("#interest").val().replace(/[^0-9\.]+/g,"")),monInt=annInterest/1200,calculation=((monInt+ monInt/(Math.pow(1+ monInt,months)- 1))*(amount-(down||0))).toFixed(2);if(calculation>0){$(".calc-output-container").css({'opacity':'1','max-height':'200px'});$(".calc-output").hide().html(calculation+' '+ $('.mortgageCalc').attr("data-calc-currency")).fadeIn(300);}}
$('.calc-button').on('click',function(){mortgageCalc();});if("ontouchstart"in window){document.documentElement.className=document.documentElement.className+" touch";}
if(!$("html").hasClass("touch")){$(".parallax").css("background-attachment","fixed");}

@endif

</script>

@if(request()->segment('1')=='contact-us')
<script type="text/javascript">
    function initialize() {
      var myLatLng = new google.maps.LatLng({{getcong('contact_lat')}}, {{getcong('contact_long')}});
      var mapOptions = {
        zoom: 16,
        center: myLatLng,
        // This is where you would paste any style found on Snazzy Maps.
        styles: [{featureType:"landscape",stylers:[{saturation:-100},{lightness:65},{visibility:"on"}]},{featureType:"poi",stylers:[{saturation:-100},{lightness:51},{visibility:"simplified"}]},{featureType:"road.highway",stylers:[{saturation:-100},{visibility:"simplified"}]},{featureType:"road.arterial",stylers:[{saturation:-100},{lightness:30},{visibility:"on"}]},{featureType:"road.local",stylers:[{saturation:-100},{lightness:40},{visibility:"on"}]},{featureType:"transit",stylers:[{saturation:-100},{visibility:"simplified"}]},{featureType:"administrative.province",stylers:[{visibility:"off"}]},{featureType:"administrative.locality",stylers:[{visibility:"off"}]},{featureType:"administrative.neighborhood",stylers:[{visibility:"on"}]},{featureType:"water",elementType:"labels",stylers:[{visibility:"off"},{lightness:-25},{saturation:-100}]},{featureType:"water",elementType:"geometry",stylers:[{hue:"#ffff00"},{lightness:-25},{saturation:-97}]}],

        // Extra options
        scrollwheel: false,
        mapTypeControl: false,
        panControl: false,
        zoomControlOptions: {
          style   : google.maps.ZoomControlStyle.SMALL,
          position: google.maps.ControlPosition.LEFT_BOTTOM
        }
      }
      var map = new google.maps.Map(document.getElementById('contact-map'),mapOptions);

      var image = '{{ URL::asset("site_assets/img/marker.png") }}';

      var beachMarker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: image
      });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
  </script>
@endif

<script type="text/javascript">
  
</script>

</body>
 
</html>