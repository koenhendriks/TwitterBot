/**
 * Created by koen on 9/4/14.
 */
function ajaxSelect(self, script, params){
    $.ajax({
        url: WEBROOT+'/ajax/'+script,
        type: "POST",
        data: params
    }).done(function(data) {
        $.each(data, function( index, value ) {
            $('#'+index).val(value);
        });
    });
}

function twitterSearch(self, script, params){
    if($('.from-ajax').length > 0) {
        $('.from-ajax').fadeOut(400,function(){
            $('.tweet').remove();

        });
    }

    $('#search-progress').fadeIn();
    $.ajax({
        url: WEBROOT+'/ajax/'+script,
        type: "POST",
        data: params
    }).done(function(data) {
        $('#search-progress').fadeOut();
        $('#ajax-search-output').append(data);
        deleteMarkers();
        $( ".tweet" ).each(function( index ) {
            if($( this ).attr('data-location') !== undefined){

                var icon = $(this).attr('data-user-image');
                var title = $(this).attr('data-screen-name');
                var tweet = $(this).attr('data-tweet');
                var contentString = '<div id="content">'+
                    '<div id="siteNotice">'+
                    '</div>'+
                    '<h1 id="firstHeading" class="firstHeading">'+title+'</h1>'+
                    '<div id="bodyContent">'+
                    '<p>'+tweet+'</p>'+
                    '</div>'+
                    '</div>';

                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });

                var location =  $( this ).attr('data-location');
                location = location.split(',');

                var maplocation = new google.maps.LatLng(location[0], location[1]);
                addMarker(maplocation, icon, title, infowindow);


            }
        });
    });



}