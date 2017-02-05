<?php

  // is_blank('abcd')
  function is_blank($value='') {
    if(strlen($value)==0)
        return false;

    return true;
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
    $length = strlen($value);

    if(isset($options['max']) && ($length > $options['max']))
        return false;
    if(isset($options['min']) && ($length < $options['min']))
        return false;

    return true;
    // TODO
  }

  // has_valid_email_format('test@test.com')
  function has_valid_email_format($value) {
    if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
        return false;
    }

    return true;
  }

  function is_value_present($value){
      $length = strlen($value);
      if($length==0)
          return false;

      return true;

  }

  function is_name_valid($name, & $error, $field){
      if(strlen($name) == 0){
          $error[] = $field . " cannot be blank";
          return;
      }

      if(!(has_length($name, ['min'=>2, 'max'=>255]))){
          $error[] = $field . " must be between 2 and 255 characters";
          return;
      }

      if(strcasecmp($field,"Username")==0){
          if(has_length($name,['min'=>8, 'max'=>255])==false){
              $error[] = $field . " must be between 8 and 255 characters";
              return;
          }else if(does_exist($name)){
              $error[] = $name . "already exists";
              return;
          }
      }

      if(strcasecmp($field,"Email")==0){
          if(!has_valid_email_format($name)){
              $error[] = "Email is not valid";
              return;
          }
      }

      if(strcasecmp($field,"Password")==0){
          if(!has_length($name, ['min'=>8, 'max'=>255])){
              $error[] = "Password must be between 8 and 255 characters";
              return;
          }
      }

  }

  function does_exist($username){
        $conn = db_connect();
        $username = mysqli_real_escape_string($conn,$username);
        $result = db_query($conn, "SELECT * from users where username = $username");

        return $result;
  }

?>
