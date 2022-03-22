<?php
require_once("class-autoload.inc.php");

if(isset($_POST['ids'])){
    fetchData($_POST['ids']);
}

function fetchData($id){
    if(!empty($id)){    
        $set="";
        $query="SELECT * from settlements WHERE doc_id = '$id'";
        $ob = new DBOperations;    
        $ob = $ob->getData($query);
        while($row = $ob->fetch_assoc()) {
        
        $set .= "
        <div class='settl'>
            <div class='settl-single'>
                <div class='settl-single-img'>
                    <img src='".$row['doc_picture']."' alt='".$row['doc_nr']." '>
                </div>
            </div>
            <div class='settl-single'>
                <div class='settl-single-detail'>
                    <h4>Dokumneta datums</h4>
                    <h5>".$row['doc_date']."</h5>
                    <h4>Dokumenta nr.</h4>
                    <h5>".$row['doc_nr']."</h5>
                    <h4>Uzņēmums/ iestāde, kas izsniedza dokumentu</h4>
                    <h5>".$row['doc_company']."</h5>
                </div>
            </div>
            <div class='settl-single'>
                <div class='settl-single-detail'>
                    <h4>Summa ar PVN</h4>
                    <h5>".$row['doc_sum']." €</h5>
                    <h4>Komentārs/ iemesls, kam izlietoti līdzekļi</h4>
                    <h5>".$row['doc_comment']."</h5>
                </div>
            </div>
        </div>";
        
        } 
        $data['message'] = $set;
        $data['status'] = "success";
    }else{
        $data['status'] = "error";
    }
      header('Content-type: application/json');  
      echo json_encode($data);
}