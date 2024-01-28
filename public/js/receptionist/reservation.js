var availabilityBtn=document.getElementById("checkAvailability");
var searchBtn=document.getElementById("searchReservation");

console.log(availabilityBtn);

availabilityBtn.addEventListener("click",function(){
    console.log("clicked");
    var div1=document.getElementsByClassName('res-searchbar-wrapper');
    var div2=document.getElementsByClassName('recep-reservation-history-wrapper');
    div1.style.display="none";
    div2.style.display="none";
})