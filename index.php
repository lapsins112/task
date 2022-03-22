<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avansa norēķinu iesniegšana</title>
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
</head>
<body>
    <div class="container">
        <div class="heading">
            <h1>Avansa norēķinu iesniegšana.</h1>
            <a class="page-btn" href="report.php">Atskaites</a>
        </div>
        <form id="form_id" method="post" enctype="multipart/form-data">
            <div class="inputs" >
                <div class="inputs-fields">
                    <div class="inputs-fields-heading">
                        <h2>Avnasa norēķins nr:1</h2>
                    </div>
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
                        <input type="text" name="doc-company[]"  class="form-control" />
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
            <div class="input-btn">
                <div class="alert-box none"></div>
                <div class="suc-box none"></div>
                <div class="funcion-btn">
                    <input class="btn btn-add" type="button" value="+" onclick="validateFields();">
                    <input class="btn btn-delete" type='button' value='-' onclick="deleteForm();">
                </div>
                <input id="upload" class="btn-submit" name="submit" type="submit" value="Iesniegt">
                <input class="btn-cont none" type="submit" value="turpināt" onclick="resetForm()">
            </div>
        </form>
    </div>
<script type="text/javascript" src="js/form.js"></script>
</body>
</html>