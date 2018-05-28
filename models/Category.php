<?php 
class Category {
    // db stuff
    private $conn;
    private $table = 'categories';

    //properties
    public $id;
    public $name;
    public $created_at;

    // constructor with db
  public function __construct($db) {
    $this->conn = $db;
  }

  // get categories
  public function read() {
    // create categories
    $query = 'SELECT
     id,
     name,
     created_at
  FROM
    ' . $this->table . '
  ORDER BY
    created_at DESC
    ';

  // prepare the statment
  $stmt = $this->conn->prepare($query);

  // execute query
  $stmt->execute();
  return $stmt;
  }
}