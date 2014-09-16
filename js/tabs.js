/**
 * Created by koen on 9/16/14.
 */

$('.nav-tabs a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
    window.location.hash = $(this).attr('href');
});

$(window).ready(function(){
    if(window.location.hash != ''){
        $('a[href='+window.location.hash+']').tab('show');
    }
});