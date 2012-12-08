<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/index.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
        <script src="js/jquery-form.js" type="text/javascript"></script>
        <title></title>
    </head>
    <body>
        <div id="form_container">
            <div style="text-align:center">
                <img src="images/state_1.png"/>
            </div>
        <form action="ajax/login.php" method="POST" id="loginForm">
            <table>
                <tr>
                    <td>Username</td>
                    <td><input type = "text" name="username"/></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type = "password" name="password"/></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;"><input type ="submit" value ="Login" class="button1 blue"/></td>
                </tr>
                <tr>
                    <td colspan="2" style="color:red;" id="msg"></td>
                </tr>
            </table>
         
         
        
        </form>
        </div>
        <script>
            $('#loginForm').ajaxForm({
            dataType:"json",
            beforeSubmit:function(){
              
            },
            success:function(rdata){
                 if(!rdata['result']){
                     $("#msg").text("Autentificare nereusita");
                }
                else{
                    if (rdata['admin'] == 1) window.location = "indexAdmin.php";
                    else window.location = "indexUser.php";
                }
            }
           });
        </script>
    </body>
</html>
