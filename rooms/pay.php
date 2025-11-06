<?php require_once '../config/config.php'; ?>
<?php require_once '../includes/header.php'; ?>


<?php
  if(!isset($_SERVER['HTTP_REFERER'])){
        // redirect them to your desired location
        header('location: '.APPURL.'/index.php');
        exit;
    }
?>

<?php
$amount = isset($_SESSION['price']) ? number_format((float)$_SESSION['price'], 2, '.', '') : '0.00';
?>


  <div class="hero-wrap js-fullheight pay-hero" style="background-image: url('<?php echo APPURL; ?>/images/image_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate">
          	<h2 class="subheading">Pay Page for your Booking</h2>
             <div class="container">  
                    <!-- Replace "test" with your own sandbox Business account app client ID -->
                    <script src=""></script>
                    <!-- Set up a container element for the button -->
                    <div id="paypal-button-container"></div>
          <script>
            const amount = '<?php echo $amount; ?>';
            paypal.Buttons({
                        // Sets up the transaction when a payment button is clicked
                        createOrder: (data, actions) => {
              if (!amount || Number(amount) <= 0) {
                alert('Invalid payment amount.');
                throw new Error('Invalid amount');
              }
                            return actions.order.create({
                            purchase_units: [{
                                amount: {
                value: amount // total from booking/session
                                }
                            }]
                            });
                        },
                        // Finalize the transaction after payer approval
                        onApprove: (data, actions) => {
                            return actions.order.capture().then(function(orderData) {
               console.log('PayPal capture result', orderData);
               window.location.href='<?php echo APPURL; ?>/index.php';
                            });
            },
            onError: (err) => {
              console.error('PayPal error', err);
              alert('Payment error. Please try again.');
            },
            onCancel: (data) => {
              console.log('PayPal cancelled', data);
              alert('Payment cancelled.');
            }
                        }).render('#paypal-button-container');
                    </script>
                  

        </div>
          </div>
        </div>
      </div>
    </div>

   



<?php require_once '../includes/footer.php'; ?>