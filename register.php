<?php
// Database connection details
$servername = "root";
$username = "jobthssg";
$password = "XSWB[~Mff!R=";
$dbname = "jobthssg_applicant";

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $course = $_POST["course"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $gender = $_POST["gender"];
    $age = $_POST["age"];
    $profession = $_POST["profession"];
    $qualification = $_POST["qualification"];
    $location = $_POST["location"];
    $experience = $_POST["experience"];

    // Prepare SQL statement
    $sql = "INSERT INTO allapplicant (course, name, email, phone, gender, age, profession, qualification,location, experience) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        // Bind parameters to the statement
        $stmt->bind_param("ssssssssss", $course, $name, $email, $phone, $gender, $age, $profession, $qualification,$location, $experience);

        // Execute the statement
        if ($stmt->execute()) {
            echo "New record created successfully";
            header("Location:display.html");
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
