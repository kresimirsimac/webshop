<html>
<head>
    <title>CSV file insert</title>
</head>
<body>
<form method="post" name="uploadCVS" action="insert_handler.php" enctype="multipart/form-data">
    <fieldset>
        <label>Choose CSV</label><br/><br/>
        <input type="file" name="file" accept=".csv" required/><br/><br/>
        <input type="submit" name="import" value="Import!"/><br/><br/>
    </fieldset>
</form>
</body>
</html>
