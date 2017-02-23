<html>
<head>
  <title>Simple form handler</title>
</head>

<body bgcolor="#EEEEEE">
  <center><h2>Simple Form Handler</h2></center>
  <p>
    The following table lists all parameter names and their values that were submitted from your form.
  </p>

  <table cellSpacing=1 cellPadding=1 width="75%" border=1 bgColor="lavender">
    <tr bgcolor="#FFFFFF">
      <td align="center"><strong>Parameter</strong></td>
      <td align="center"><string>Value</string></td>
    </tr>
    <tr>
      <td width="20%">MC Question</td> 
      <td><?php echo $_POST['mcQuestion']?></td>      
    </tr>
    <tr>
      <td width="20%">MC Answer A</td> 
      <td><?php echo $_POST['MCa']?></td>      
    </tr>
    <tr>
      <td width="20%">MC Answer B</td> 
      <td><?php echo $_POST['MCb']?></td>      
    </tr>
    <tr>
      <td width="20%">MC Answer C</td>
      <td><?php echo $_POST['MCc']?></td>      
    </tr>
    <tr>
      <td width="20%">MC Answer D</td>
      <td><?php echo $_POST['MCd']?></td>      
    </tr>
    <tr>
      <td width="20%">TF Question</td>
      <td><?php echo $_POST['tfQuestion']?></td>      
    </tr>
    <tr>
      <td width="20%">TF Answer</td>
      <td><?php echo $_POST['TF']?></td>      
    </tr>
    <tr>
      <td width="20%">SA Question</td>
      <td><?php echo $_POST['saQuestion']?></td>      
    </tr>
    <tr>
      <td width="20%">SA Answer</td>
      <td><?php echo $_POST['saAnswer']?></td>      
    </tr>  
  </table>

</body>
</html> 