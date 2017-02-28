<html>

   <hr />   
    
<?php
	session_start();
  if (isset($_SESSION["mcQuestion"])) {
  }

  if (isset($_SESSION["tfQuestion"])) {
  }

  if (isset($_SESSION["saQuestion"])) {

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

   	write_to_datafile($datafile, $data);
   // read from file and display data in a table
   $file_data = readfile($filename);
   if (!empty($file_data))
   {
?>
      <table id="data" style="display:none" border="1" align="center" cellpadding="3" width="20%">
        <tr>
          <th>Question</th>
          <th>Answer(s)</th>       
        </tr>
<?php  
      while ($curr_line = each($file_data))    // each value of a $data array is a line from the file
      {
         $v_line = $curr_line["value"];        // each value is a string of scores separated by a comma
?>
         <tr> 
<?php        
         // to use individual scores, split the value 
         $splitted_answers = split("\,", $v_line);
         while ($curr_q = each($splitted_answers))
         {
            $v_q = $curr_q["value"];      // each project score value
            if (!empty($v_q))
               echo "<td align='center'>$v_q</td>";
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
    reset($data);
    return $data;
   }  

   function write_to_datafile($filename, $data)
   {
//       if (!file_exists($filename))
//          echo "File does not exist";
//       else
//          echo "File exists";
      
      $file = fopen($filename, "a");      // if the file doesn't exist, create a new file
      // chmod($filename, 0775);             // set permission. 
                                          // Note: consider chmod 755 here but 777 when manually creating a file
                                          //    who is the owner?
      fputs($file, $data."\n");
      fclose($file);
   }

?>