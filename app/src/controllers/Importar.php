<?php

class Importar extends MY_Controller
{
    function __construct(){
        parent::__construct();
    }
    
    
    public function index(){
        #$this->load->database('cordovez_sap', TRUE);
        
        $serverName = "192.168.0.189";
        $connectionOptions = array(
            "database" => "DB_CORDOVEZ_PROD",
            "uid" => "appimpor",
            "pwd" => "vinesa.2018"
        );
        
        // Establishes the connection
        $conn = sqlsrv_connect($serverName, $connectionOptions);
        if ($conn === false) {
            die($this->formatErrors(sqlsrv_errors()));
        }
        
        // Select Query
        $tsql = "SELECT @@Version AS SQL_VERSION";
        
        // Executes the query
        $stmt = sqlsrv_query($conn, $tsql);
        
        // Error handling
        if ($stmt === false) {
            die($this->formatErrors(sqlsrv_errors()));
        }
        
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            echo $row['SQL_VERSION'] . PHP_EOL;
        }
        
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
           
    }
    
    function formatErrors($errors)
    {
        // Display errors
        echo "Error information: <br/>";
        foreach ($errors as $error) {
            echo "SQLSTATE: ". $error['SQLSTATE'] . "<br/>";
            echo "Code: ". $error['code'] . "<br/>";
            echo "Message: ". $error['message'] . "<br/>";
        }
    }

}

