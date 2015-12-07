/**
 * Created by Vineeth N Krishnan on 24/10/15.
 */

    $(document).ready(function() {

    // This command is used to initialize some elements and make them work properly
    $.material.init();

    //dropdown

    $(".dropdown-toggle").on("click", function(evt){
        if($(this).next().hasClass('open')){
             $(this).next().fadeOut('slow');
             $(this).next().removeClass('open');
       }else{
             $(this).next().fadeIn('slow');
             $(this).next().addClass('open');
        }
    return false;
});

});