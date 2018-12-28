<?php

include 'connection.php';

class Academies {


    private $tableName = 'academy';
    private $imagesDir = 'images/academies/';


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


    public static function updateProfile($id, $name, $password = null, $phone_no = null, $address = null, $image = null)
    {
        /*
         * Hashing String
         */
        $addressUpdate = '';
        if($address != null)
            $addressUpdate = ', address="'.$address.'"';

        $passwordUpdate = '';
        if ($password != null)
            $passwordUpdate = ', password="' . md5($password) . '"';

        $previous_experienceUpdate = '';
        if($previous_experience != null)
            $previous_experienceUpdate = ', previous_experience = "'.$previous_experience.'"';

        $phone_noUpdate = '';
        if($phone_no != null)
            $phone_noUpdate = ', phone_no = "'.$phone_no.'"';

        $addressUpdate = '';
        if($address != null)
            $addressUpdate = ', address = "'.$address.'"';


        /*
         * Because the function static
         */
        $_this = new self;

        /*
         * Read Connection
         */
        global $con;

        /*
         * Upload Image
         */
        
        $imageUpdate = '';
        if ($image != null) {
            
            $dir = $imagesDir;
            
            $query = 'SELECT profile_image_url FROM ' . $_this->tableName . ' WHERE id=' . $id . ' LIMIT 1';
            $result = mysqli_query($con, $query);
            $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $filename = $dir.$result['profile_image_url'];
            if (file_exists($filename)) {
                unlink($filename);
              }
            
            
            $tmp = $image['tmp_name'];
            $imageName = $image['name'];
            $type = $image['type'];
            $size = $image['size'];
            $error = $image['error'];
            $allow = ["jpg", "jpeg", "gif", "png"];
            $ex = explode('.', strtolower($imageName));

            if (!in_array(end($ex), $allow))
                return ['status' => false, 'message' => 'Wrong Image'];

            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            $result = '';
            for ($i = 1; $i <= 20; $i++) {
                $result .= $characters[mt_rand(0, 61)];
            }
            $newname = $result . '.' . $ex[2];
            move_uploaded_file($tmp, $dir . $newname);
            $image = $newname;
            $imageUpdate = ', profile_image_url="' . $image . '"';
        }

        /*
         * Update Table
         */
        $query = 'UPDATE ' . $_this->tableName . ' SET name="' . $name . '", ' . $passwordUpdate . ' ' . $previous_experienceUpdate . ' ' . $phone_noUpdate . '' . $addressUpdate . '' . $imageUpdate . ' WHERE id=' . $id;
        if ($con->query($query) === true) {
            $data = ['status' => true, 'message' => 'Record updated successfully'];
        } else {
            $data = ['status' => false, 'message' => "Error: " . $query . "<br>" . $con->error];
        }

        return $data;
    }
}