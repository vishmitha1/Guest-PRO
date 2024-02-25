var availabilityBtn=document.getElementById("checkAvailability");
var searchBtn=document.getElementById("searchReservation");

var defaultRoomBlocks=document.getElementsByid('Default-view');

console.log(availabilityBtn);

availabilityBtn.addEventListener("click",function(){
    console.log("clicked");
    var div1=document.getElementsByClassName('res-searchbar-wrapper');
    var div2=document.getElementsByClassName('recep-reservation-history-wrapper');
    div1.style.display="none";
    div2.style.display="none";
    defaultRoomBlocks.style.display="none";
})


