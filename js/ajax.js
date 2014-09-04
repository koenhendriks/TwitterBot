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
    $('.from-ajax').fadeOut();
    $('#search-progress').fadeIn();
    console.log(params);
    $.ajax({
        url: WEBROOT+'/ajax/'+script,
        type: "POST",
        data: params
    }).done(function(data) {
        $('#search-progress').fadeOut();
        $('#ajax-search-output').append(data);
    });
}