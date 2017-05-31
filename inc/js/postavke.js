$(document).ready(function () {
    $(".passBox").hide();
    $(".avatarBox").hide();

    $(".passBtn").on("click", function () {
        $(".avatarBox").slideUp();
        $(".passBox").slideDown();
    });

    $(".avatarBtn").on("click", function () {
        $(".passBox").slideUp();
        $(".avatarBox").slideDown();
    });

    var imgToChange = $(".profImg").children().eq(0);

    $(".tryOutAvatar").on("click", function() {
        $(imgToChange).attr( "src", $(".avatarLink").val() );
    });
});