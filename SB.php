
<!DOCTYPE html>

<head>
    <!-- Add meta tags for mobile and IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
</head>

<body align="center">

<style>
    
    /* Media query for mobile viewport */
    @media screen and (max-width: 400px) {
        #paypal-button-container {
            width: 100%;
        }
    }
    
    /* Media query for desktop viewport */
    @media screen and (min-width: 400px) {
        #paypal-button-container {
            width: 300px;
            display: inline-block;
        }
    }
    
</style>
    <!-- Set up a container element for the button -->
    <div id="paypal-button-container"></div>

    <!-- Include the PayPal JavaScript SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=AVkXtxVTYa-8-B3rc3R-V1oDdkKLczfkjQhysVVxdG4aj--k1WOvpfFN5hyP87KE1ve_Tt3tgV7ZgD0y"></script>

    <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({

        	style: {
            layout: 'vertical',  // horizontal | vertical
            size:   'medium',    // medium | large | responsive
            shape:  'rect',      // pill | rect
            color:  'gold'       // gold | blue | silver | black

        },

        // Specify allowed and disallowed funding sources
        //
        // Options:
        // - paypal.FUNDING.CARD
        // - paypal.FUNDING.CREDIT
        // - paypal.FUNDING.ELV



            // Set up the transaction
            createOrder: function(data, actions) {
                return fetch('create.php', {
                    method: 'post'
                }).then(function(res) {
                    return res.json();
                }).then(function(data) {
                    return data.orderID;
                });
            },

            // Finalize the transaction
            onApprove: function(data, actions) {

				let formData=new FormData();

				formData.append('orderID',JSON.stringify(data.orderID));

                return fetch('exec-server.php', {
                    method: 'post',
                    body: formData

                }).then(function(res) {
                    return res.json();
                }).then(function(res) {

       			console.log(res);
       			window.alert('Transaction completed by ' + res.payer.name.given_name + '!');
    			});
            }


        }).render('#paypal-button-container');
    </script>
</body>
    