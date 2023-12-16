<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/about.css">
   
</head>
<body>
   
    <header class="header">
        <a href="?php echo URLROOT ;?>/Home" class="logo"><h2>Guest Pro</h2></a>
        <nav class="nav">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Details</a>
            <a href="#">Contact</a>
            <a href="<?php echo URLROOT ;?>/Users/register">SignUp</a>


        </nav>

    </header>

    <section class="home" >
        <div class="content">
            <h2>Welcome to </h2> <h2> Guest Pro
                <div class="blur"><p>Your key to an exceptional stay. Your comfort is our priority, and your satisfaction is our mission. Explore our services, unlock convenience, and make your visit truly extraordinary</p></div>
            </h2> 
            <a href="<?php echo URLROOT;?>/Users/login">Get Started</a>
        </div>
    </section>
    <br>
    <div class="lowerback">
    <div class="testimonial">
    <h1>Our Reviews</h1>
    <div class="line"></div>
    <!-- arrow wrapper contains the review and the arrows -->
    
    <div class="arrow-wrapper">
      <!-- review section -->
      <div id="reviewWrap" class="review-wrap">
        <div id="imgBox"></div>
        <div id="name"></div>
        <div id="profession"></div>
        <div id="description"></div>
      </div>
      <!-- left arrow -->
      <div class="left-arrow-wrap">
        <div class="arrow"></div>
      </div>
      <!-- right arrow -->
      <div class="right-arrow-wrap">
        <div class="arrow"></div>
      </div>
    </div>
  </div>
  </div>
  

  <script>
    const reviewWrap = document.getElementById("reviewWrap");
    const leftArrow = document.querySelector(".left-arrow-wrap .arrow");
    const rightArrow = document.querySelector(".right-arrow-wrap .arrow");
    const imgBox = document.getElementById("imgBox");
    const name = document.getElementById("name");
    const profession = document.getElementById("profession");
    const description = document.getElementById("description");

    let people = [{
        photo: 'url("https://cdn.pixabay.com/photo/2015/03/03/18/58/woman-657753_960_720.jpg")',
        name: "Natalie Grey",
        // profession: "Software Engineer",
        description: 'The service at this hotel is top-notch! The staff was incredibly attentive and friendly throughout our entire stay. They made us feel like royalty'
      },
      {
        photo: "url('https://cdn.pixabay.com/photo/2018/06/27/07/45/college-student-3500990_960_720.jpg')",
        name: "Dylan Smith",
        // profession: "Student",
        description: 'Our room was pure luxury. The plush bedding, spacious bathroom, and elegant decor made us feel pampered and relaxed. It was a true five-star experience.'
      },
      {
        photo: "url('https://cdn.pixabay.com/photo/2015/01/08/18/30/man-593372__340.jpg')",
        name: "Branson Cook",
        // profession: "Web Developer",
        description: "The hotel's restaurant served some of the most delicious food we've ever had. Each meal was a culinary delight, and the breakfast buffet was a standout."
      },
      {
        photo: "url('<?php echo URLROOT;?>/public/img/person.jpg')",
        name: "Julius Grohn",
        // profession: "Designer",
        description: " The spa at this hotel was a sanctuary of relaxation. We indulged in massages and spent time in the sauna and hot tub. It was a rejuvenating experience."
      }
    ];

    // set the first person
    imgBox.style.backgroundImage = people[0].photo;
    name.innerText = people[0].name;
    profession.innerText = people[0].profession;
    description.innerText = people[0].description;
    let currentPerson = 0;

    //Select the side where you want to slide
    function slide(side, personNumber) {
      let reviewWrapWidth = reviewWrap.offsetWidth + "px";
      let descriptionHeight = description.offsetHeight + "px";
      //(+ or -)
      let side1symbol = side === "left" ? "" : "-";
      let side2symbol = side === "left" ? "-" : "";

      setTimeout(() => {
        imgBox.style.backgroundImage = people[personNumber].photo;
      }, 0);
      setTimeout(() => {
        description.style.height = descriptionHeight;
      }, 100);
      setTimeout(() => {
        name.innerText = people[personNumber].name;
      }, 200);
      setTimeout(() => {
        profession.innerText = people[personNumber].profession;
      }, 300);
      setTimeout(() => {
        description.innerText = people[personNumber].description;
      }, 400);
    }

    function setNextCardLeft() {
      if (currentPerson === 3) {
        currentPerson = 0;
        slide("left", currentPerson);
      } else {
        currentPerson++;
      }

      slide("left", currentPerson);
    }

    function setNextCardRight() {
      if (currentPerson === 0) {
        currentPerson = 3;
        slide("right", currentPerson);
      } else {
        currentPerson--;
      }

      slide("right", currentPerson);
    }

    leftArrow.addEventListener("click", setNextCardLeft);
    rightArrow.addEventListener("click", setNextCardRight);
  </script>
   
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>