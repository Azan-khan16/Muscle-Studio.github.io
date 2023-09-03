<?php
include "db_conn.php";

if (isset($_POST["submit"])) {
   $first_name = $_POST['first_name'];
   $last_name = $_POST['last_name'];
   $username = $_POST['username']; 
   $email = $_POST['email'];
   $gender = $_POST['gender'];
   $contact_no = $_POST['Contact_no']; // Modified field name
   $date_of_join = $_POST['date_of_join']; // Modified field name
   $plan = $_POST['plan']; 

   // Check if all fields are filled
   if ($first_name != "" && $last_name != "" && $email != "" && $gender != "" && $username != "" && $contact_no != "" && $date_of_join != "" && $plan != "") {

      // Check if the email is unique
      $check_email_query = "SELECT * FROM `crud` WHERE `email` = '$email'";
      $check_email_result = mysqli_query($conn, $check_email_query);
      if (mysqli_num_rows($check_email_result) > 0) {
         echo "<script>alert('Email already exists. Please use a different email.')</script>";
      } else {
         // Check if the username is unique
         $check_username_query = "SELECT * FROM `crud` WHERE `username` = '$username'";
         $check_username_result = mysqli_query($conn, $check_username_query);
         if (mysqli_num_rows($check_username_result) > 0) {
            echo "<script>alert('Username already exists. Please choose a different username.')</script>";
         } else {
            // Validate number with 11 digits
            if (strlen($contact_no) != 11) {
               echo "<script>alert('Invalid contact number. Please enter an 11-digit number.')</script>";
            } else {
               $sql = "INSERT INTO `crud`(`id`, `first_name`, `last_name`, `email`, `gender`, `username`, `Contact_no`, `date_of_joining`, `plan`) VALUES (NULL,'$first_name','$last_name','$email','$gender','$username','$contact_no','$date_of_join','$plan')";

               
}
               $result = mysqli_query($conn, $sql);

               if ($result) {
                 // header("Location: index.php?msg=New record created successfully");
                  header("Location: login.html");
                  exit;
               } else {
                  echo "Failed: " . mysqli_error($conn);
               }
            }
         }
      }
   } else {
      echo "<script>alert('Please fill in all the fields')</script>";
   }


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

   <title>Registeration Form</title>
</head>

<body>
   <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
      Admin Panel
   </nav>

   <div class="container">
      <div class="text-center mb-4">
         <h3>Add New Member</h3>
         <p class="text-muted">Complete the form below to add New Member</p>
      </div>

      <div class="container d-flex justify-content-center">
         <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">First Name:</label>
                  <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
               </div>

               <div class="col">
                  <label class="form-label">Last Name:</label>
                  <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
               </div>
            </div>

            <div class="col">
               <label class="form-label">Username:</label>
               <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>


            <div class="mb-3">
               <label class="form-label">Email:</label>
               <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
            </div>



            <div class="col">
   <label class="form-label">Contact Number:</label>
   <input type="tel" class="form-control" name="Contact_no" placeholder="Contact number" pattern="[0-9]{11}">
</div>


      <div class="col">
         <label class="form-label">Date of Joining:</label>
         <input type="date" class="form-control" name="date_of_join" placeholder="Enter date" required>
      </div>

      <div class="form-group mb-3">
         <label>Gender:</label>
         &nbsp;
         <input type="radio" class="form-check-input" name="gender" id="male" value="male" required>
         <label for="male" class="form-input-label">Male</label>
         &nbsp;
         <input type="radio" class="form-check-input" name="gender" id="female" value="female" required>
         <label for="female" class="form-input-label">Female</label>
      </div>

      <div class="form-group mb-3">
         <label>Plan:</label>
         &nbsp;
         <input type="radio" class="form-check-input" name="plan" id="Basic" value="Basic" required>
         <label for="Basic" class="form-input-label">Basic</label>
         &nbsp;
         <input type="radio" class="form-check-input" name="plan" id="Extra" value="Extra" required>
         <label for="Extra" class="form-input-label">Extra</label>
         &nbsp;
         <input type="radio" class="form-check-input" name="plan" id="Premium" value="Premium" required>
         <label for="Premium" class="form-input-label">Premium</label>
      </div>

     <center> <div>
         <button type="submit" class="btn btn-success" name="submit">Save</button>
         <a href="index.php" class="btn btn-danger">Cancel</a>
      </div></center>
      </form>
   </div>
   </div>

   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"></script>

</body>

</html>