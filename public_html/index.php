<?php

    session_start();

    // Kill the session if the last request was over 60*60*3 seconds or 3 hours ago
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) 
    {
        session_unset();     // unset $_SESSION variable for the run-time 
        session_destroy();   // destroy session data in storage
    }

    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp;
    
    // config file
    require("../config.inc");

    // common functions & globals
    require("../common.inc");

    // exception classes
    require("exception.php");
    
    // require the general classes
    require("loader.php");
    require("controller.php");
    require("model.php");

    // require the model classes
    require("models/complaints.php");
    require("models/keys.php");
    require("models/agencies.php");
    require("models/complainttypes.php");

    // require the controller classes
    require("controllers/complaints.php");
    require("controllers/keys.php");
    require("controllers/agencies.php");
    require("controllers/complainttypes.php");
    
    // enums
    require("enum.php");
    
    // validator methods
    require("validator.php");

	// This is an API so..
	header('Access-Control-Allow-Origin: *');  

    error_log("------------------------------------------------------------");
    error_log("------------------------------------------------------------");
    error_log("request method: " . $_SERVER['REQUEST_METHOD']);
    error_log("post: " . print_r($_POST,true));
    error_log("get: " . print_r($_GET,true));
    error_log("files: " . print_r($_FILES,true));
    error_log("session: " . print_r($_SESSION,true));

    $request_method = $_SERVER['REQUEST_METHOD'] == "GET" ? Method::GET : Method::POST;
    
    // Exception handler. Any exception bubbles up to here
    function exception_handler($exception)
    {
        global $request_method;

        // If the exception is a usernotloggedin, save the return URL and redirect them to the signin page
        if (get_class($exception) == "UserNotLoggedInException" && $request_method == Method::GET)
            header('Location: /user/login/null/100?return=' . $_SERVER['REQUEST_URI']);

        else if (get_parent_class($exception) == "BaseException")
        {
            error_log($exception->printMe($request_method));
            echo $exception->printMe($request_method);
        }

        else
        {
            $e = new DatabaseException("Database error.", $exception);
            error_log($exception);
            
            // Kick it back up
            exception_handler($e);
        }        
    }    

    set_exception_handler('exception_handler');     
    
    $loader = new Loader($_GET, $_POST, $_FILES, $_SESSION, $request_method);   
    $controller = $loader->createController();
    $controller->executeAction();
    
    
?>

