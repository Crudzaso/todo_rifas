<form id="form-checkout">
    <h2>Payment</h2>

    <div class="form-group">
        <label for="form-checkout__cardNumber">Card Number</label>
        <input type="text" id="form-checkout__cardNumber" class="form-control" placeholder="Card Number">
    </div>

    <div class="form-group">
        <label for="form-checkout__issuer">Issuer</label>
        <select id="form-checkout__issuer" class="form-control">
            <!-- Issuers will be loaded here -->
        </select>
    </div>

    <div class="form-group">
        <label for="form-checkout__identificationType">Identification Type</label>
        <input type="text" id="form-checkout__identificationType" class="form-control" placeholder="Identification Type">
    </div>

    <div class="form-group">
        <label for="form-checkout__identificationNumber">Identification Number</label>
        <input type="text" id="form-checkout__identificationNumber" class="form-control" placeholder="Identification Number">
    </div>

    <div class="form-group">
        <label for="form-checkout__cardholderEmail">Email</label>
        <input type="email" id="form-checkout__cardholderEmail" class="form-control" placeholder="Email">
    </div>

    <button type="submit" class="btn btn-primary">Submit Payment</button>
</form>

<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    const publicKey = @json(config('services.mercadopago.public_key'));

    const mp = new MercadoPago(publicKey, {
        locale: 'es-CO'
    });

    const cardForm = mp.cardForm({
        amount: "100.5",
        iframe: true,
        form: {
            id: "form-checkout",
        },
        callbacks: {
            onFormMounted: error => {
                if (error) return console.warn("Form Mounted handling error: ", error);
                console.log("Form mounted");
            },
            onSubmit: event => {
                event.preventDefault();

                console.log("Form submitted!"); // Verificar si se llega aquí

                const {
                    paymentMethodId: payment_method_id,
                    issuerId: issuer_id,
                    cardholderEmail: email,
                    amount,
                    token,
                    installments,
                    identificationNumber,
                    identificationType,
                } = cardForm.getCardFormData();

                // Imprimir los datos en la consola
                console.log("Datos del formulario:");
                console.log("payment_method_id:", payment_method_id);
                console.log("issuer_id:", issuer_id);
                console.log("email:", email);
                console.log("amount:", amount);
                console.log("token:", token);
                console.log("installments:", installments);
                console.log("identificationNumber:", identificationNumber);
                console.log("identificationType:", identificationType);

                // Ahora envías los datos al backend
                fetch("/process_payment", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        token,
                        issuer_id,
                        payment_method_id,
                        transaction_amount: Number(amount),
                        installments: Number(installments),
                        description: "Descripción del producto",
                        payer: {
                            email,
                            identification: {
                                type: identificationType,
                                number: identificationNumber,
                            },
                        },
                    }),
                });
            },
            onFetching: (resource) => {
                console.log("Fetching resource: ", resource);
                // Animate progress bar
                const progressBar = document.querySelector(".progress-bar");
                progressBar.removeAttribute("value");
                return () => {
                    progressBar.setAttribute("value", "0");
                };
            }
        }


    });

    // Obtener los emisores de tarjeta
    document.getElementById('form-checkout__cardNumber').addEventListener('input', function (event) {
        const cardNumber = event.target.value;

        // Solo procesar si el número tiene al menos 6 dígitos
        if (cardNumber.length >= 6) {
            const bin = cardNumber.substring(0, 6);  // Obtener los primeros 6 dígitos
            getIssuers(bin);  // Enviar el BIN (los primeros 6 dígitos) al backend
        }
    });

    function getIssuers(bin) {
        fetch(`/get-issuers/${bin}`)
            .then(response => response.json())
            .then(issuers => {
                const issuerInput = document.getElementById('form-checkout__issuer');
                issuerInput.innerHTML = '';  // Limpiar las opciones previas

                issuers.forEach(issuer => {
                    const option = document.createElement('option');
                    option.value = issuer.id;
                    option.text = issuer.name;
                    issuerInput.add(option);
                });
            })
            .catch(error => {
                console.error('Error al obtener los emisores:', error);
            });
    }
</script>
