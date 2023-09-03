<?php
include "db_conn.php";
$id = $_GET["id"];

if (isset($_POST["submit"])) {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $contact = $_POST['Contact_no'];
  $gender = $_POST['gender'];
  $date_of_joining = $_POST['Date_of_join'];
  $plan = $_POST['plan'];

  // Check if all fields are filled
  if ($first_name == "" || $last_name == "" || $username == "" || $email == "" || $contact == "" || $gender == "" || $date_of_joining == "" || $plan == "") {
    echo "<script>alert('Please fill in all the fields')</script>";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email address')</script>";
  } elseif (strlen($contact) != 11) {
    echo "<script>alert('Invalid contact number. Please enter an 11-digit number')</script>";
  } else {
    $sql = "UPDATE `crud` SET `first_name`='$first_name',`last_name`='$last_name',`username`='$username',`email`='$email',`Contact_no`='$contact',`gender`='$gender',`date_of_joining`='$date_of_joining',`Plan`='$plan' WHERE id = $id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      header("Location: index.php?msg=Data updated successfully");
    } else {
      echo "Failed: " . mysqli_error($conn);
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>PHP CRUD Application</title>
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
    Admin Panel
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit Member Information</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
    $sql = "SELECT * FROM `crud` WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">First Name:</label>
            <input type="text" class="form-control" name="first_name" value="<?php echo $row['first_name'] ?>" required>
          </div>

          <div class="col">
            <label class="form-label">Last Name:</label>
            <input type="text" class="form-control" name="last_name" value="<?php echo $row['last_name'] ?>" required>
          </div>
        </div>

        <div class="col">
          <label class="form-label">Username:</label>
          <input type="text" class="form-control" name="username" value="<?php echo $row['username'] ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Email:</label>
          <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>" required>
        </div>

        <div class="col">
          <label class="form-label">Contact Number:</label>
          <input type="tel" class="form-control" name="Contact_no" value="<?php echo $row['contact_no'] ?>" pattern="[0-9]{11}" required>
        </div>

        <div class="col">
          <label class="form-label">Date of Joining:</label>
          <input type="date" class="form-control" name="Date_of_join" value="<?php echo $row['date_of_joining'] ?>" required>
        </div>

        <div class="form-group mb-3">
          <label>Gender:</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="gender" id="male" value="male" <?php echo ($row["gender"] == 'male') ? "checked" : ""; ?> required>
          <label for="male" class="form-input-label">Male</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="gender" id="female" value="female" <?php echo ($row["gender"] == 'female') ? "checked" : ""; ?> required>
          <label for="female" class="form-input-label">Female</label>
        </div>

        <div class="form-group mb-3">
          <label>Plan:</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="plan" id="Basic" value="Basic" <?php echo ($row["plan"] == 'Basic') ? "checked" : ""; ?> required>
          <label for="Basic" class="form-input-label">Basic</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="plan" id="Extra" value="Extra" <?php echo ($row["plan"] == 'Extra') ? "checked" : ""; ?> required>
          <label for="Extra" class="form-input-label">Extra</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="plan" id="Premium" value="Premium" <?php echo ($row["plan"] == 'Premium') ? "checked" : ""; ?> required>
          <label for="Premium" class="form-input-label">Premium</label>
        </div>

        <div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="index.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
