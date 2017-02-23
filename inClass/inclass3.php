<!doctype html>
<html>
<head>
  <title>Inclass exercise 3: PHP</title>
    <style>
      a:hover
      {
        background-color:white;
      }       
    </style>
 
    <script type="text/javascript">
      function setFocus()
      {
    	  document.forms[0].elements[0].focus();
      }
    </script>
</head>

<body onload="setFocus()">
  <center>
  <h2>Function and form handling in PHP</h2>
  <h2><font color="green">Jason Ellington - jte4hm</font></h2>
  <h2><font color="green">Madeline Watkins - mlw5ea</font></h2>
  <h2>Choose Question Type:</h2>
        <select id="selectQuestion" onchange="update_screen()">
            <option value="ct"> -Choose Type- </option>
            <option value="multiple-choice">Multiple Choice</option>
            <option value="true-false">True/False</option>
            <option value="short-answer">Short Answer</option>
        </select> 
 
        <form id="multiple-choice" style="display:none" method="post" action="inclass3.php" onSubmit="validateInput()">
            MC Question:
            <input type="text" id="mcQuestion" name="mcQuestion" />
              <ul class="answers">
                    Answer 1:
                    <input type="text" name="MCa" value="" id="MCa"/>
                    <br/> Answer 2:
                    <input type="text" name="MCb" value="" id="MCb"/>
                    <br/> Answer 3:
                    <input type="text" name="MCc" value="" id="MCc"/>
                    <br/> Answer 4:
                    <input type="text" name="MCd" value="" id="MCd"/>
                    <br/>
                </ul>
               <button type="submit" value="Submit" onclick="validateInput()">Submit</button>
                <button type="reset"  value="Reset" onclick="reset()">Clear</button>
                <button type="random"  value="random" onclick="random()">Random</button>
        </form>

            <form id="true-false" style="display:none" method="post" action="inclass3.php" onSubmit="validateInput()">
                T/F Question:
                <input type="text" id="tfQuestion" name="tfQuestion" />
                <ul class="answers">
                    Answer:
                    <input type="text" name="TF" value="" id="TF"/>
                </ul>
                <button type="submit" value="Submit" onclick="validateInput()">Submit</button>
                <button type="reset"  value="Reset" onclick="reset()">Clear</button>
                <button type="random"  value="random" onclick="random()">Random</button>
            </form>

            <form id="short-answer" style="display:none" method="post" action="inclass3.php" onSubmit="validateInput()">
                SA Question:
                <input type="text" id="saQuestion" name="saQuestion" /> 
                <br/>
                Answer:
                <textarea rows="4" name="saAnswer" id="saAnswer"></textarea>
                <br/>
                <button type="submit" value="Submit" onclick="validateInput()">Submit</button>
                <button type="reset"  value="Reset" onclick="reset()">Clear</button>
                <button type="random"  value="Random" onclick="random()">Random</button>
            </form>


    <script>
        function update_screen()
     {
      var selected_value = document.getElementById("selectQuestion").value;
        if (selected_value == "multiple-choice") {
          document.getElementById("multiple-choice").style.display = "block";
          document.getElementById("true-false").style.display = "none";
          document.getElementById("short-answer").style.display = "none";
        } else if (selected_value == "true-false") {
        document.getElementById("true-false").style.display = "block";
          document.getElementById("multiple-choice").style.display = "none";
          document.getElementById("short-answer").style.display = "none";
      } else if (selected_value == "short-answer") {
        document.getElementById("short-answer").style.display = "block"; 
        document.getElementById("true-false").style.display = "none";
          document.getElementById("multiple-choice").style.display = "none";  
       }
     }

     function reset() {
      var selected_value = document.getElementById("selectQuestion").value;
      if (selected_value == "multiple-choice") {
            document.getElementById("MCa").value = "";
            document.getElementById("MCb").value = "";
            document.getElementById("MCc").value = "";
            document.getElementById("MCd").value = "";
            document.getElementById("mcQuestion").value = "";
        }
        else if (selected_value == "true-false") {
            document.getElementById("tfQuestion").value = "";
            document.getElementById("TF").value = "";
        }
        else if (selected_value == "short-answer") {
            document.getElementById("saQuestion").value = "";
            document.getElementById("saAnswer").value = "";
        }
     }

     function random() {
        var selected_value = document.getElementById("selectQuestion").value;
        if (selected_value == "multiple-choice") {
            document.getElementById("MCa").value = "1820";
            document.getElementById("MCb").value = "1819";
            document.getElementById("MCc").value = "1816";
            document.getElementById("MCd").value = "1817";
            document.getElementById("mcQuestion").value = "What Year Was UVA Founded?";
        }
        else if (selected_value == "true-false") {
            document.getElementById("tfQuestion").value = "Thomas Jefferson Was the 4th Prsident of the US";
            document.getElementById("TF").value = "false";
        }
        else if (selected_value == "short-answer") {
            document.getElementById("saQuestion").value = "What is the meaning of life?";
            document.getElementById("saAnswer").value = "What makes the meaning of life is people, so you try to be good to people immediately around you and in your broader community. So a lot of my projects are about how I can affect the world in the hundreds of millions. Reid Hoffman";
        }
     }

     function validateInput() 
     {
      if (selected_value == "multiple-choice" && (document.getElementById("MCa").value == "" || document.getElementById("MCb").value == "" || document.getElementById("MCc").value == "" || document.getElementById("MCd").value == "" ||document.getElementById("mcQuestion").value == "")) {
                alert("Please fill out all boxes!");
        }
        else if (selected_value == "true-false" && (document.getElementById("tfQuestion").value == "" || document.getElementById("TF").value == "")) {
                alert("Please fill out all boxes!");
        }
        else if (selected_value == "short-answer" && (document.getElementById("saQuestion").value == "" || document.getElementById("saAnswer").value == "")) {
            alert("Please fill out all boxes!");
        }
     }
    </script>
   

  </center>
  
