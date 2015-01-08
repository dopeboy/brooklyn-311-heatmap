<?php

abstract class BaseException extends Exception
{
    protected $user_id = null;
    protected $timestamp = null;
    protected $json = null;
    public $message = null;
    protected $severity = Severity::WARNING;
    
    public function __construct($message,  Exception $previous = null) 
    {
        $this->timestamp = new DateTime();
        $this->message = $message;
        $this->json = json_encode(array ("Exception" => get_class($this), "Severity" => $this->severity, "RequestURI" => $_SERVER["REQUEST_URI"], "Error" => array("Message" => $this->message, "Parent message" => $previous->message, "File" => $this->getFile(), "Line" => $this->getLine(), "Timestamp" => $this->timestamp)),JSON_PRETTY_PRINT);        
        parent::__construct($message, null, $previous);     
    }     
    
    public function printMe($request_method)
    {
        /*if ($request_method == Method::GET)
        {
            $output = "##### START OF EXCEPTION ####";
            $output .= "<pre>" . print_r(json_decode($this->json),true) . "</pre>";
            $output .= "##### END OF EXCEPTION ####";        
            return $output;        
        }
        
        else*/
            return $this->json;
    }
}

class InvalidLoginException extends BaseException
{
    public function __construct( Exception $previous = null) 
    {
        parent::__construct("Invalid email address or password. Please try again.",  $previous);
    }    
}

class UserIsNotAdminException extends BaseException
{
    public function __construct(Exception $previous = null) 
    {
        parent::__construct("You have to be an admin to perform this action.", $previous);
    }       
}

class InvalidPageException extends BaseException
{
    public function __construct( Exception $previous = null) 
    {
        $this->severity = Severity::SEVERE;
        parent::__construct("This page does not exist.",  $previous);
    }       
}

class UserNotLoggedInException extends BaseException
{
    public function __construct( Exception $previous = null) 
    {
        parent::__construct("You must be signed in to commit that action.",  $previous);
    }    
}

class UserAlreadyLoggedInException extends BaseException
{
    public function __construct( Exception $previous = null) 
    {
        parent::__construct("You cannot already be signed in and commit this action. Please sign out and try again.",  $previous);
    }    
}

class UserWithEmailAlreadyExists extends BaseException  
{
    public function __construct($email,  Exception $previous = null) 
    {
        parent::__construct("User with the following email already exists: " . $email,  $previous);
    }    
}

class InvalidZipcodeException extends BaseException
{
    public function __construct( Exception $previous = null) 
    {
        parent::__construct("The supplied zipcode is invalid. Please try again.",  $previous);
    }    
}

class InvalidEmailException extends BaseException
{
    public function __construct( Exception $previous = null) 
    {
        parent::__construct("The supplied email address is invalid.",  $previous);
    }    
}

class RequiredParameterMissingException extends BaseException
{
    public function __construct($parameter_name,  Exception $previous = null) 
    {
        parent::__construct("The following parameter was not specified or empty: " . $parameter_name,  $previous);
    }     
}

class InvalidReviewAttemptException extends BaseException
{
    public function __construct( Exception $previous = null) 
    {
        parent::__construct("Either you weren't involved in the transaction or you've already reviewed it!",  $previous);
    }     
}

class DatabaseException extends BaseException
{
    public function __construct($message,  Exception $previous = null) 
    {
        $this->severity = Severity::SEVERE;
        parent::__construct($message,  $previous);
    }       
}

class InvalidNameException extends BaseException
{
    public function __construct($parameter_name,  Exception $previous = null) 
    {
        parent::__construct("The following name field is invalid: " . $parameter_name,  $previous);
    }     
}

class InvalidPasswordException extends BaseException
{
    public function __construct( Exception $previous = null) 
    {
        parent::__construct("Your password is too short. Please enter in a longer one.",  $previous);
    }     
}

class InvalidRoleException extends BaseException
{
    public function __construct( Exception $previous = null) 
    {
        parent::__construct("You specified an invalid role. Try again.",  $previous);
    }     
}

class InvalidUserException extends BaseException
{
    public function __construct( Exception $previous = null) 
    {
        parent::__construct("This user does not exist.",  $previous);
    }     
}

class InvalidAccessPasswordException extends BaseException
{
    public function __construct( Exception $previous = null) 
    {
        parent::__construct("You specified an invalid access password. Try again.",  $previous);
    }     
}


class BrokenURLException extends BaseException
{
    public function __construct(Exception $previous = null) 
    {
        parent::__construct("The supplied website does not go to a valid page.",$previous);
    }       
}

class NoUserWithEmailExistsException extends BaseException
{
    public function __construct(Exception $previous = null)
    {
        parent::__construct("No active user with that email address exists.",  $previous);
    }
}

class InvalidResetPasswordCodeException extends BaseException
{
    public function __construct(Exception $previous = null)
    {
        parent::__construct("That reset code is invalid.",  $previous);
    }
}

class FileUploadException extends BaseException
{
    public function __construct(Exception $previous = null)
    {
        parent::__construct("There was a problem with uploading files.",  $previous);
    }
}


class InsufficientPermissionsError extends BaseException
{
    public function __construct(Exception $previous = null)
    {
        parent::__construct("You do not have sufficient permissions to access this website.",  $previous);
    }
}

class NoAPIKeySpecified extends BaseException
{
    public function __construct(Exception $previous = null)
    {
        parent::__construct("You did not specify an API key.",  $previous);
    }
}

class InvalidAPIKey extends BaseException
{
    public function __construct(Exception $previous = null)
    {
        parent::__construct("This API key is invalid.",  $previous);
    }
}


?>
