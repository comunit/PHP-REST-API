<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Allow-Control-Allow-Headers: Allow-Control-Allow-Headers,Content-type,Access-Control-Allow-Methods, Authorization, X-Requested-with');


include_once '../../config/Database.php';
include_once '../../models/Post.php';

// instantiate DB & connect
$database = new Database();
$db = $database->connect();

// instantiate blog post object
$post = new Post($db);

// get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set id to delte
$post->id = $data->id;

// delete post
if($post->delete()) {
  echo json_encode(
    array('message' => 'Post deleted')
  );
} else {
  echo json_decode(
    array('message' => 'Post not deleted')
  );
}
