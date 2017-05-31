$(document).ready(function () {
    $(".send").hide();
    $(".sent").hide();

    $(".porbtns").click(function (data) {
		$(".por").slideUp();
		$("."+this.id).slideDown();
    });
});