/**
 * Created by Hasak on 25.05.2017..
 */

$(document).on("click",".ajbtn",function () {
    var id=this.id;
    $.post("/inc/php/ajax.php",{id:id},function (d) {
        $("#forajaxing").html(d);
    });
});