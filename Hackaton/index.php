<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
        <script src="js/jquery-form.js" type="text/javascript"></script>
        <title></title>
    </head>
    <body>
        <form action="ajax/login.php" method="POST" id="loginForm">
        Username <input type = "text" name="username"/>
        Password <input type = "password" name="password"/>
        <input type ="submit" value ="Login"/>
        </form>
        <script>
            $('#loginForm').ajaxForm({
            dataType:"json",
            beforeSubmit:function(){
              
            },
            success:function(rdata){
                 if(rdata == '-1'){
                    alert('fail')
                }
                else{
                    alert('id-ul tau: ' + rdata);
                }
            }
           });
        </script>
    </body>
</html>
