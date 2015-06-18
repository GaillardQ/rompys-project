$( document ).ready(function() {
    getLastAddGames();
    getTopSellers();
});

function getLastAddGames()
{
    $.ajax({
        method: "POST",
        url: "/ws/last_adds",
        data: { output: "home", limit: 10 }
    })
    .done( function( res ) {
        $("#home-last-adds-error").addClass('hidden');
        $("#home-last-adds-list").html(res);
        
    })
    .fail( function(err) {
        $("#home-last-adds-error").removeClass('hidden');
    })
}

function getTopSellers() {
    $.ajax({
        method: "POST",
        url: "/ws/best_sellers",
        data: { output: "home", limit: 5 }
    })
    .done( function( res ) {
        $("#home-best-sellers-error").addClass('hidden');
        $("#home-best-sellers-list").html(res);
        
    })
    .fail( function(err) {
        $("#home-best-sellers-error").removeClass('hidden');
    })
}