<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Pago</title>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <style>
        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-row {
            display: flex;
            gap: 15px;
        }
        .form-row .form-group {
            flex: 1;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #009ee3;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #007eb5;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Información de Pago</h2>
    <form id="form-checkout">
        <!-- Número de Tarjeta -->
        <div class="form-group">
            <label for="form-checkout__cardNumber">Número de la Tarjeta</label>
            <input
                type="text"
                id="form-checkout__cardNumber"
                placeholder="1234 5678 9012 3456"
            />
        </div>

        <!-- Fila para fecha de vencimiento y código de seguridad -->
        <div class="form-row">
            <div class="form-group">
                <label for="form-checkout__expirationDate">Fecha de Vencimiento</label>
                <input
                    type="text"
                    id="form-checkout__expirationDate"
                    placeholder="MM/YY"
                />
            </div>

            <div class="form-group">
                <label for="form-checkout__securityCode">Código de Seguridad (CVV)</label>
                <input
                    type="text"
                    id="form-checkout__securityCode"
                    placeholder="123"
                />
            </div>
        </div>

        <!-- Nombre del titular -->
        <div class="form-group">
            <label for="form-checkout__cardholderName">Nombre del Titular</label>
            <input
                type="text"
                id="form-checkout__cardholderName"
                placeholder="Como aparece en la tarjeta"
            />
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="form-checkout__cardholderEmail">Correo Electrónico</label>
            <input
                type="email"
                id="form-checkout__cardholderEmail"
                placeholder="ejemplo@email.com"
            />
        </div>

        <!-- DNI/Documento -->
        <div class="form-group">
            <label for="form-checkout__identificationNumber">Documento de identidad</label>
            <input
                type="text"
                id="form-checkout__identificationNumber"
                placeholder="12345678"
            />
        </div>

        <!-- Cuotas -->
        <div class="form-group">
            <label for="form-checkout__installments">Cuotas</label>
            <select id="form-checkout__installments">
                <option value="1">1 cuota</option>
                <!-- Las demás opciones se cargarán dinámicamente -->
            </select>
        </div>

        <!-- Botón de pago -->
        <button type="submit" id="form-checkout__submit">Pagar</button>
    </form>
</div>

<script>
    const mp = new MercadoPago('TU_PUBLIC_KEY');

    const cardForm = mp.cardForm({
        amount: "100.00",
        iframe: true,
        form: {
            id: "form-checkout",
            cardNumber: {
                id: "form-checkout__cardNumber",
                placeholder: "Número de tarjeta",
            },
            expirationDate: {
                id: "form-checkout__expirationDate",
                placeholder: "MM/YY",
            },
            securityCode: {
                id: "form-checkout__securityCode",
                placeholder: "Código de seguridad",
            },
            cardholderName: {
                id: "form-checkout__cardholderName",
                placeholder: "Titular de la tarjeta",
            },
            cardholderEmail: {
                id: "form-checkout__cardholderEmail",
                placeholder: "Email",
            },
            identificationNumber: {
                id: "form-checkout__identificationNumber",
                placeholder: "DNI del titular",
            },
            installments: {
                id: "form-checkout__installments",
                placeholder: "Cuotas"
            }
        },
        callbacks: {
            onFormMounted: error => {
                if (error) console.log("Form Mounted handling error: ", error);
            },
            onSubmit: event => {
                event.preventDefault();
                const cardData = cardForm.getCardFormData();
                // Aquí va tu lógica de procesamiento de pago
            },
            onFetching: (resource) => {
                console.log("Fetching resource: ", resource);
            }
        }
    });
</script>
</body>
</html>
