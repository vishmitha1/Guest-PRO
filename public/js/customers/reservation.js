/* '''''''''popup container''''''''''*/

function togglePopup(){
    document.getElementById("popup-1").classList.toggle("active");
    
    }
function closePopup() {
        document.getElementById("popup-1").classList.remove("active");
      }



    /* '''''''''''' slideshow container'''''''''''''''''' */
let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  // dots[slideIndex-1].className += " active";
}


//retrive search 
// Sample data structure (replace it with your actual fetched data)
const fetchedData = [
  {
      category: "Deluxe Room",
      functions: ["Bathtab", "Wifi", "Pool", "Square", "1 Queen Bed"],
      intends: ["Mini Bar", "AC", "Balcony"],
      reviews: 1250,
      price: "2500LKR"
  },
  // Add more room data objects as needed
];

// document.addEventListener("DOMContentLoaded", function () {
//   // Call a function to populate the room details
//   populateRoomDetails(fetchedData);
// });

