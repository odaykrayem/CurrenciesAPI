<?php
   
 include_once dirname(__FILE__).'/operation.php';

 $response=array(); 
 if($_SERVER['REQUEST_METHOD']=='POST'){
    if(!isset($_POST['image_id']))
    {
        $data['status'] = "error";
        $data['message'] = "Error get result no id provided";
    }else
    {
        $db = new Operations();
        $data = $db->getResult($_POST['image_id']);
        if($data['result'] != null){
            $result['status'] = "success";
            $result['message'] = "get result successfully";
            $result['result'] = $data['result'];    
        
         }else{
            $result['status'] = "failed";
            $result['message'] = "No result yet";
         }
    }
    echo json_encode($result);

}


?>