<?php

  // Find all countries, ordered by name
  function find_all_countries() {
    global $db;
    $sql = "SELECT * FROM countries ORDER BY name ASC;";
    $country_result = db_query($db, $sql);
    return $country_result;
  }

  // Find all states, ordered by name
  function find_all_states() {
    global $db;
    $sql = "SELECT * FROM states ";
    $sql .= "ORDER BY name ASC;";
    $state_result = db_query($db, $sql);
    return $state_result;
  }

  // Find all states, ordered by name
  function find_states_for_country_id($country_id=0) {
    global $db;
    $sql = "SELECT * FROM states ";
    $sql .= "WHERE country_id='" . $country_id . "' ";
    $sql .= "ORDER BY name ASC;";
    $state_result = db_query($db, $sql);
    return $state_result;
  }

  // Find state by ID
  function find_state_by_id($id=0) {
    global $db;
    $sql = "SELECT * FROM states ";
    $sql .= "WHERE id='" . $id . "';";
    $state_result = db_query($db, $sql);
    return $state_result;
  }

  // Find all territories, ordered by state_id
  function find_all_territories() {
    global $db;
    $sql = "SELECT * FROM territories ";
    $sql .= "ORDER BY state_id ASC, position ASC;";
    $territory_result = db_query($db, $sql);
    return $territory_result;
  }

  // Find all territories whose state_id (foreign key) matches this id
  function find_territories_for_state_id($state_id=0) {
    global $db;
    $sql = "SELECT * FROM territories ";
    $sql .= "WHERE state_id='" . $state_id . "' ";
    $sql .= "ORDER BY position ASC;";
    $territory_result = db_query($db, $sql);
    return $territory_result;
  }

  // Find territory by ID
  function find_territory_by_id($id=0) {
    global $db;
    $sql = "SELECT * FROM territories ";
    $sql .= "WHERE id='" . $id . "';";
    $territory_result = db_query($db, $sql);
    return $territory_result;
  }

  // Find all salespeople, ordered last_name, first_name
  function find_all_salespeople() {
    global $db;
    $sql = "SELECT * FROM salespeople ";
    $sql .= "ORDER BY last_name ASC, first_name ASC;";
    $salespeople_result = db_query($db, $sql);
    return $salespeople_result;
  }

  // To find salespeople, we need to use the join table.
  // We LEFT JOIN salespeople_territories and then find results
  // in the join table which have the same territory ID.
  function find_salespeople_for_territory_id($territory_id=0) {
    global $db;
    $sql = "SELECT * FROM salespeople ";
    $sql .= "LEFT JOIN salespeople_territories
              ON (salespeople_territories.salesperson_id = salespeople.id) ";
    $sql .= "WHERE salespeople_territories.territory_id='" . $territory_id . "' ";
    $sql .= "ORDER BY last_name ASC, first_name ASC;";
    $salespeople_result = db_query($db, $sql);
    return $salespeople_result;
  }

  // Find salesperson using id
  function find_salesperson_by_id($id=0) {
    global $db;
    $sql = "SELECT * FROM salespeople ";
    $sql .= "WHERE id='" . $id . "';";
    $salespeople_result = db_query($db, $sql);
    return $salespeople_result;
  }

  // To find territories, we need to use the join table.
  // We LEFT JOIN salespeople_territories and then find results
  // in the join table which have the same salesperson ID.
  function find_territories_by_salesperson_id($id=0) {
    global $db;
    $sql = "SELECT * FROM territories ";
    $sql .= "LEFT JOIN salespeople_territories
              ON (territories.id = salespeople_territories.territory_id) ";
    $sql .= "WHERE salespeople_territories.salesperson_id='" . $id . "' ";
    $sql .= "ORDER BY territories.name ASC;";
    $territories_result = db_query($db, $sql);
    return $territories_result;
  }

  function insert_new_user($first_name, $last_name, $email, $username, $password){
      $conn = db_connect();

    $first_name = mysqli_real_escape_string($conn, $first_name);
    $last_name = mysqli_real_escape_string($conn, $last_name);
    $email = mysqli_real_escape_string($conn, $email);
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $date = mysqli_real_escape_string($conn, date("Y-m-d"));
    $query = "INSERT INTO users (first_name, last_name, email, username, password, created_at) VALUES
                ('{$first_name}', '{$last_name}', '{$email}', '{$username}', '{$password}', '{$date}')";


    if(mysqli_query($conn, $query)){
      return true;
    }else{
      return false;
    }
  }

?>
