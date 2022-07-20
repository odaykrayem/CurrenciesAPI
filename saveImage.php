<?php
   
 include_once dirname(__FILE__).'/operation.php';

 $response=array(); 
 if($_SERVER['REQUEST_METHOD']=='POST'){
    if(!isset($_FILES['fileToUpload']) ||$_FILES['fileToUpload']['error'] == UPLOAD_ERR_NO_FILE)
    {
        $data['status'] = "error";
        $data['message'] = "Error on uploading files";
    }else
    {
        $db = new Operations();
        $data = $db->multiProfileUpload_("images/",$_FILES);
    }
    echo json_encode($data);

}


?>