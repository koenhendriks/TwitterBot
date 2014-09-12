<?php
/**
 * credentials.php
 *
 * @author Koen Hendriks <info@koenhendriks.com>
 * @version 1.0 - Created on 6/6/14
 * @copyright 2014 Koen Hendriks
 */

class Credentials{

    private $credentials;

    function __construct(){
        $this->setCredentials(
            array(
                "DATABASES" => array(
                    "default" => array(
                        'dbhost'       => 'localhost' ,
                        'dbuser'       => 'user',
                        'dbpass'       => base64_decode('cGFzc3dvcmQ='),
                        'dbdatabase'   => 'database'
                    )
                )
            )
        );
        return $this->getCredentials();
    }

    /**
     * @param array $credentials
     * @return $this
     */
    public function setCredentials($credentials)
    {
        $this->credentials = $credentials;
        return $this;
    }

    /**
     * @return array
     */
    public function getCredentials()
    {
        return $this->credentials;
    }



}

