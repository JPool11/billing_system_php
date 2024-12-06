document.getElementById("addItem").addEventListener("click", () => {
    // Contenedor principal de los ítems
    const itemsContainer = document.getElementById("items");

    // Crear una nueva línea de producto
    const newItem = document.createElement("div");
    newItem.classList.add("item");

    // HTML para el nuevo ítem
    newItem.innerHTML = `
        <label for="product_id">Producto:</label>
        <select class="product_id" name="product_id[]">
            <option value="1" data-price="800">Laptop - $800</option>
            <option value="2" data-price="500">Smartphone - $500</option>
            <option value="3" data-price="300">Tablet - $300</option>
        </select>

        <label for="quantity">Cantidad:</label>
        <input type="number" class="quantity" name="quantity[]" min="1" value="1" required>

        <label for="subtotal">Subtotal:</label>
        <input type="text" class="subtotal" name="subtotal[]" readonly>
    `;

    // Añadir evento para calcular subtotal al cambiar cantidad o producto
    newItem.querySelector(".product_id").addEventListener("change", calculateSubtotal);
    newItem.querySelector(".quantity").addEventListener("input", calculateSubtotal);

    // Añadir la nueva línea al contenedor
    itemsContainer.appendChild(newItem);

    // Calcular subtotal inicial para el nuevo ítem
    calculateSubtotal();
});

function calculateSubtotal() {
    const items = document.querySelectorAll(".item");
    let total = 0;

    items.forEach(item => {
        const productSelect = item.querySelector(".product_id");
        const quantityInput = item.querySelector(".quantity");
        const subtotalInput = item.querySelector(".subtotal");

        const price = parseFloat(productSelect.options[productSelect.selectedIndex].dataset.price);
        const quantity = parseInt(quantityInput.value) || 0;
        const subtotal = price * quantity;

        subtotalInput.value = subtotal.toFixed(2);
        total += subtotal;
    });

    document.getElementById("total").value = total.toFixed(2);
}

document.getElementById("invoiceForm").addEventListener("submit", (e) => {
    e.preventDefault();

    // Validar campos obligatorios
    const customerId = document.getElementById("customer_id").value;
    const date = document.getElementById("date").value;
    const total = document.getElementById("total").value;

    if (!customerId || !date || total <= 0) {
        alert("Por favor, complete todos los campos y asegúrese de que el total sea mayor que cero.");
        return;
    }

    // Recopilar datos del formulario
    const items = [];
    document.querySelectorAll(".item").forEach(item => {
        items.push({
            product_id: item.querySelector(".product_id").value,
            quantity: item.querySelector(".quantity").value,
            subtotal: item.querySelector(".subtotal").value,
        });
    });

    const invoiceData = {
        customer_id: customerId,
        date: date,
        total: total,
        items: items,
    };

    // Enviar datos al backend (reemplazar 'backend_endpoint' con la URL de tu servidor)
    fetch('backend_endpoint', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(invoiceData),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Factura creada exitosamente.");
                location.reload();
            } else {
                alert("Hubo un error al crear la factura. Por favor, inténtelo nuevamente.");
            }
        })
        .catch(error => console.error("Error:", error));
});

function cancelInvoice(id) {
    if (!confirm("¿Está seguro de que desea anular esta factura?")) return;

    fetch(`backend_endpoint_to_cancel_invoice/${id}`, {
        method: 'PUT'
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Factura anulada correctamente.");
                location.reload();
            } else {
                alert("Error al anular la factura.");
            }
        });
}
