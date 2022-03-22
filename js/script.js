function addForm() {
  $formNr=$(".inputs").length;
  $formNr=$formNr+1;
  $(".inputs:last").after(`
  <div class="inputs" >
  <div class="inputs-fields">
      <div class="inputs-fields-heading"><h2>Avnasa norēķins nr:`+$formNr+`</h2></div>
      <div class="inputs-fields-single">
          <label>Dokumneta datums</label>
          <input type="date" name="doc-date[]" required class="form-control" />
      </div>
      <div class="inputs-fields-single">
          <label>Dokumenta nr.</label>
          <input type="text" name="doc-nr[]" required class="form-control" />
      </div>
      <div class="inputs-fields-single">
          <label>Uzņēmums/ iestāde, kas izsniedza dokumentu</label>
          <input type="text" name="doc-company[]" required class="form-control" />
      </div>
      <div class="inputs-fields-single">
          <label>Summa ar PVN</label>
          <input type="text" name="doc-sum[]" required class="form-control" />
      </div>
  </div>
  <div class="inputs-fields">
      <div class="inputs-fields-single padding-top">
          <label >Komentārs/ iemesls, kam izlietoti līdzekļi</label>
          <textarea name="doc-comment[]" required class="form-control"></textarea>
      </div>
      <div class="inputs-fields-single img-field">
          <label>Pievienot attēlu:</label>
          <input id="img" class="custom-file-input form-control" type="file" name="img[]" accept="image/*" onchange="updateList();" required>
          <div></div>
      </div>
  </div>
</div>
  `);
}
function deleteForm() {
  $inputs=$(".inputs").length;
  if($inputs > 1){
    if(confirm("Vai tešām vēlaties dzēst?")){
      $("#form_id")[0].reset();
    }
  }else{
    if(confirm("Vai tešām vēlaties dzēst ievadītos datus?")){
      $('#form_id')[0].reset();
    }
  }
}

function validateFields() {
  $isEmpty = false;

  $('.form-control').each(function() {
    if($(this).val() == '') {
      $isEmpty = true;
    }
  });

  if($isEmpty) {
    $(".alert-box").html("<p>Lai turpinātu jāaizpilda visi lauki</p>");
    $( ".alert-box" ).removeClass( "none" );
  } else {
    $( ".alert-box" ).addClass( "none" )
    addForm();
  }
}

function resetForm(){
  $("#form_id")[0].reset();
  $('.btn-cont').addClass('none');
  $('.btn-submit').removeClass('none');
  $('.suc-box').addClass('none');  
}

function updateList() {
  $('.img-field').on('change', '#img', function () {
    var filePath=$(this).val(); 
    $fileName = filePath.split('\\').pop();
    console.log($next = $(this).next());
    $next.html('<p>'+$fileName+'</p>');
  });
}

function updateId(a) {
var check_id = $(a).attr('data-value');
    $.ajax({
        type: "POST",
        url: "includes/update-handler.inc.php",
        data: {idu: check_id},
        success: function(data){
          if(data.status == "success"){
            $(a).addClass('green');
            $(a).html('Ir apstiprināts');
            $(a).attr('disabled','disabled');
            $('.date-'+check_id).html(data.message);
          }else if(data.status == "error"){
            alert('Kļuda mēģiniet vēlreiz!');
          }
        }
    });
return true;
}

function selectSet(a) {
var check_id = $(a).attr('data-value');
    $.ajax({
        type: "POST",
        url: "includes/select-handler.inc.php",
        data: {ids: check_id},
        success: function(data){
          if(data.status == "success"){
            $("#s-container-"+check_id).html(data.message);
            $(a).addClass('none');
            $('.btn-r-'+check_id).removeClass('none');
          }else if(data.status == "error"){
            alert('Kļuda mēģiniet vēlreiz!');
          }
        }
    });
return true;
}

function hide(a) {
  var check_id = $(a).attr('data-value');
  $("#s-container-"+check_id+" div").remove();
  $(a).addClass('none');
  $('.btn-s-'+check_id).removeClass('none');
}
