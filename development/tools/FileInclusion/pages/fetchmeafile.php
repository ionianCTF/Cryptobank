<html>
   <head>
      <meta charset="utf-8">
      <title>Fetch me a file</title>
   </head>

   <body>    
      <div style="background-color:#c9c9c9;padding:15px;">
      <button type="button" name="homeButton" onclick="location.href='../../homepage.html';">Home Page</button>
      <button type="button" name="mainButton" onclick="location.href='fileinc.html';">Main Page</button>  
      </div>
      
      <div align="center"><b><h3>Fetch a file</h3></b></div>
      <div align="center">
      <a href=fetchmeafile.php?file=file.txt><button>Give me the file</button></a>
      </div>
      
      <?php
        echo "</br></br>";
        
        if (isset( $_GET[ 'file' ]))        
        {
          @include($_GET[ 'file' ]);
          echo"<div align='center'><b><h5>".$_GET[ 'file' ]."</h5></b></div> ";       
        }
      ?>
   </body>
</html>

