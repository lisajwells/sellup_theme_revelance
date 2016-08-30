jQuery(document).ready(function($) {
    $("#home-carusel .dnd_column_dd_span6:first-child .dnd-animo").hide();
    $("#home-carusel .dnd_column_dd_span6:first-child .dnd-animo").eq(0).show().addClass("on");

    setInterval(function(){
        var curr_on = $("#home-carusel .dnd_column_dd_span6:first-child .dnd-animo.on");
        if ($(curr_on).next().length>0) {
            $(curr_on).removeClass("on");
            $(curr_on).fadeOut( "slow", function() {

            });
            $(curr_on).next().addClass("on").fadeIn( "slow", function() {
            });

        } else {
            $(curr_on).removeClass("on");
            $(curr_on).fadeOut( "slow", function() {

            });
            $("#home-carusel .dnd_column_dd_span6:first-child .dnd-animo").eq(0).addClass("on").fadeIn( "slow", function() {
            });
        }

        }, 5000);

    $("#subscribe-form").submit( function () {
        $.post(ajaxurl, {
            action: "add_subscriber",
            email: $("#subscribe-form-email").val(),
            }, function(data, textStatus) {
                console.log(data);
                $("#subscribe-form-msg").html(data);


        });

        return false;
    })
})