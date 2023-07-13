<?php


class Database
{

    private $db_host;
    private $db_name;
    private $db_user;
    private $db_pass;



    public function dbConnection()
    {

        $this->db_host = $_ENV['DB_HOST'];
        $this->db_name = $_ENV['DB_NAME'];
        $this->db_user = $_ENV['DB_USER'];
        $this->db_pass = $_ENV['DB_PASS'];

        try {

            $conn = new PDO(
                "mysql:host=$this->db_host;dbname=$this->db_name",
                $this->db_user,
                $this->db_pass
            );


            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;
        } catch (PDOException $e) {
            echo  "Connection Error " . $e->getMessage();
            exit;
        }
    }
}
