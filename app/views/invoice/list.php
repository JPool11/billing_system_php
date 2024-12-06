<table id="invoiceTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<script>
    // Cargar facturas
    fetch('backend_endpoint_to_list_invoices')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector("#invoiceTable tbody");
            tbody.innerHTML = "";
            data.forEach(invoice => {
                tbody.innerHTML += `
                    <tr>
                        <td>${invoice.id}</td>
                        <td>${invoice.customer_id}</td>
                        <td>${invoice.date}</td>
                        <td>${invoice.total}</td>
                        <td>${invoice.status}</td>
                        <td>
                            <button onclick="viewInvoice(${invoice.id})">Ver</button>
                            <button onclick="cancelInvoice(${invoice.id})">Anular</button>
                        </td>
                    </tr>
                `;
            });
        });
</script>
<script src="/public/js/app.js"></script>
<button onclick="cancelInvoice(${invoice.id})">Anular</button>
