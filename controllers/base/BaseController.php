<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
class BaseController
{ 
    /**
     * __call magic method.
     */
    public function __call($name, $arguments)
    {   
        $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
        $this->data = [];
    }
 
    /**
     * Get URI elements.
     * 
     * @return array
     */
    protected function getUriSegments()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode( '/', $uri );
 
        return $uri;
    }

 
 
    /**
     * Get querystring params.
     * 
     * @return array
     */
    protected function getQueryStringParams()
    {
        return parse_str($_SERVER['QUERY_STRING'], $query);
    }
 
    /**
     * Send API output.
     *
     * @param mixed  $data
     * @param string $httpHeader
     */
    protected function sendOutput($data, $httpHeaders=array())
    {
        header_remove('Set-Cookie');
 
        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }
 
        echo $data;
        exit;
    }

    public function loadView($fileName , $data = [],$varList =[])
    {
        if(!empty($varList))
        {
            foreach($varList as $key => $value)
            {
                $$key = $value;
            }
        }
          
        if (!file_exists(PROJECT_ROOT_PATH."/views/".$fileName.".php")) 
        {   
            $filefound = '0';
            echo("File not found");
        }
        else 
        {
            include(PROJECT_ROOT_PATH."/views/".$fileName.".php"); 
            $scripts = (!empty($data)&&(!empty($data["scripts"])))? $data["scripts"] : [];     
            if(!empty($scripts))
            {
                foreach ($scripts as $script) 
                {  
                    echo('<script type="text/javascript" src="'.BASE_URL.'/assets/custom-js/'.$script.'.js" ></script>');  
                 
                }
            }
        }
    }
    public function loadViewx($fileName , $data = [],$varList =[])
    {
        if(!empty($varList))
        {
            foreach($varList as $key => $value)
            {
                $$key = $value;
            }
        }
          
        if (!file_exists(PROJECT_ROOT_PATH."/views/".$fileName.".php")) 
        {   
            $filefound = '0';
            echo("File not found");
        }
        else 
        {
            include(PROJECT_ROOT_PATH."/views/".$fileName.".php"); 
            $scripts = (!empty($data)&&(!empty($data["scripts"])))? $data["scripts"] : [];     
            if(!empty($scripts))
            {
                foreach ($scripts as $script) 
                {  
                    echo('<script type="text/javascript" src="'.BASE_URL.'/assets/custom-js/'.$script.'.js" ></script>');  
                 
                }
            }
        }
    }


}