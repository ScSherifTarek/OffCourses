<?php
include 'connection.php';
class Courses {
    private $tableName = 'course';
    private $imagesDir = 'images/courses/';
    public static function create()
    public static function getById($id) {
        $_this = new self;
        global $con;
        $query = 'SELECT * FROM ' . $_this->tableName . ' WHERE id=' . $id . ' LIMIT 1';
        $result = mysqli_query($con, $query);
        $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $result;
    }
    public static function getAllData() {
        $_this = new self;
        global $con;
        $query = 'SELECT * FROM ' . $_this->tableName . ' ORDER BY id DESC';
        $result = mysqli_query($con, $query);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result;
    }
 
    public static function delete($id) {
        $_this = new self;
        global $con;
        $query = 'DELETE FROM ' . $_this->tableName . ' WHERE id=' . "'$id'" . ' LIMIT 1';
        if ($con->query($query) === true) {
            $data = ['status' => true, 'message' => 'Delete successfully'];
        } else {
            $data = ['status' => false, 'message' => "Error: " . $query . "<br>" . $con->error];
        }
        return $data;
    }
    
    // public static function create($name, $cost) {
        
    //     /*
    //      * Because the function static
    //      */
    //     $_this = new self;
    //     /*
    //      * Read Connection
    //      */
    //     global $con;
    //     /*
    //      * Insert To Table
    //      */
    //     $query = 'INSERT INTO ' . $_this->tableName . '(c_name, c_cost) VALUES ("' . $name . '","' . $cost . '")';
    //     if ($con->query($query) === true) {
    //         $data = ['status' => true, 'message' => 'New record created successfully'];
    //     } else {
    //         $data = ['status' => false, 'message' => "Error: " . $query . "<br>" . $con->error];
    //     }
    //     return $data;
    // }
    // /*public static function update($id, $name, $cost) {
        
    //     /*
    //      * Because the function static
    //      */
    //     $_this = new self;
    //     /*
    //      * Read Connection
    //      */
    //     global $con;
    //     /*
    //      * Update Table
    //      */
    //     $query = 'UPDATE ' . $_this->tableName . ' SET c_name="' . $name . '", c_cost="' . $cost . '" WHERE id=' . $id;
    //     if ($con->query($query) === true) {
    //         $data = ['status' => true, 'message' => 'Record updated successfully'];
    //     } else {
    //         $data = ['status' => false, 'message' => "Error: " . $query . "<br>" . $con->error];
    //     }
    //     return $data;
    // }
}