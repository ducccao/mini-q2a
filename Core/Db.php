<?php



class Db
{
    protected $_conn;
    protected $_ret;
    protected $_numRows;
    protected $_host = "localhost";
    protected $_username = "root";
    protected $_password = "root";
    protected $_database = "mini_social_network";

    // Establish connection to database, when class is instantiated
    public function __construct()
    {
        $this->_conn = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);

        if (mysqli_connect_error()) {
            echo "Connection failed: " . mysqli_connect_error();
            exit();
        }
    }


    // Sends the query to the connection
    public function load($sql)
    {
        $this->_ret = $this->_conn->query($sql) or die(mysqli_error($this->_ret));
        $this->_numRows = mysqli_num_rows($this->_ret);
    }

    // patch DB
    public function patchDb($sql)
    {
        $this->_ret = $this->_conn->query($sql) or die(mysqli_error($this->_ret));
        return $this->_ret;
    }



    // Return the number of rows
    public function numRows()
    {
        return $this->_numRows;
    }
    // Fetchs the rows and return them to array
    public function Rows()
    {
        $rows = array();

        for ($i = 0; $i < $this->numRows(); $i++) {
            $rows[] = mysqli_fetch_assoc($this->_ret);
        }
        return $rows;
    }

    // Used by other classes to get the connection
    public function getConn()
    {
        return $this->_conn;
    }

    // Securing input data
    public function secureInput($value)
    {
        return mysqli_real_escape_string($this->_conn, $value);
    }
}
