<?php
require_once 'app/controllers/InvoiceController.php';

$controller = new InvoiceController();

// Verificar el método de solicitud HTTP
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crear una factura
    $data = json_decode(file_get_contents("php://input"), true);  // Obtener los datos de la solicitud
    $controller->createInvoice($data);
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Obtener todas las facturas
    if (isset($_GET['id'])) {
        // Mostrar detalles de una factura
        $controller->getInvoiceDetails($_GET['id']);
    } else {
        // Obtener la lista de facturas
        $controller->getInvoices();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Anular una factura
    parse_str(file_get_contents("php://input"), $putVars);  // Obtener los datos del PUT
    $controller->cancelInvoice($putVars['id']);  // Llamar al método de cancelación con el ID
}
?>
