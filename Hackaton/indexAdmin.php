<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php require_once("includes.php");?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/index.css" type="text/css" rel="stylesheet"/>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA7_Gkmk-M58yWEffgL7FPw8FZc9qroJbE&sensor=true"></script>
        <script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobubble/src/infobubble.js"></script>
        <script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
        <script src="js/Label.js" type="text/javascript"></script>
        <script src="js/mapScripts.js" type="text/javascript"></script>
    </head>
    <body>
        
            <div id="menu">
                <span>Bine ai venit, <i><?php echo $_SESSION['username']; ?></i> <a href="logout.php">logout</a></span>
                <a class="button1 green" id = "send_request">Trimite requesturi</a>
                <a class="button1 red disabled" id="delete_request">Sterge</a>
                <a class="button1 blue" id="reset_network">Reseteaza alocari</a>
                <div id="availability-cont"></div>
            </div>
            <div id="map_canvas">
                
            </div>
    </body>
</html>
