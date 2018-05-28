<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// instantiate blog category object
$category = new Category($db);

// category read query
$result = $category->read();
// get row count
$num = $result->rowCount();
// check if any categories
if($num > 0) {
  // cat array
  $cat_arr = array();
  $cat_arr['data'] = array();
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $cat_item = array(
      'id' => $id,
      'name' => $name
    );

    // push to "data"
    array_push($cat_arr['data'], $cat_item);
  }

  // turn to json & output
  echo json_encode($cat_arr);

} else {
  // no categories
  echo json_encode(
    array('message' => 'No categories Found')
  );
}