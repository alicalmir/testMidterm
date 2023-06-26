<?php

require_once 'Config.class.php';

class MidtermDao {

    private $conn;

    /**
    * constructor of dao class
    */
    public function __construct(){
      try {
        $host = Config::DB_HOST();
        $username = Config::DB_USERNAME();
        $password = Config::DB_PASSWORD();
        $schema = Config::DB_SCHEMA();
        $port = Config::DB_PORT();
        $dsn = "mysql:host=$host;port=$port;dbname=$schema;";

        /*options array necessary to enable SSL mode - do not change*/
        // $options = array(
          // PDO::MYSQL_ATTR_SSL_CA => 'https://drive.google.com/file/d/1g3sZDXiWK8HcPuRhS0nNeoUlOVSWdMAg/view?usp=share_link',
          // PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
       // );

        $this->conn = new PDO($dsn, $username, $password);
        //$options
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
      } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
  }

    /** TODO
    * Implement DAO method used to get cap table
    */
    public function cap_table(){
      $stmt = $this->conn->prepare("SELECT
      sc.description AS class,
      scc1.description AS category,
      scc2.description AS subcategory,
      i.first_name AS investor,
      ct.diluted_shares AS diluted_shares
  FROM
      cap_table ct
      JOIN share_classes sc ON ct.share_class_id = sc.id
      JOIN share_class_categories scc1 ON ct.share_class_category_id = scc1.id
      JOIN share_class_categories scc2 ON scc1.share_class_id = scc2.share_class_id
      JOIN investors i ON ct.investor_id = i.id
  ORDER BY
      sc.description;
  ");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** TODO
    * Implement DAO method used to get cap_table summary
    */
    public function summary(){
      $stmt = $this->conn->prepare("SELECT COUNT(DISTINCT c.investor_id) AS total_investors, SUM(c.diluted_shares) AS total_shares FROM cap_table c;");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** TODO
    * Implement DAO method to return list of investors with their total shares amount
    */
    public function investors(){
      $stmt = $this->conn->prepare("SELECT
      i.first_name,
      i.last_name,
      i.company,
      SUM(c.diluted_shares) AS total_shares
    FROM
      cap_table c
      JOIN investors i ON c.investor_id = i.id
    GROUP BY
      i.first_name,
      i.last_name,
      i.company;    
    ");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    }
?>
