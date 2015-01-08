<?php

abstract class Controller 
{
    protected $urlvalues;
    protected $postvalues;
    protected $filevalues;

    protected $action;
    protected $id;
    protected $state;
    protected $request_method;
    
    protected $complaints_model;
    protected $keys_model;
    protected $agencies_model;
    protected $complainttypes_model;

    public function __construct($action, $urlvalues, $postvalues, $filevalues, $id, $state, $request_method) 
    {
        $this->action = $action;
        $this->urlvalues = $urlvalues;
        $this->postvalues = $postvalues;
        $this->filevalues = $filevalues;
        $this->id = $id;
        $this->state = $state;
        $this->request_method = $request_method;
        
        $this->complaints_model = new ComplaintsModel();
        $this->keys_model = new KeysModel();
        $this->agencies_model = new AgenciesModel();
        $this->complainttypes_model = new ComplaintTypesModel();
    }

    public function executeAction() 
    {        
        if (!method_exists($this, $this->action))
                throw new InvalidPageException();
        
        return $this->{$this->action}();
    }

    protected function returnView($viewmodel, $view = "inside.php")
    {
        if ($this->request_method == Method::GET)
        {
            $file = 'views/' . strtolower(get_class($this)) . '/' . $this->action . '.php';
            
            if (file_exists($file) == 0)
                throw new InvalidPageException();
            
            $viewloc = $file; // This view makes use of $viewmodel
            require("views/{$view}");
        }
            
        else if ($this->request_method == Method::POST)
            echo $viewmodel;
    }
    
    protected function validateParameter($parameter_value, $parameter_name, $callbacks)
    {
        if (is_array($parameter_value))
            $parameter_value = array_map('trim', $parameter_value);
        else
            $parameter_value = trim($parameter_value);
        
        foreach ($callbacks as $callback)
        {
            call_user_func($callback,$parameter_value,$parameter_name);
        }
        
        return $parameter_value;
    } 
    
    protected function pushReturnURL($url)
    {
        $_SESSION["RETURN_URL"] = $url;
    }
    
    protected function popReturnURL()
    {
        if (empty($_SESSION["RETURN_URL"]))
            return null;
        
        $tmp = $_SESSION["RETURN_URL"];
        unset($_SESSION["RETURN_URL"]);
        return $tmp;
    }
}
?>
