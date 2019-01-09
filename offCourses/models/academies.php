<?php
include 'connection.php';

class Academies {
    private $tableName = 'academy';
    private $imagesDir = 'images/academies/';

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
     public static function create($name, $email, $password, $address) {
        
        $name = addslashes($name);
        $email = addslashes($email);
        $address = addslashes($address);
        
        $password = md5($password);
        $_this = new self;

        global $con;

        $query = 'INSERT INTO ' . $_this->tableName .
            '(name, email, password, address)
            VALUES 
            ("' . $name . '","' . $email . '","' . $password . '","' . $address . '")';
        if ($con->query($query) === true) {
            $data = ['status' => true, 'data' => Academies::getById($con->insert_id) ];
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

    public static function updateProfile($id, $name, $password = null, $phone_no = null, $address = null, $image = null)
    {

        $name = addslashes($name);

        $passwordUpdate = '';
        if ($password != null)
            $passwordUpdate = ', password="' . md5($password) . '"';

        $phone_noUpdate = '';
        if($phone_no != null)
            $phone_noUpdate = ', phone_no = "'.addslashes($phone_no).'"';

        $addressUpdate = '';
        if($address != null)
            $addressUpdate = ', address = "'.addslashes($address).'"';
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
        $query = 'UPDATE ' . $_this->tableName . ' SET name="' . $name . '" ' . $passwordUpdate . '' . $phone_noUpdate . '' . $addressUpdate . '' . $imageUpdate . ' WHERE id=' . $id;
        if ($con->query($query) === true) {
            $data = ['status' => true, 'message' => 'Record updated successfully'];
        } else {
            $data = ['status' => false, 'message' => "Error: " . $query . "<br>" . $con->error];
        }
        return $data;
    }

    public static function addInstructor($academy_id, $instructor_email)
    {

        $instructor_email = addslashes($instructor_email);

        // check instructor email
        $instructor_id = Instructors::getIdForEmail($instructor_email);
        if($instructor_id == -1)
            return ['status' => false, 'message' => 'wrong  instructor email' ];

        // check if this instructor is part of this academy
        if( Academies::isOneOfUs($academy_id,$instructor_id))
            return ['status' => true, 'message' => 'instructor already there'];

        
        $_this = new self;
        global $con;
        $query = 'INSERT INTO ' . 'academy_has_instructors' .
            '(academy_id, instructor_id)
            VALUES 
            (' . $academy_id . ',' . $instructor_id . ')';
        if ($con->query($query) === true) {
            $data = ['status' => true, 'message' => '' ];
        } else {
            $data = ['status' => false, 'message' => 'repeated combination' ];
        }
        return $data;
    }
    public static function removeInstructor($academy_id, $instructor_id)
    {


        // check if this instructor is part of this academy
        if( !Academies::isOneOfUs($academy_id,$instructor_id))
            return ['status' => false , 'message' => 'instructor is not there'];

        
        $_this = new self;
        global $con;
        $query = 'DELETE FROM ' . academy_has_instructors . ' WHERE academy_id=' .$academy_id . ' And instructor_id='.$instructor_id;
        if ($con->query($query) === true) {
            $data = ['status' => true, 'message' => 'Delete successfully'];
        } else {
            $data = ['status' => false, 'message' => "Error: " . $query . "<br>" . $con->error];
        }
        return $data;
    }

    public static function isOneOfUs($academy_id, $instructor_id)
    {
        $_this = new self;
        global $con;
        $query = 'SELECT * FROM ' . 'academy_has_instructors' . ' WHERE academy_id=' . $academy_id . ' AND instructor_id='. $instructor_id.' LIMIT 1'; 
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result)==0) 
        { 
            return false; 
        }
        return true;
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

    public static function getNameById($id)
    {
        $_this = new self;
        global $con;
        $query = 'SELECT name FROM ' . $_this->tableName . ' WHERE id="' . $id . '" LIMIT 1';
        $result = mysqli_query($con, $query);
        $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $result['name'];
    }

    public static function getAllAcademiesForInstructorWithId($instructor_id, $limit = null)
    {
        $_this = new self;
        global $con;
        $limitEdit = ''; 
        if($limit != null)
            $limitEdit = ' LIMIT '.$limit;
        $query = 'SELECT * from '.$_this->tableName.' join academy_has_instructors on '.$_this->tableName.'.id = academy_has_instructors.academy_id where academy_has_instructors.instructor_id = '.$instructor_id.$limitEdit;
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result)==0) 
        { 
            return ["status" => false, "data" => []]; 
        }
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return ["status" => true, "data" => $result];
    }
    
}