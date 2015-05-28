<?php include 'header.php'; ?>
      
      <h1>Uploaden</h1>
      
		<form method="post" enctype="multipart/form-data">
            <table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
            <tr>
            <td width="246">
            <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
            <input name="userfile" type="file" id="userfile">
            </td>
            <td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td>
            </tr>
            </table>
        </form>
        
        <?php
        include 'DATABASECONNECT.PHP'; //hier nog even de database includen
		
			if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
			{
				$fileName = $_FILES['userfile']['name'];
				$tmpName  = $_FILES['userfile']['tmp_name'];
				$fileSize = $_FILES['userfile']['size'];
				$fileType = $_FILES['userfile']['type'];
				$fp      = fopen($tmpName, 'r');
				$content = fread($fp, filesize($tmpName));
				$content = addslashes($content);
				fclose($fp);
				
				if(!get_magic_quotes_gpc())
				{
					$fileName = addslashes($fileName);
					$filePath = addslashes($filePath);
				}
				

				
				$query = "INSERT INTO DATABASE (name, size, type, content ) ". //naam van de database?
				"VALUES ('$fileName', '$fileSize', '$fileType', '$content')";
				mysql_query($query) or die('Error, query failed');	
				
				echo "<br>$fileName is geupload.<br>";	//redirect naar volgende pagina hier?
			}
		?>
        
        <br /><br />
        
        <br /><br />
        
      
    
<?php include 'footer.php'; ?>    
