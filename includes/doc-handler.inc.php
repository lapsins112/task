<?php
require_once("class-autoload.inc.php");

function newSelectOb(){
    $select = "SELECT d.id, d.date, d.a_sum, ds.s_date, ds.d_status 
        FROM document d 
        INNER JOIN document_status ds ON ds.doc_id = d.id";
    $ob = new DBOperations;
    $ob = $ob->getData($select);
    return $ob;
}
function printData($results){
    while($row = $results->fetch_assoc()) {
        echo "
        <div class='doc'>
            <div class='doc-single'>
                <h2 class='doc-single-heading'>Dokuments nr:</h2>
                <h3 class='doc-single-heading'>".$row['id'].".</h3>
            </div>
            <div class='doc-single'>
                <h2 class='doc-single-date'>Izveidošanas datums:</h2>
                <h3 class='doc-single-date'>".$row['date']."</h3>
            </div>
            <div class='doc-single'>
                <h2 class='doc-single-companny'>Summa kopā:</h2>
                <h3 class='doc-single-companny'>".$row['a_sum']." €</h3>
            </div>
            <div class='doc-single'>
                <h2 class='doc-single-edit-date'>Apstiprināšanas datums:</h2>
                <h3 class='doc-single-edit-date date-".$row['id']."'>".($row['d_status'] == 1 ? $row['s_date'] : 'nav apstiprināts')."</h3>
            </div>
            <div class='doc-single'>
                <button id='btn-update' class='btn-update ".($row['d_status'] == 1 ? 'green' : '')."' data-value='".$row['id']."' 
                onclick='updateId(this);' ".($row['d_status'] == 1 ? 'disabled' : '').">".($row['d_status'] == 1 ? 'Ir apstiprināts' : 'Apstiprināt')."</button>
            </div>
            <div class='doc-single'>
                <button id='btn-select' class='btn-select btn-s-".$row['id']."' data-value='".$row['id']."' onclick='selectSet(this);'>Apskatīt</button>
            </div>
            <div class='doc-single'>
                <button id='btn-remove' class='btn-remove none btn-r-".$row['id']."' data-value='".$row['id']."' onclick='hide(this);'>Aizvērt</button>
            </div>
        </div>
        <div id='s-container-".$row['id']."'></div>";
    }
}

