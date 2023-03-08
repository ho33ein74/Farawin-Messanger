window.addEventListener("online",  function(){
    // $("#offlineMsg").hide();
    $("#statusUser").html('<i class="fa fa-circle text-success"></i> آنلاین');
});
window.addEventListener("offline", function(){
    // $("#offlineMsg").show();
    $("#statusUser").html('<i class="fa fa-circle text-danger"></i> آفلاین');
});

if (navigator.onLine) {
    $("#statusUser").html('<i class="fa fa-circle text-success"></i> آنلاین');
} else {
    $("#statusUser").html('<i class="fa fa-circle text-danger"></i> آفلاین');
}