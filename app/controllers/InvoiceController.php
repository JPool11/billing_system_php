<?php
require_once "../models/Database.php";
require_once "../models/Invoice.php";

class InvoiceController {
    private $db;
    private $invoice;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->invoice = new Invoice($this->db);
    }

    public function createInvoice($data) {
        $this->invoice->date = $data['date'];
        $this->invoice->total = $data['total'];
        $this->invoice->customer_id = $data['customer_id'];
        return $this->invoice->create();
    }

    public function getInvoices() {
        return $this->invoice->read();
    }

    public function getInvoiceDetails($id) {
        $this->invoice->id = $id;
        return $this->invoice->readOne();
    }

    public function cancelInvoice($id) {
        $this->invoice->id = $id;
        return $this->invoice->cancel();
    }
}
?>
