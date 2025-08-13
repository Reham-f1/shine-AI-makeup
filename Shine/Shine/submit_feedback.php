<?php
// Database connection setup
$servername = "localhost";
$username = "root"; // Database username
$password = ""; // Database password
$dbname = "feedbacksystem"; // Database name

// Create the database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve data sent from the form
$rating = $_POST['Rating'];
$review = $_POST['FeedbackText'];

// Validate and sanitize inputs
$rating = 6 - $rating;
$rating = mysqli_real_escape_string($conn, $rating);
$review = mysqli_real_escape_string($conn, $review);

// Insert data into the database
$sql = "INSERT INTO Feedback (Rating, FeedbackText) VALUES ('$rating', '$review')";

// Execute the query and check for success
if (mysqli_query($conn, $sql)) {
    // Redirect to the homepage after successful insertion
    header("Location: homePage.php"); // Redirect to homePage.html
    exit(); // Make sure the script stops here
} else {
    // Something went wrong
    echo "Error: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>
