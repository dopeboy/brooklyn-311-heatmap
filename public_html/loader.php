<?php

class Loader 
{
	private $controller;
	private $action;
	private $urlvalues;
	private $postvalues;
    private $filevalues;
    private $sessionvalues;
	private $id;
    private $state;
        
    public $request_method;
        
	//store the URL values on object creation
	public function __construct($urlvalues, $postvalues, $filevalues, $sessionvalues, $request_method) 
	{
            $this->urlvalues = $urlvalues;
            $this->postvalues = $postvalues;
            $this->filevalues = $filevalues;
            $this->sessionvalues = $sessionvalues;
            
            $this->request_method = $request_method;
            
            $this->controller = !isset($this->urlvalues['controller']) || trim($this->urlvalues['controller'])==='' ?  $GLOBALS["default_controller"] :  $this->urlvalues['controller'];
            $this->action = !isset($this->urlvalues['action']) || trim($this->urlvalues['action'])==='' ?   $GLOBALS["default_action"] :  $this->urlvalues['action'];
            $this->id = !isset($this->urlvalues['id']) || trim($this->urlvalues['id'])==='' ?  "" :  $this->urlvalues['id'];
            $this->state = !isset($this->urlvalues['state']) || trim($this->urlvalues['state'])==='' ?  "" :  $this->urlvalues['state'];
	}
    
	//establish the requested controller as an object
	public function createController() 
	{
            if (!class_exists($this->controller))
                throw new InvalidPageException();
                
            return new $this->controller($this->action,$this->urlvalues, $this->postvalues, $this->filevalues, $this->id, $this->state, $this->request_method);
	}
}

?>
