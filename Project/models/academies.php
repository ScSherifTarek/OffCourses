<?php

include '../connection.php';

class Academies {


    private $tableName = 'academy';
    private $imagesDir = '../images/academies/';


    public static function login($email, $password) {
        $password = md5($password);
        $_this = new self;
        global $con;
        $query = 'SELECT * FROM ' . $_this->tableName . ' WHERE email=' . "'$email'" . ' AND password=' . "'$password'" . ' LIMIT 1';
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        if (is_array($row))
            $data = ['status' => true, 'data' => $row];
        else
            $data = ['status' => false, 'data' => []];

        return $data;
    }

     public static function create($name, $email, $password, $address) {
        /*
         * Hashing String
         */
        $password = md5($password);

        /*
         * Because the function static
         */
        $_this = new self;

        /*
         * Read Connection
         */
        global $con;

        /*
         * Insert To Table
         */
        $query = 'INSERT INTO ' . $_this->tableName .
            '(name, email, password, address)
            VALUES 
            ("' . $name . '","' . $email . '","' . $password . '","' . $address . '")';
        if ($con->query($query) === true) {
            $data = ['status' => true, 'data' => Academies::getById($con->mysqli_insert_id) ];
        } else {
            $data = ['status' => false, 'data' => [] ];
        }

        return $data;
    }

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

}