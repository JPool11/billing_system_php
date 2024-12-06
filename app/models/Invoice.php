<?php
class Invoice {
    private $conn;
    private $table_name = "invoices";

    public $id;
    public $date;
    public $total;
    public $customer_id;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET date=:date, total=:total, customer_id=:customer_id, status='active'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":total", $this->total);
        $stmt->bindParam(":customer_id", $this->customer_id);
        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cancel() {
        $query = "UPDATE " . $this->table_name . " SET status = 'canceled' WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }
}
?>
