<form id="invoiceForm">
    <label for="customer_id">Cliente:</label>
    <select id="customer_id" name="customer_id">
        <option value="1">John Doe</option>
        <option value="2">Jane Smith</option>
    </select>

    <label for="date">Fecha:</label>
    <input type="date" id="date" name="date" required>

    <div id="items">
        <div class="item">
            <label for="product_id">Producto:</label>
            <select class="product_id" name="product_id[]">
                <option value="1">Laptop - $800</option>
                <option value="2">Smartphone - $500</option>
                <option value="3">Tablet - $300</option>
            </select>

            <label for="quantity">Cantidad:</label>
            <input type="number" class="quantity" name="quantity[]" min="1" required>

            <label for="subtotal">Subtotal:</label>
            <input type="text" class="subtotal" name="subtotal[]" readonly>
        </div>
    </div>

    <button type="button" id="addItem">Añadir Ítem</button>
    <label for="total">Total:</label>
    <input type="text" id="total" name="total" readonly>
    <button type="submit">Guardar Factura</button>
</form>
