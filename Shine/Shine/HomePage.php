<?php
// db_connection.php
include('db_connection.php');

$result = mysqli_query($conn, "SELECT Rating, FeedbackText FROM feedback");

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$feedbacks = [];
while ($row = mysqli_fetch_assoc($result)) {
    $feedbacks[] = $row;
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Add favicon (logo in the browser tab) -->
   <link rel="icon" href="shine-website-logo0.png" type="image/png">

  <!-- External CSS -->
  <link rel="stylesheet" href="./home page style.css">
  <link rel="stylesheet" href="./style 1.1.css">
  
  
  <title>Shine</title>
  <style>
   /* Review Container Styles */
   .review-container {
      display: grid;
      grid-template-columns: repeat(3, 1fr); /* Creates a 3-column grid */
      gap: 20px;
      max-width: 1000px;
      margin: 0 auto;
      padding-top: 130px;
      
    }

    /* Individual review card styles */
    .review-card {
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease; /* Adds transition effect */
    }

    .review-card:hover {
      transform: translateY(-10px); /* Lifts card on hover */
    }

    /* Star rating styles */
    .stars {
      font-size: 20px;
      color: #f39c12;
      margin-bottom: 10px;
    }

    /* Review text */
    .review-card p {
      font-size: 16px;
      color: #333;
    }

    /* Navigation buttons style */
    .navigation-buttons {
      display: flex;
      justify-content: center;
      margin-top: 50px;
      gap: 60px;
    }

    .prev-btn, .next-btn {
      background-color: #CDC1FF;
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .prev-btn:hover, .next-btn:hover {
      background-color: #c1c1c1; /* Changes button color on hover */
    }

    /* Custom background colors for specific review cards */
    .review-card:nth-child(1) {
      background-color: #D9D9D9;
    }
    .review-card:nth-child(2) {
      background-color: #AECEF8;
    }
    .review-card:nth-child(3) {
      background-color: #ffbce5e5;
    }
    .review-card:nth-child(4) {
      background-color: #C6A2EE;
    }
    .review-card:nth-child(5) {
      background-color: #E5C6E5;
    }
    .review-card:nth-child(6) {
      background-color: #9AE1E9;
    }

    .custom-star {
  color: Black;
  font-size: 24px; 
}

.video-popup {
    display: none;
    position:absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    padding: 10px;
    border-radius: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    opacity: 0;
    transition: opacity 0.5s ease-in-out; 
    border: 5px solid rgb(93, 9, 90); 
}

.video-container {
    position: relative;
    max-width: 600px;
    width: 100%;
    text-align: center;
    border-radius: 20px;
    overflow: hidden;
}

.video-container video {
    width: 100%;
    border-radius: 20px;
}

.close-btn {
    position: absolute;
    top: 15px;  /* Adjusted for better positioning */
    right: 15px; /* Adjusted for better positioning */
    background: transparent; /* Make the background transparent */
    color: #ff4d94;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    text-align: center;
    font-size: 20px;
    line-height: 35px;
    cursor: pointer;
    border: 2px solid #ff4d94;
    font-weight: bold;
    transition: all 0.3s ease;
    z-index: 10; /* Ensure the button is above other elements */
}

.close-btn:hover {
    background: #ff4d94;
    color: white;
}


  </style>
</head>
<body>

  <!-- Main container for the homepage -->

  <div class="home-page">
    <div class="section-1">
      <div class="text-2">
        Unleash your inner glow with shine! upload your face and outfit to craft
        the perfect makeup to you
      </div>
      <div class="text-1">Shine</div>
       
       <!-- Image placeholder -->
      <div class="brown-rectangle">
        <img class="picture-1" src="picture-10.png" />
      </div>

      <!-- Start Button -->
      <div class="start-button">
        <a href="Fmodel/UploadPage-1.html" class="start-button-link">
        <div class="get-started">Get Started</div>
        </a>
        <img class="vector" src="vector0.svg" />
      </div>

      <!-- Decorative elements -->
      <img class="vector-3" src="vector-30.svg" />
      <img class="vector-1" src="vector-30.svg" />
    </div>

    <!-- Navigation bar -->
    <div class="nav-bar-top">
      <img class="shine-website-logo" src="shine-website-logo0.png" />
      <div class="shine-text">Shine</div>

      <a href="./feedback.html" class="feedback-link">
              <div class="feedback-text">
                  <div class="feedback">feedback</div>
              </div>
              <img class="feedback-icon" src="./feedback-icons.svg" />
          </a>
    </div>

    <!-- video Section -->
    <div class="card-section">
      <div class="card">
        <div class="text">
          <div class="let-s-make-things-happen"><b>watch the tutorial video</b></div>
          <div
            class="contact-us-today-to-learn-more-about-how-our-digital-marketing-services-can-help-your-business-grow-and-succeed-online"
          >
          If you're new to the website or want to get a better understanding of how to use it, watch the tutorial video that 
          explains all the features and steps in an easy and clear way.
          </div>
        </div>


       
        <div class="watching-video-button" id="watchVideoBtn">
  <div class="watching-video">Watch Video</div>
  <img class="video" src="video0.svg" />
</div>

<div id="videoPopup" class="video-popup">
  <div class="video-container">
    <span class="close-btn" id="closeBtn">✖</span> 
    <video id="videoFrame" width="560" height="315" controls>
      <source src="./vedio/ShineDemo.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
  </div>
</div>


      </div>
    </div>

    <!-- Review Section -->
    <div class="feedback-section">
      <div class="text-3">Customer Review</div>
      <div class="text-4">
        You can easily view the comments
        <br />
        and reviews of other users
      </div>
      
      <div class="review-container" id="reviews-container">
        <!-- Dynamically populated reviews -->
      </div>
    
      <div class="navigation-buttons">
        <button class="prev-btn" id="prev-btn">&lt;</button>
        <button class="next-btn" id="next-btn">&gt;</button>
      </div>
      </div>

 
      <div class="footer">

            <!-- Terms, privacy, and copyright information -->
            <div class="copyright">Copyright © 2024 Shine </div>
            <img class="line-stroke" src="./line-stroke0.svg" />
      
            <!-- Quick links in the footer -->
      
            <a href="./About.html">
            <div class="about">About</div>
            </a>
          
            <a href="./Services.html">
              <div class="services">Services</div>
            </a>
            <div class="quick-links">Quick Links</div>
      
            <!-- Contact information and social media links -->
            <div class="facebook-email">shineWebsite@gmail.com</div>
            <div class="facebook">Facebook</div>
            <div class="email">shineWebsite@gmail.com</div>
            <div class="email2">Email</div>
            <div class="twitter-email">shineWebsite@gmail.com</div>
            <div class="twitter">Twitter</div>
            <div class="instagram-email">shineWebsite@gmail.com</div>
            <div class="instagram">Instagram</div>
            <div class="socials">Socials</div>
      
            <!-- Social media icons -->
            <img class="socmed-instagram" src="./socmed-instagram0.svg" />
            <img class="socmed-twitter" src="./socmed-twitter0.svg" />
            <img class="socmed-facebook" src="./socmed-facebook0.svg" />
      
            <!-- Footer logo and text -->
            <img class="footer-text" src="./footer-text0.svg" />
            <img class="footer-logo" src="./footer-logo0.png" />
          </div>
  </div>

  <script>

    // Passing PHP data to JavaScript
    const feedbacks = <?php echo json_encode($feedbacks); ?>;

    let currentIndex = 0;

    // Function to render reviews
    function renderFeedbacks() {
        const container = document.getElementById("reviews-container");
        container.innerHTML = ""; // Clear previous reviews

        // Show up to 6 reviews
        for (let i = currentIndex; i < currentIndex + 6 && i < feedbacks.length; i++) {
            const feedback = feedbacks[i];
            const card = document.createElement("div");
            card.classList.add("review-card");

            // Create a star rating display
            let stars = '';
            for (let j = 0; j < feedback.Rating; j++) {
                stars += '<span class="custom-star">⭐</span>';
            }

            card.innerHTML = `
                <div class="stars">${stars}</div>
                <p class="feedback-text">${feedback.FeedbackText}</p>
            `;
            container.appendChild(card);
        }

        // Enable/disable navigation buttons
        document.getElementById("prev-btn").disabled = currentIndex === 0;
        document.getElementById("next-btn").disabled = currentIndex + 6 >= feedbacks.length;
    }

    // Event listeners for navigation
    document.getElementById("prev-btn").addEventListener("click", () => {
        if (currentIndex > 0) {
            currentIndex -= 6;
            renderFeedbacks();
        }
    });

    document.getElementById("next-btn").addEventListener("click", () => {
        if (currentIndex + 6 < feedbacks.length) {
            currentIndex += 6;
            renderFeedbacks();
        }
    });

    // Initial rendering of reviews
    renderFeedbacks();

    


    document.addEventListener("DOMContentLoaded", function () {
    const videoPopup = document.getElementById("videoPopup");
    const videoFrame = document.getElementById("videoFrame");
    const watchVideoBtn = document.getElementById("watchVideoBtn");
    const closeBtn = document.querySelector(".close-btn");

    // Show video popup with fade-in effect
    function showVideo() {
        videoPopup.style.display = "block";  // Ensure the popup is visible
        setTimeout(() => {
            videoPopup.style.opacity = "1";  // Fade-in effect
        }, 10);
        videoFrame.play();  // Play the video
    }

    // Close video popup with fade-out effect
    function closeVideo() {
        // Apply opacity and hide the popup after the fade-out effect
        videoPopup.style.opacity = "0";
        setTimeout(() => {
            videoPopup.style.display = "none"; // Hides the popup after the fade
            videoFrame.pause(); // Pause the video (do not allow it to play)
            videoFrame.currentTime = 0; // Reset the video to the beginning
        }, 500);  // Match transition duration
    }

    // When "Watch Video" button is clicked, show the video
    watchVideoBtn.addEventListener("click", showVideo);

    // When the close button ("X") is clicked, close the video
    closeBtn.addEventListener("click", closeVideo);

    // Automatically close the video when it ends
    videoFrame.addEventListener("ended", closeVideo);
});



  </script>

</body>
</html>