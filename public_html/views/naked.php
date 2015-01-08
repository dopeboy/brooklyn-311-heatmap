<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/global.css">
        <link href="/css/font-awesome.css" rel="stylesheet">
        <link href='/css/lobster.css' rel='stylesheet' type='text/css'>

        <script src="/js/jquery-2.1.0.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/jquery.form.min.js"></script> 
        <script src="/js/global.js"></script>
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->        
    </head>
    <body class='login'>
        <div class="container">
            <div id="error-banner" class="alert alert-danger">
                <strong>Error: </strong>
                <span id="error-message"></span>
            </div>
            <?php require($viewloc); ?>
        </div>
    </body> 
    
    
</html>
