<?php
require_once("class-autoload.inc.php");

if(isset($_POST['idu'])){
    $id = $_POST['idu'];
    $update = "UPDATE document_status SET d_status = 1 WHERE doc_id = '".$id."'";
    $updOb = new UpdateRun;
    $updOb = $updOb->getQuery($update);
    $response = $updOb;

    $query="SELECT s_date from document_status WHERE doc_id = '$id'";
    $obS = new DBOperations;    
    $obS = $obS->getData($query);
    while($row = $obS->fetch_assoc()) {
        $response['message'] = $row['s_date'];
    }
}else {
    $response['status'] = 'error';
    
}

if(!empty($response['status'])){
    header('Content-type: application/json');
    echo json_encode($response);
   
}

?>