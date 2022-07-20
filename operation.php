<?php
class Operations
{
   private $con;
   function __construct()
   {
      require_once dirname(__FILE__) . '/DbConnect.php';
      $db = new DbConnect();
      $this->con = $db->connect();
      
   }
   function multiProfileUpload_($target_dir, $files)
   {
      for ($i = 0; $i < count($files); $i++) {
         $uploadOk = 1;
         $filename = uniqid();
         $imageFileType = pathinfo($files["fileToUpload"]["name"], PATHINFO_EXTENSION);
         $target_file = $target_dir . $filename . "." . $imageFileType;
         $name = $filename . "." . $imageFileType;

         move_uploaded_file($files["fileToUpload"]["tmp_name"], $target_file);
         $profile_pic = dirname(__FILE__) . $target_dir . $name;
         $stmt = $this-> con->prepare("INSERT INTO `images` (`image`) VALUES (?);");
         $stmt->bind_param("s",$profile_pic);



         if($stmt->execute()){
            $result['status'] = "success";
            $result['message'] = "Image uploaded successfully";
            $result['path'] = $profile_pic;    
            $imageId = $this-> con->insert_id;
            $result['id'] = $imageId;
    
         }else{
            $result['status'] = "failed";
            $result['message'] = "Please try again later";
         }

         // $query = "UPDATE user_profile SET profile_pic = '$profile_pic' where user_id = $user_id;";
         // mysql_query($query);
      

      }
      return $result;
   }


   public function getResult($imgId) 
   {
       $stmt = $this-> con->prepare("SELECT result FROM `images` WHERE id = ?;");
       $stmt->bind_param("s",$imgId);
       $stmt->execute();
      return $stmt->get_result()->fetch_assoc();
   }
}
