<?php
/**
 * database.php
 * 
 * @author Koen Hendriks <info@koenhendriks.com>
 * @version 1.0 - Created on 6/6/14
 * @copyright 2014 Koen Hendriks
 */

class Database {

    private $link;

    /**
     * Check data for sql injections
     *
     * @param $data
     * @return string
     */
    function DataCheck($data) {

        if (@get_magic_quotes_gpc()) {
            $data = stripslashes($data); // Removes magic_quotes_gpc slashes
        }
        $data = mysql_real_escape_string($data);

        return $data;
    }

    /**
     * Connect to the database with a PDO object
     *
     * @param string $name
     * @return PDO
     */
    function getPDO($name='default'){
        $credential = new Credentials($name);
        $credentials = $credential->getCredentials();

        if (!array_key_exists($name, $credentials['DATABASES'])) {
            utils::error('Can\'t connect to database', __LINE__);
        }
        $c = $credentials['DATABASES'][$name];
        try {
            $pdo = new PDO('mysql:dbname='.$c['dbdatabase'].';host='.$c['dbhost'], $c['dbuser'], $c['dbpass']);
            return $pdo;
        }catch (PDOException $e) {
            utils::error('Failed to create PDO Object',$e->getMessage());
        }
    }

    /**
     * Connect to the database using mysql
     *
     * @param string $name
     */
    function Database($name='default') {
        $credential = new Credentials($name);
        $credentials = $credential->getCredentials();
        if (!array_key_exists($name, $credentials['DATABASES'])) {
            utils::error('Can\'t connect to database '.$name, __LINE__);
        }
        $c = $credentials['DATABASES'][$name];
        $this->link = mysql_connect($c["dbhost"], $c["dbuser"], $c["dbpass"])
        or utils::error('Can\'t connect to database', __LINE__);
        if (!mysql_select_db($c["dbdatabase"], $this->link)) {
            utils::error('Can\'t select database '.$c["dbdatabase"], __LINE__);
        }
    }

    /**
     * Check if a row exists
     *
     * @param $table
     * @param string $where
     * @param string $select
     * @return mixed
     */
    function exists($table, $where = '1=1', $select = '*')
    {
        $sql = "SELECT COUNT(". $select .") FROM `". $table ."` WHERE ". $where ." LIMIT 0,1";
        $this->log($sql);
        $result = $this->getone($sql);
        return $result;
    }

    /**
     * Execute query & return result
     *
     * @param $sql
     * @return result
     */
    function query($sql) {
        $this->log($sql);
        $result = mysql_query($sql, $this->link) or utils::error("MySQL query error:<BR>\nQuery done: ".$sql."<BR>\nMySQL output: ", mysql_error($this->link));
        return new result($result);
    }

    /**
     * Gets all rows from a table
     *
     * @param $table string of the table name to get
     * @param array $order get data in a order
     * @return result of the query
     */
    function getAll($table, $order = array('id', 'ASC')) {
        $query = "SELECT * FROM `".$this->$db->DataCheck($table)."` ORDER BY `".$this->$db->DataCheck($order[0])."` ".$this->$db->DataCheck($order[1]);
        $this->log($query);
        return $this->query($query);
    }

    /**
     * Get one col from database and return value
     *
     * @param $sql
     * @return mixed
     */
    function getOne($sql) {
        $this->log($sql);
        $result = mysql_query($sql, $this->link) or utils::error("MySQL query error:<BR>\nQuery done: ".$sql."<BR>\nMySQL output: ", mysql_error($this->link));
        $row = mysql_fetch_row($result);
        return $row[0];
    }

    /**
     * Get row from database and return value
     *
     * @param $sql
     * @return array
     */
    function getRow($sql) {
        $this->log($sql);
        $result = mysql_query($sql, $this->link) or utils::error("MySQL query error:<BR>\nQuery done: ".$sql."<BR>\nMySQL output: ", mysql_error($this->link));
        return mysql_fetch_array($result, MYSQL_ASSOC);
    }

    /**
     * Returns the number of affected rows from last query
     *
     * @return int
     */
    function affected() {
        return mysql_affected_rows($this->link);
    }

    /**
     * Get last insert id
     *
     * @return int
     */
    function insertId() {
        return mysql_insert_id($this->link);
    }

    /**
     * Log database actions
     *
     * @param string $msg
     */
    function log($msg='') {
        if (false) {
            $fh = fopen('/tmp/query.log', 'a');
            fwrite($fh, date('d-m-Y H:i:s').' - '.trim($msg)."\n");
            fclose($fh);
        }
    }

    /**
     * Disconnect from database
     */
    function disconnect() {
        if (!mysql_close($this->link)) {
           utils::error(ERR_DB_CLOSE, __LINE__);
        }
    }

}