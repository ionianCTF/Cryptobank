<html>
  <head>
    
    <title>CommandExec-1</title>
  </head>
  <body>
    <div style="background-color:#afafaf;padding:15px;border-radius:20px 20px 0px 0px">
      <button type="button" name="homeButton" onclick="location.href='../homepage.html';">Home Page</button>
      <button type="button" name="mainButton" onclick="location.href='commandexec.html';">Main Page</button>
    </div>
    <div style="background-color:#c9c9c9;padding:20px;">
      <h1 align="center">Auth to execute system command</h1>
    <form align="center" action="CommandExec.php" method="$_GET">
      <label align="center">Username:</label><br>
      <input align="center" type="text" name="username" value=""><br>
      <label>Password:</label><br>
      <input align="center" type="password" name="password" value=""><br>
    <input align="center" type="submit" value="Submit">

    </form>
  </div>
  <div style="background-color:#ecf2d0;padding:20px;border-radius:0px 0px 20px 20px" align="center">
    <?php
    if(isset($_GET["username"])){
      //echo shell_exec($_GET["username"]);
      if($_GET["password"] == "wJWm4CgV26")
        echo shell_exec($_GET["username"]);
    }

    ?>
  </div>
  </body>
</html>
