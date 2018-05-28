<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Methods: POST');
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

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

//create post
if($post->create()) {
  echo json_encode(
    array('message' => 'Post created')
  );
} else {
  echo json_decode(
    array('message' => 'Post not created')
  );
}
