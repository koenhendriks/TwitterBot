<?php
/**
 * router.php
 *
 * @author Koen Hendriks <info@koenhendriks.com>
 * @version 1.0 - Created on 6/5/14
 * @copyright 2014 Koen Hendriks
 */
class Router
{
    public $page;
    private $requests;
    private $requestURI;

    /**
     * Constructor for building array with values and remove any working directories
     */
    function __construct()
    {

        $requestURI = explode('/', $_SERVER['REQUEST_URI']);
        $scriptName = explode('/',$_SERVER['SCRIPT_NAME']);

        $this->requestURI = array_values($requestURI);
        for($i= 0;$i < sizeof($scriptName);$i++)
        {
            if ($requestURI[$i] == $scriptName[$i])
            {
                unset($requestURI[$i]);
            }
        }

        $temp_array = array();

        //Decode the url for good values
        foreach($requestURI as $value)
        {
            array_push($temp_array,urldecode($value));
        }

        if(isset($temp_array[0]))
        {
            $this->setPage($temp_array[0]);
            unset($temp_array[0]);
           $temp_array = array_values($temp_array);
        }




        $request_array = array();
        foreach($temp_array as $key => $value){
            if($key % 2 == 0)
            {
                if(isset($temp_array[$key+1]))
                {
                    $request_array[$value] = $temp_array[$key+1];
                }
            }
        }
        $this->requests = $request_array;

    }

    /**
     * Get a specific value out of the router
     *
     * @param $param
     * @return bool
     */
    public function getValue($param)
    {
        if(array_key_exists($param, $this->requests))
            return $this->requests[$param];
        else
            return false;
    }

    /**
     * @return array
     */
    public function getRequestURI()
    {
        return $this->requestURI;
    }

    /**
     * @return array
     */
    public function getRequests()
    {
        return $this->requests;
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param mixed $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }
}