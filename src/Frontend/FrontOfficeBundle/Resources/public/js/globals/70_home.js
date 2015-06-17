$( document ).ready(function() {
    getLastAddGames();
});

function getLastAddGames()
{
    $.ajax({
        method: "POST",
        url: "/ws/last_adds",
        data: { output: "home" }
    })
    .done( function( res ) {
        $("#home-last-adds-error").addClass('hidden');
        $("#home-last-adds-list").html(res);
        
    })
    .fail( function(err) {
        $("#home-last-adds-error").removeClass('hidden');
    })
    
}