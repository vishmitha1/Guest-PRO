/* '''''''''popup container''''''''''*/

var slideshowID;
function togglePopup(id){
    document.getElementById(id).classList.toggle("active");
    slideshowID=id;
    }

function closePopup(id) {
  document.getElementById(id).classList.remove("active");
}



function shuffle(array) {
  let currentIndex = array.length, randomIndex;

  // While there remain elements to shuffle.
  while (currentIndex > 0) {

    // Pick a remaining element.
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex--;

    // And swap it with the current element.
    [array[currentIndex], array[randomIndex]] = [
      array[randomIndex], array[currentIndex]];
  }

  return array;
}




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
  const dynamicID=document.getElementById(slideshowID);
  const slides = dynamicID.getElementsByClassName("mySlides");
  // console.log(dynamicID);
  console.log(slides)
  // const dots = document.getElementsByClassName("dot");

  if (n > slides.length) {
    slideIndex = 1;
  }

  if (n < 1) {
    slideIndex = slides.length;
  }

  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  // for (i = 0; i < dots.length; i++) {
  //   dots[i].className = dots[i].className.replace(" active", "");
  // }

  slides[slideIndex - 1].style.display = "block";
  // dots[slideIndex - 1].className += " active";
}


//animatin for the table 





