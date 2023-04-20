$(document).ready(function(){
    $('#demo_opt_1').click(function(){
        checkIt();
    });
});

function checkIt(){
    if ($('#demo_opt_1:checked').val() == "on"){
        $('#hidden').css({'display':'block'});
    } else {
        $('#hidden').css({'display':'none'});
    }
}