<html>

   <hr />   
    
<?php
	session_start();
  if (isset($_POST["mcQuestion"])) {
  session_unset();
  $_SESSION["mcQuestion"] = $_POST["mcQuestion"];
  $_SESSION["MCa"] = $_POST["MCa"];
  $_SESSION["MCb"] = $_POST["MCb"];
  $_SESSION["MCc"] = $_POST["MCc"];
  $_SESSION["MCd"] = $_POST["MCd"];
}

if (isset($_POST["tfQuestion"])) {
  session_unset();
  $_SESSION["tfQuestion"] = $_POST["tfQuestion"];
  $_SESSION["TF"] = $_POST["TF"];
}

if (isset($_POST["saQuestion"])) {
  session_unset();
  $_SESSION["saQuestion"] = $_POST["saQuestion"];
  $_SESSION["saAnswer"] = $_POST["saAnswer"];
}


	$data = "";
   while ($curr = each($_SESSION)) 
   {
      $k = $curr["key"];
      $v = $curr["value"];

      if (!empty($data))
         $data = $data.",";
      
      $data = (string)$data.(string)$v;    
   }

    $filename = "/Applications/XAMPP/htdocs/cs4640/Assignment3/test-data.txt";

   	$datafile = "/Applications/XAMPP/htdocs/cs4640/Assignment3/actual-data.txt";
    if (!empty($data)) {
   	write_to_datafile($datafile, $data);
   }
   ?>
   <hr />   
    
<?php
   // read from file and display data in a table
   $file_data = readfile($datafile);
   if (!empty($file_data))
   {
    $questions = explode(",", $file_data);
?>
      <table id="data" style="display:block" border="1" align="center" cellpadding="3" width="20%">
        <tr>
          <th>Question</th>
          <th>Answer(s)</th>       
        </tr>
<?php  

         while($curr=each($questions))
         {
         $v_line = array_slice($questions, 1);        
?>
         <tr> 
<?php        
         while ($curr_q = each($v_line))
         {
            $v_q = $curr_q;      // each project score value
            //if (!empty($v_q))
               //echo "<td align='center'>$v_q</td>";
         }    
?>
         </tr>  
        <?php
      }
      ?>
      </table>
<?php
  }
?>

</html>

<?php

	function extract_data()
   {
    $data = array();

      // To retrieve all param-value pairs from a post object
    foreach ($_POST as $key => $val)
      {
         $data[$key] = $val;      // record all form data to an array
      }
    // reset($data);
    return $data;
   }  

   function write_to_datafile($filename, $data)
   {
      
      $file = fopen($filename, "a");      // if the file doesn't exist, create a new file
      // chmod($filename, 0775);             // set permission. 
                                          // Note: consider chmod 755 here but 777 when manually creating a file
                                          //    who is the owner?
      fputs($file, $data."\n");
      fclose($file);
   }

   function read_file($filename)
   {
      $file = fopen($filename, "r");      // r: read only
      $data_array = "";

      while (!feof($file)) 
      {
         $data_array[] = fgets($file);
      }
      fclose($file);
      return $data_array;
   }
?>