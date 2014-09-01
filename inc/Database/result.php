<?php
/**
 * result.php
 * 
 * @author Koen Hendriks <info@koenhendriks.com>
 * @version 1.0 - Created on 6/6/14
 * @copyright 2014 Koen Hendriks
 */

class result {

    private $result;

    /**
     * Set result on construct
     *
     * @param $result
     */
    function result($result) {
        $this->result = $result;
    }

    /**
     * Set result
     *
     * @param mixed $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * Get results
     *
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }



    /**
     * Get row from result
     *
     * @return array
     */
    function fetchRow() {
        return mysql_fetch_array($this->result, MYSQL_ASSOC);
    }

    /**
     * Get num rows from result
     *
     * @return int
     */
    function numRows() {
        return mysql_num_rows($this->result);
    }

}