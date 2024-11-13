<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://www.paypal.com/sdk/js?client-id={{config('app')['paypal_id']}}"></script>
</head>
<body>
        <div id="paypal-buttons"></div>
<!--         <script>
            window.paypalLoadScript({ clientId: "{{config('app')['paypal_id']}}" }).then((paypal) => {
                paypal.Buttons().render("#paypal-buttons");
            });
        </script> -->

    <script>
        paypal.Buttons({
            createOrden: function(data, actions){
                return actions.order.create({
                    purchase_units:[
                        {
                            amount: {
                                value:2
                            }
                        }
                    ]
                })
            },
            onApprover: function(data, actions){
                console.log(data);
            }
        }).render("#paypal-buttons");
    </script>
</body>
</html>