<?php
include 'connection.php';

class Courses {
    private $tableName = 'course';
    private $imagesDir = 'images/courses/';

    public static function create($academy_id, $instructor_email, $name, $description, $start_date, $finish_date, $price, $image = null)
    {

        $description = addslashes($description);
        $name = addslashes($name);

        $_this = new self;
        global $con;

        // check instructor email
        $instructor_id = Instructors::getIdForEmail($instructor_email);
        if($instructor_id == -1)
            return ['status' => false, 'message' => 'wrong email'];

        // check if this instructor is part of this academy
        if( !Academies::isOneOfUs($academy_id,$instructor_id))
            return ['status' => false, 'message' => 'this instructor is not yours'];

        // date string
        $start_date = date("Y-m-d", strtotime($start_date));
        $finish_date = date("Y-m-d", strtotime($finish_date));
        

        // upload the image
        $imageUpdate = '';
        if ($image != null) {
            $dir = $_this->imagesDir;
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
            $imageUpdate = ' , "' . $image . '"';
        }

        ($imageUpdate != '') ? $imageColumn = 'image' : $imageColumn = '';
        // insert the data
        $query = 'INSERT INTO ' . $_this->tableName .
            '(academy_id, instructor_id, name, description, start_date, finish_date, price, '.$imageColumn.')
            VALUES 
            (' . $academy_id . ', ' . $instructor_id . ',"' . $name . '","' . $description . '","'.$start_date.'","'.$finish_date.'",'.$price.' '.$imageUpdate.' )';
        if ($con->query($query) === true) {
            $data = ['status' => true, 'message' => ''];
        } else {
            $data = ['status' => false, 'message' => mysqli_error($con).'<br>'.$query];
        }  
        return $data;
    
    }

    public static function update($id, $academy_id, $instructor_email, $name, $description = null, $start_date = null, $finish_date = null, $price = null, $image = null)
    {

        $_this = new self;
        global $con;
        $name = addslashes($name);
        

        // check instructor email
        $instructor_id = Instructors::getIdForEmail($instructor_email);
        if($instructor_id == -1)
            return ['status' => false, 'message' => 'wrong email'];


        // check if this instructor is part of this academy
        if( !Academies::isOneOfUs($academy_id,$instructor_id))
            return ['status' => false, 'message' => 'this instructor is not yours'];


        
        $descriptionUpdate = '';
        if($description != null)
            $descriptionUpdate = ', description = "'.addslashes($description).'"';


        
        $start_dateUpdate = '';
        if($start_date != null)
            $start_dateUpdate = ', start_date = "'.date("Y-m-d", strtotime($start_date)).'"';


        $finish_dateUpdate = '';
        if($finish_date != null)
            $finish_dateUpdate = ', finish_date = "'.date("Y-m-d", strtotime($finish_date)).'"';
    
        $priceUpdate = '';
        if($price != null)
            $priceUpdate = ', price = '.$price.' ';


        // upload the image
        $imageUpdate = '';
        if ($image != null) {
            $dir = $_this->imagesDir;

            $query = 'SELECT image FROM ' . $_this->tableName . ' WHERE id=' . $id . ' LIMIT 1';
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
            $imageUpdate = ' , image = "' . $image . '"';
        }


        // update the data
        $query = 'UPDATE ' . $_this->tableName . ' SET name="' . $name . '", academy_id ='.$academy_id.', instructor_id = '.$instructor_id.' ' . $descriptionUpdate . '' . $start_dateUpdate . '' . $finish_dateUpdate . ''.$priceUpdate . '' . $imageUpdate . ' WHERE id=' . $id;

        if ($con->query($query) === true) {
            $data = ['status' => true, 'message' => ''];
        } else {
            $data = ['status' => false, 'message' => mysqli_error($con).'<br>'.$query];
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
 
    public static function delete($id) {
        $_this = new self;
        global $con;

        // delete the image
        $query = 'SELECT image FROM ' . $_this->tableName . ' WHERE id=' . $id . ' LIMIT 1';
        $result = mysqli_query($con, $query);
        $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $filename = $dir.$result['profile_image_url'];
        if (file_exists($filename) && $filename != $dir ) {
            unlink($filename);
          }
        
        $query = 'DELETE FROM ' . $_this->tableName . ' WHERE id=' . "'$id'" . ' LIMIT 1';
        if ($con->query($query) === true) {
            $data = ['status' => true, 'message' => 'Delete successfully'];
        } else {
            $data = ['status' => false, 'message' => "Error: " . $query . "<br>" . $con->error];
        }
        return $data;
    }

    public static function isThisCourseForThisAcademy($course_id, $academy_id)
    {
        $_this = new self;
        global $con;
        $query = 'SELECT id FROM ' . $_this->tableName . ' WHERE academy_id=' . $academy_id . ' AND id='. $course_id.' LIMIT 1'; 
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result)==0) 
        { 
            return false; 
        }
        return true;
    }
     public static function getAllCoursesForInstructor($instructor_id, $limit = null) {
        $_this = new self;
        global $con;

        $limitEdit = ''; 
        if($limit != null)
            $limitEdit = ' LIMIT '.$limit;
    
        $query = 'SELECT * FROM ' . $_this->tableName . ' WHERE instructor_id = '.$instructor_id.' ORDER BY id DESC'.$limitEdit;
        
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result)==0) 
        { 
            return ["status" => false, "data" => []]; 
        }
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return ["status" => true, "data" => $result];
    }
    public static function getAllCoursesForAcademy($academy_id, $limit = null) {
        $_this = new self;
        global $con;

        $limitEdit = ''; 
        if($limit != null)
            $limitEdit = ' LIMIT '.$limit;
    
        $query = 'SELECT * FROM ' . $_this->tableName . ' WHERE academy_id = '.$academy_id.' ORDER BY id DESC'.$limitEdit;
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result)==0) 
        { 
            return ["status" => false, "data" => []]; 
        }
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return ["status" => true, "data" => $result];
    }
}