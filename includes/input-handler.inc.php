<?php
require_once("class-autoload.inc.php");

$pic = $_FILES['img'];
$dD = $_POST['doc-date'];
$dN = $_POST['doc-nr'];
$dCp = $_POST['doc-company'];
$dS = $_POST['doc-sum'];
$dCm = $_POST['doc-comment'];
$message = "";

if(isset($pic) && isset($dD) && isset($dN) && isset($dCp) && isset($dS) && isset($dCm)){
    
    $count = count($pic['tmp_name']);

    for($i=0; $i<$count;$i++){
        
        if (!preg_match("/^[a-zA-Z0-9 -]*$/",$dN[$i])){
            $dNErr = $i+1 . ". avanas norēķina lauciņā - Dokumenta nr. ievadiet tikai ciparus vai burtus!";
            $message .= $dNErr . "<br>";
        }
        if (!preg_match('/^[a-zA-Z0-9 \āčēģšņūķļĀČĒĢŠŅŪĶĻ$\"\'\?\-]+/',$dCp[$i])){
            $dCpErr = $i+1 . ". avanas norēķina lauciņā - Uzņēmums/ iestāde, kas izsniedza dokumentu ievadiet tikai ciparus vai burtus!";
            $message .= $dCpErr . "<br>";
        } 
        if (!preg_match("/^\d{1,10}(?:\.\d{1,2})?$/",$dS[$i])){
            $dSErr = $i+1 . ". avanas norēķina lauciņā - Summa ar PVN ievadiet tikai ciparus!";
            $message .= $dSErr . "<br>";
        } 
        if (!preg_match("/^[\.a-zA-Z0-9,.!? \āčēģšņūķļĀČĒĢŠŅŪĶĻ$\-]*$/",$dCm[$i])){
            $dCmErr = $i+1 . ". avanas norēķina lauciņā - Komentārs/ iemesls, kam izlietoti līdzekļi ievadiet tikai ciparus vai burtus!";
            $message .= $dCmErr . "<br>";
        }
        
        if(empty($message)){

            if($i==0){
                $sum = "'" . array_sum($dS) . "'";
                $insertQuery = "INSERT INTO document (a_sum) VALUES ($sum)";
                $insertDoc = new DBOperations;
                $insertDoc->setUpdate($insertQuery);
                $id = $insertDoc->getId();
                $insertQuery  = "INSERT INTO document_status (d_status, doc_id) VALUES (0, $id)";
                $insertStat = new DBOperations;
                $insertStat->setUpdate($insertQuery);
            }
            $fs = $pic['size'][$i];
            $fn = $pic['name'][$i];
            $tmn = $pic['tmp_name'][$i]; 
            $file = new FileUpload($fs, $fn, $tmn);
            $fP = $file->getDest();
            $insertS = "INSERT INTO settlements (doc_date, doc_nr, doc_company, doc_sum, doc_comment, doc_picture, doc_id) 
            VALUES ('".$dD[$i]."', '".$dN[$i]."', '".$dCp[$i]."', '".$dS[$i]."', '".$dCm[$i]."', '".$fP."', '".$id."')";
            $insertSingle = new DBOperations;
            
            if(($insertSingle->setUpdate($insertS)) && ($file->upload())) {
                if($i+1 == $count){
                    $message = 'Dokuments veiskmīgi iesniegts!';
                    $status = 'success';
                }
            } else {
                $status = 'error';
            }
        } else {
            $status = 'error';
        }
    }

    $response_array['status'] = $status;
    $response_array['message'] = $message;

} else {
    $message = 'Diemžēl radusies kļuda pārbaudiet ievadītos datus un mēģiniet vēlreiz!';
    $status = 'error';
    $response_array['status'] = $status;
    $response_array['message'] = $message;
}
header('Content-type: application/json');
echo json_encode($response_array);
?>