<!DOCTYPE html>
<html>
<head>

	<!--Meta and 1711 Delivered icon-->
	<meta charset="utf-8">
	<meta name="description" content="An exhibition website fo 1711 delivered">
    <meta name="author" content="Ibekwe Chigozirim">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="png/jpg/gif" href="images/logo.png" alt="1711 delivered">

	<!--js-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

	<title>1711 DELIVERED</title>

	<!--css, fontawesome and other links-->
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/nav.css">
	<link rel="stylesheet" type="text/css" href="css/maincontent.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



	<!--Script for fadein/fadeout menu-->
	<script>
		$(document).ready(function(){
  			$("#menuHeaderMenu").click(function(){
    			$("#menuHeaderNavbar").fadeIn();
  			});
  			$("#menuHeaderClose").click(function(){
    			$("#menuHeaderNavbar").fadeOut();
  			});
		});
	</script>
</head>
<body>
	<!--Header Content-->
	<header id="navbar">
		<div class="menu-header">
        	<a href="index.php" class="menu-header-text">1711 Delivered.</a>
        	<a href="#" class="menu-header-menu" id="menuHeaderMenu">Menu</a>
      	</div>
    </header>
    <nav class="menu-header-navbar" id="menuHeaderNavbar">
      	<a href="index.php" class="menu-header-navbar-text">1711 Delivered.</a>
        <a href="#" class="closebutt" id="menuHeaderClose">Close</a>
        <div class="menu-header-navbar-content">
        	<ul class="menu-header-navbar-list">
            	<li><a href="index.php">Rowdyb-Gwen</a></li>
            	<li><a href="#" style="color:#545454; text-decoration:line-through;">4fathers Campaign</a></li>
            	<li><a href="begho.php">Beghofromthematrix-twofaced</a></li>
            	<li><a href="lsd.php">Lsd Shoot</a></li>
            	<li><a href="evisu.php">Evisu Song Cover</a></li>
           	</ul>
           	<p>john.faboyo@gmail.com</p>

           	<ul class="menu-header-navbar-list-socials">
            	<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
             	<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
             	<li><a href="#"><i class="fa fa-vine" aria-hidden="true"></i></a></li>
             	<li><a href="#"><i class="fa fa-rebel" aria-hidden="true"></i></a></li>
           	</ul>
           	<p class="AlfredMichael">&copy;Developed By Fredthedev</p>
        </div>
    </nav>

    <!--Main Content-->
    <main class="main-content">
    	<div class="main-content-row">
    		<div class="main-content-row-column main-content-row-column-left">
    			<?php
                    include ("admin/config.php");
                    // Attempt select query execution
                    $sql = "SELECT * FROM fatherscamptext LIMIT 1";
                    $result = mysqli_query( $conn, $sql);
                    while($row = mysqli_fetch_array($result)){
                ?>
    			<h2 class="main-content-row-column-header"><?php echo $row['title']; ?></h2>
    			<p><?php echo $row['description']; ?></p>
    			<?php } ?>
    		</div>
    		<div class="main-content-row-column main-content-row-column-right">
    			<?php
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM fatherscampimg";
                    $result = mysqli_query( $conn, $sql);
                    while($row = mysqli_fetch_array($result)){
                ?>
    			<div class="main-content-row-column-right-element">
    				<img src="admin/images/imgFather/<?php echo $row['fathersimage']; ?>" alt="<?php echo $row['altimage']; ?>" >	
    			</div>
    			<?php } ?>
    			
    		</div>
    		<div class="main-content-row-column-f main-content-row-column-bottom">
    			<p>Mail: john.faboyo@gmail.com</p>
    			<p>Insta:1711 Delivered</p>
    		</div>
    	</div>
    </main>
    

</body>

</html>