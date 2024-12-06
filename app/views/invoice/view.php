<div id="invoiceDetails"></div>

<script>
    function viewInvoice(id) {
        fetch(`backend_endpoint_to_view_invoice/${id}`)
            .then(response => response.json())
            .then(data => {
                const details = data.details;
                let html = `
                    <h3>Factura ID: ${data.invoice.id}</h3>
                    <p>Cliente: ${data.invoice.customer_id}</p>
                    <p>Fecha: ${data.invoice.date}</p>
                    <p>Total: ${data.invoice.total}</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                `;
                details.forEach(detail => {
                    html += `
                        <tr>
                            <td>${detail.product_id}</td>
                            <td>${detail.quantity}</td>
                            <td>${detail.subtotal}</td>
                        </tr>
                    `;
                });
                html += `</tbody></table>`;
                document.getElementById("invoiceDetails").innerHTML = html;
            });
    }
</script>