</body>
</html>

 
<?php
   
   // retrieve data from the form submission
   $project_scores = extract_data();      
   // print_array($project_scores);

   // prepare data to be written to file
   $data = "";
   while ($curr = each($project_scores)) 
   {
      $k = $curr["key"];
      $v = $curr["value"];
      
      if (!empty($data))
         $data = $data.",";
      
      $data = (string)$data.(string)$v;     
   }
   
   # specify a path, using a file system, not a URL
   # [server]    /cslab/home/<em>your-username</em>/public_html/<em>your-project</em>/data/filename.txt
   # [local]     /XAMPP/htdocs/<em>your-project</em>/data/filename.txt
   
   
   $filename = "/Applications/XAMPP/htdocs/cs4640/inClass/data/test-data.txt";    
   
   // if there is nothing, don't write it 
   if (!empty($data))
      write_to_file($filename, $data);
?>
   <hr />   
    
<?php
   // read from file and display data in a table
   $file_data = read_file($filename);
   if (!empty($file_data))
   {
?>
      <table border="1" align="center" cellpadding="3" width="20%">
        <tr>
          <th>project1</th>
          <th>project2</th>
          <th>project3</th>
          <th>project4</th>
          <th>project5</th>
          <th>project6</th>          
        </tr>
<?php  
      while ($curr_line = each($file_data))    // each value of a $data array is a line from the file
      {
         $v_line = $curr_line["value"];        // each value is a string of scores separated by a comma
?>
         <tr> 
<?php        
         // to use individual scores, split the value 
         $splitted_scores = split("\,", $v_line);
         while ($curr_prj = each($splitted_scores))
         {
            $v_prj = $curr_prj["value"];      // each project score value
            if (!empty($v_prj))
               echo "<td align='center'>$v_prj</td>";
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
</body>
</html>


<?php   

   /* Retrieve data from the form submission,
    * Convert project scores to percentages
    * Return an array of project scores
    */
   function extract_data()
   {
      $data = array();
    $project_scores = array();

      // To retrieve all param-value pairs from a post object
      foreach ($_POST as $key => $val)
      {
         $data[$key] = $val;      // record all form data to an array
      }

      $score = 0;
      $total = 1;      // avoid divided by 0 exception
   
      // itearate a data array, access scores and totals for each project,
      // convert raw scores to percentages (which are used to determine the lowest project score)
    reset($data);
      while ($curr = each($data))
      {
         $k = $curr["key"];
         $v = $curr["value"];

         // strpos(string, substring) -- return index or position of the substring in string
         //                              otherwise, return False if not found
         if (strpos($k, "prj") >= 0)
         {
            if (strpos($k, "_total"))
            {
        $total = $v;
        $score = ($score * 100) / $total ;  // percentage
        $project_scores[$k] = $score;     // put percentage in array (final score for each project)
      }
      else
      {
        $score = $v;
      }
         }
         else
            echo "strpos = false";
      }
    // print_array($project_scores);
    return $project_scores;
   }   
   
   function write_to_file($filename, $data)
   {
//       if (!file_exists($filename))
//          echo "File does not exist";
//       else
//          echo "File exists";
      
      $file = fopen($filename, "a");      // if the file doesn't exist, create a new file
      chmod($filename, 0775);             // set permission. 
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
   
   
   #####################################################
   ####### the following code is from in-class 3 #######
   
   function compute_score()  
   {
      $data = array();
      $project_scores = array();
      
      // To retrieve all param-value pairs from a post object
      foreach ($_POST as $key => $val)
      {
         $data[$key] = $val;      // record all form data to an array      
      }
   //   echo "<br />Initial data <br />";
   //   print_array($data);
      
      $score = 0;
      $total = 1;      // avoid divided by 0 exception
     
      // itearate a data array, access scores and totals for each project, 
      // convert raw scores to percentages (which are used to determine the lowest project score)
      reset($data);
      while ($curr = each($data))
      {
         $k = $curr["key"];
         $v = $curr["value"];
      
         // strpos(string, substring) -- return index or position of the substring in string
         //                              otherwise, return False if not found
         if (strpos($k, "prj") >= 0)
         {
            if (strpos($k, "_total"))
            {
               $total = $v;
               $score = ($score * 100) / $total ;  // percentage
               $project_scores[$k] = $score;     // put percentage in array (final score for each project) 
            }  
            else
            {
             $score = $v;         
            }
         }
         else 
            echo "strpos = false";
      }
   //    echo "<br />Convert scores to percentages <br />";
   //    print_array($project_scores);
   
      $project_avg = "";
      if (!empty($_POST['drop_project']))
      {
         $is_drop_project = $_POST['drop_project'];
         if ($is_drop_project == "yes")
            $project_avg = compute_projects_score($project_scores, $is_drop_project) / 5;
         else 
            $project_avg = compute_projects_score($project_scores, $is_drop_project) / 6;
      }
      
      return $project_avg;
   }
   
   function print_array($arr)
   {
      while ($curr = each($arr)):
         $k = $curr["key"];
         $v = $curr["value"];
         //echo "key is $k and value is $v <br/>";
         echo "[ $k => $v ] <br />";
         
      endwhile;
   }
    
   function get_lowest_score($arr)
   {
      $lowest_score = 0;
      if (!empty($arr))
         $lowest_score = min(array_values($arr));      

      return $lowest_score;   
   }
   
   function compute_projects_score($scores, $is_drop_lowest)
   {
      $project_score = 0;
      if ($is_drop_lowest == "yes" && !empty($scores))
         $project_score = array_sum($scores) - get_lowest_score($scores);
      else 
         $project_score = array_sum($scores);
      return $project_score;         
   }

?>
