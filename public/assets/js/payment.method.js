document.addEventListener("DOMContentLoaded", function() {
    const mp = new MercadoPago(document.getElementById('MP_PUBLIC_KEY').value);

    const amountValue = parseFloat(document.getElementById('form-checkout__amount').value);
    if (isNaN(amountValue) || amountValue <= 0) {
        alert('El monto de pago no es válido.');
        return;
    }

    const cardForm = mp.cardForm({
        amount: amountValue.toString(), // Convertir el monto a string
        form: {
            id: "form-checkout",
            cardNumber: { id: "form-checkout__cardNumber" },
            expirationMonth: { id: "form-checkout__expirationMonth" },
            expirationYear: { id: "form-checkout__expirationYear" },
            securityCode: { id: "form-checkout__securityCode" },
            cardholderName: { id: "form-checkout__cardholderName" },
            cardholderEmail: { id: "form-checkout__cardholderEmail" },
            identificationNumber: { id: "form-checkout__identificationNumber" },
            installments: { id: "form-checkout__installments" },
            issuer: { id: "form-checkout__issuer" }
        },
        callbacks: {
            onFormMounted: error => {
                if (error) {
                    console.error("Error en la carga del formulario:", error);
                }
            },
            onSubmit: async event => {
                event.preventDefault();
                const cardData = cardForm.getCardFormData();
                console.log('Datos de la tarjeta:', cardData); // Para depuración

                if (cardData.cardNumber && cardData.cardholderName && cardData.securityCode) {
                    try {
                        const response = await fetch('/process-payment', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify(cardData)
                        });

                        if (!response.ok) {
                            throw new Error('Respuesta no válida del servidor');
                        }

                        const result = await response.json();
                        console.log('Resultado del pago:', result);

                        if (result.status === 'success') {
                            window.location.href = '/payment/success';
                        } else {
                            alert('Error en el pago: ' + result.message);
                        }
                    } catch (error) {
                        console.error('Error al procesar el pago:', error);
                        alert('Error al procesar el pago: ' + error.message);
                    }
                } else {
                    console.error('Faltan datos de la tarjeta:', cardData);
                    alert('Por favor, complete todos los campos de la tarjeta.');
                }
            }
        }
    });

    mp.getIssuers('visa', function (error, issuers) {
        if (error) {
            console.error('Error al obtener emisores:', error);
            return;
        }

        const issuerSelect = document.getElementById('form-checkout__issuer');
        issuers.forEach(issuer => {
            const option = document.createElement('option');
            option.value = issuer.id;
            option.text = issuer.name;
            issuerSelect.add(option);
        });
    });

    document.getElementById('form-checkout__cardNumber').addEventListener('input', function() {
        const cardNumber = this.value.replace(/\D/g, '').slice(0, 6);
        if (cardNumber.length === 6) {
            mp.getInstallments({
                bin: cardNumber,
                amount: amountValue
            }, function (error, installments) {
                if (error) {
                    console.error('Error al obtener cuotas:', error);
                    return;
                }
                const installmentsSelect = document.getElementById('form-checkout__installments');
                installmentsSelect.innerHTML = '';
                installments.payer_costs.forEach(cost => {
                    const option = document.createElement('option');
                    option.value = cost.installments;
                    option.text = cost.installments + ' cuota(s)';
                    installmentsSelect.add(option);
                });
            });
        }
    });
});
