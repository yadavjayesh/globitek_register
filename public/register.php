<?php
  require_once('../private/initialize.php');

  // Set default values for all variables the page needs.

  // if this is a POST request, process the form
  // Hint: private/functions.php can help

    // Confirm that POST values are present before accessing them.

    // Perform Validations
    // Hint: Write these in private/validation_functions.php

    // if there were no errors, submit data to database

      // Write SQL INSERT statement
      // $sql = "";

      // For INSERT statments, $result is just true/false
      // $result = db_query($db, $sql);
      // if($result) {
      //   db_close($db);

      //   TODO redirect user to success page

      // } else {
      //   // The SQL INSERT statement failed.
      //   // Just show the error, not the form
      //   echo db_error($db);
      //   db_close($db);
      //   exit;
      // }

?>

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <h1>Register</h1>
  <p>Register to become a Globitek Partner.</p>

  <?php
    // TODO: display any form errors here
    // Hint: private/functions.php can help

    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $user_name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

  /**
   * @param $name
   * @param $errors
   */
  function validate_length($name, $errors)
  {
      if (is_blank($name)) {
          $errors[] = "First name cannot be blank";
      } elseif (has_length($name, ['min' => 2, 'max' => 255])) {
          $errors[] = "First name must be between 2 and 255 characters";
      }
  }



  $output = '';
  if(is_post_request()){
        $errors = [];

        //validate presence and length of all valuesx
        is_name_valid($first_name, $errors, "First Name");
        is_name_valid($last_name, $errors, "Last Name");
        is_name_valid($email, $errors, "Email");
        is_name_valid($user_name, $errors, "Username");
        is_name_valid($password, $errors, "Password");

        if(!empty($errors)) {
            echo display_errors($errors);
        }else{

            if(insert_new_user($first_name,$last_name,$email,$user_name,$password)){
                echo 'insert done';
                header("Location: ./registration_success.php");
            }else{
                echo 'insert failed';
            }
        }

  }


  ?>

  <!-- TODO: HTML form goes here -->



    <form action="register.php" method="post">
        <label>First name:</label><br>
        <input name="first_name" value=<?php echo $first_name?>><br>
        <label>Last name:</label><br>
        <input name="last_name" value=<?php echo $last_name?>><br>
        <label>Email:</label><br>
        <input name="email" value=<?php echo $email?>><br>
        <label>User Name:</label><br>
        <input name="user_name" value=<?php echo $user_name?>><br>
        <label>Password:</label><br>
        <input name="password"  type="password" value=<?php echo $password?>><br>
        <input type="submit" name="submit" value="Submit"/>
    </form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
