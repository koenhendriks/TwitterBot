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