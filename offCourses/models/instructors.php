<?php

include 'connection.php';


class Instructors {
    private $tableName = 'instructor';
    private $imagesDir = 'images/instructors/';
    
    public static function login($email, $password) {
        $email = addslashes($email);
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
    public static function getById($id) {
        $_this = new self;
        global $con;
        $query = 'SELECT * FROM ' . $_this->tableName . ' WHERE id=' . $id . ' LIMIT 1';
        $result = mysqli_query($con, $query);
        $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $result;
    }
    public static function getIdForEmail($email) {

        $email = addslashes($email);
        $_this = new self;
        global $con;
        $query = 'SELECT id FROM ' . $_this->tableName . ' WHERE email="' . $email . '" LIMIT 1';
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result)==0) 
        { 
            return -1; 
        }
        $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $result['id'];
    }
    public static function getEmailForId($id)
    {
        $_this = new self;
        global $con;
        $query = 'SELECT email FROM ' . $_this->tableName . ' WHERE id="' . $id . '" LIMIT 1';
        $result = mysqli_query($con, $query);
        $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $result['email'];
    }
    public static function getAllData($limit = null) {
        $_this = new self;
        global $con;

        $limitEdit = ''; 
        if($limit != null)
            $limitEdit = ' LIMIT '.$limit;
    
        $query = 'SELECT * FROM ' . $_this->tableName . ' ORDER BY id DESC'.$limitEdit;
        $result = mysqli_query($con, $query);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result;
    }

    public static function create($first_name, $last_name, $email, $password, $confirmPassword) {
        
        $first_name = addslashes($first_name);
        $last_name = addslashes($last_name);
        $email = addslashes($email);
        $confirmPassword = addslashes($confirmPassword);
        if(!(validator::isValidEmail($email)) || !(validator::isValidPassword($password, $confirmPassword)) || !(validator::isValidName($first_name)) || !(validator::isValidName($last_name)))
        {
            echo "Nooooooooooo!";
            return false;
        }
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
            '(first_name,last_name, email, password)
            VALUES 
            ("' . $first_name . '","' . $last_name . '","' . $email . '","' . $password . '")';
        if ($con->query($query) === true) {
            $data = ['status' => true, 'data' => Instructors::getById($con->insert_id)];
        } else {
            $data = ['status' => false, 'data' => [] ];
        }

        return $data;
    }
    
    public static function updateProfile($id, $first_name, $last_name, $password = null, $previous_experience = null, $phone_no = null,  $image = null)
    {
        
        $first_name = addslashes($first_name);
        $last_name = addslashes($last_name);

        /*
         * Hashing String
         */
        $passwordUpdate = '';
        if ($password != null)
            $passwordUpdate = ', password="' . md5($password) . '"';
        $previous_experienceUpdate = '';
        if($previous_experience != null)
            $previous_experienceUpdate = ', previous_experience = "'.addslashes($previous_experience).'"';
        $phone_noUpdate = '';
        if($phone_no != null)
            $phone_noUpdate = ', phone_no = "'.addslashes($phone_no).'"';
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
            
            $dir = $_this->imagesDir;
            
            $query = 'SELECT profile_image_url FROM ' . $_this->tableName . ' WHERE id=' . $id . ' LIMIT 1';
            $result = mysqli_query($con, $query);
            $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $filename = $dir.$result['profile_image_url'];
            if (file_exists($filename) && $filename != $dir ) {
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
            $newname = $result . '.' . end($ex);
            move_uploaded_file($tmp, $dir . $newname);
            $image = $newname;
            $imageUpdate = ', profile_image_url="' . $image . '"';
        }
        /*
         * Update Table
         */
        $query = 'UPDATE ' . $_this->tableName . ' SET first_name="' . $first_name . '", last_name="' . $last_name . '" ' . $passwordUpdate . ' ' . $previous_experienceUpdate . ' ' . $phone_noUpdate . '' . $imageUpdate . ' WHERE id=' . $id;
        if ($con->query($query) === true) {
            $data = ['status' => true, 'message' => 'Record updated successfully'];
        } else {
            $data = ['status' => false, 'message' => "Error: " . $query . "<br>" . $con->error];
        }
        return $data;
    }

    public static function getAllInstructrosForAcademyWithId($academy_id, $limit = null)
    {
        $_this = new self;
        global $con;
        $limitEdit = ''; 
        if($limit != null)
            $limitEdit = ' LIMIT '.$limit;
        $query = 'SELECT * from '.$_this->tableName.' join academy_has_instructors on '.$_this->tableName.'.id = academy_has_instructors.instructor_id where academy_has_instructors.academy_id = '.$academy_id.$limitEdit;
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result)==0) 
        { 
            return ["status" => false, "data" => []]; 
        }
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return ["status" => true, "data" => $result];
    }


    public static function checkAndGetById($id)
    {
        $_this = new self;
        global $con;
        $query = 'SELECT * FROM ' . $_this->tableName . ' WHERE id=' . $id . ' LIMIT 1';
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        if (is_array($row))
            $data = ['status' => true, 'data' => $row];
        else
            $data = ['status' => false, 'data' => []];
        return $data;
    }
}