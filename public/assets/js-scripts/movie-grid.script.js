$(document).ready(function() {
    // animates the movie card when hovering
    $(".movie").hover(function() {
        $(this).animate({top: "-20"}, 150);
    }, function() {
        $(this).animate({top: "0"}, 150);
    });
});