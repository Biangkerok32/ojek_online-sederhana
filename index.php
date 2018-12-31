<!DOCTYPE html>
<html>
  <head>
    <title>Ojek Online Sederhana</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/bootstrap4.min.css">

    <!-- Include SmartWizard CSS -->
    <link href="assets/css/smart_wizard.css" rel="stylesheet" type="text/css">

    <!-- Optional SmartWizard theme -->
    <link href="assets/css/smart_wizard_theme_circles.css" rel="stylesheet" type="text/css"  />

    <link href="assets/css/smart_wizard_theme_arrows.css" rel="stylesheet" type="text/css"  />

    <link href="assets/css/smart_wizard_theme_dots.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="style.css" >

  </head>
  <body>
    <div class="container">
        <br />
        <form action="detailorder.php" id="myForm" role="form" data-toggle="validator" method="post" accept-charset="utf-8">

        <!-- SmartWizard html -->
        <div id="smartwizard">
            <ul>
                <li><a href="#step-1">Step 1<br /><small>Order Ojek Online</small></a></li>
                <li><a href="#step-2">Step 2<br /><small>Catatan Pengemudi</small></a></li>
                <li><a href="#step-3">Step 3<br /><small>Pembayaran</small></a></li>
                <li><a href="#step-4">Step 4<br /><small>Selesai</small></a></li>
            </ul>

            <div>
                <div id="step-1">
                    <div id="right-panel"></div>
                    <div id="map"></div>
                    <img src="assets/images/gps.png" class="tombolgps" id="gunakanlokasi"/>
                    <div id="mode-selector" class="controls">
                  <input type="radio" name="type" id="changemode-walking" checked="checked">
                  <label for="changemode-walking">Motorcycle And Walking</label>

                  <input type="radio" name="type" id="changemode-transit">
                  <label for="changemode-transit">Transit</label>

                  <input type="radio" name="type" id="changemode-driving">
                  <label for="changemode-driving">Car</label>

                </div>
                    <div id="form-step-0" role="form" data-toggle="validator">
                        <div class="form-group">
                          <label for="usr"></label>
                          <input type="text" class="form-control" name="asal" id="asal" placeholder="Masukkan Lokasi Penjemputan">
                        </div>
                        <div class="form-group">
                          <label for="pwd"></label>
                          <input type="text" class="form-control" id="tujuan" name="tujuan" placeholder="Masukkan Lokasi Pengantaran">
                        </div>
                        <div class="form-group">
                          <label for="usr"></label>
                          <input type="text" class="form-control" id="distance" name="jarak" readonly>
                        </div>
                        <div class="form-group">
                          <label for="pwd"></label>
                          <input type="text" class="form-control" id="billing" name="tarif" readonly>
                        </div>
                    </div>

                </div>
                
                <div id="step-2">
                    <h2></h2>
                    <div id="form-step-1" role="form" data-toggle="validator">
                        <div class="form-group">
                            <label for="name">Catatan Pengemudi</label>
                            <input type="text" class="form-control" name="catatan" id="catatan" placeholder="Catatan Pengemudi" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <div id="step-3">
                    <h2>Pilih Pembayaran</h2>
                    <div id="form-step-2" role="form" data-toggle="validator">
                        <div class="form-group">
                            <input type="checkbox" name="pembayaran" value="Tunai">Tunai</input>
                            
                            <input type="checkbox" name="pembayaran" value="NonTunai">Non Tunai<br>

                            <label for="name">Promo(Optional)</label>
                            <input type="text" class="form-control" name="promo" id="promo" placeholder="Masukan Promo" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <div id="step-4" class="">
                    <h2>Silahkan Pilih Driver</h2>
                    <div id="form-step-3" role="form" data-toggle="validator">
                        <div class="form-group">
                            <input type="checkbox" name="driver" value="Si Cantik">
                            <img src="assets/images/sicantik.jpg"/ class="driverimg"></input>
                            <p style="float: right; margin-right: 70%;">Si Cantik<br>No Pol B 1234 ABC</p>
                            <br><br>
                            <input type="checkbox" name="driver" value="Bang Soplo">
                            <img src="assets/images/bang soplo.jpg"/ class="driverimg"></input>
                            <p style="float: right; margin-right: 70%;">Bang Soplo<br>No Pol B 4567 FGC</p>
                            <br><br>
                             <input type="checkbox" name="driver" value="Bang Toyib">
                            <img src="assets/images/kartono.png"/ class="driverimg"></input>
                            <p style="float: right; margin-right: 70%;">Bang Toyib<br>No Pol B 3456 SKK</p>
                            <br><br>
                            <input type="checkbox" name="driver" value="Della Putriara">
                            <img src="assets/images/Della Putriara.jpg"/ class="driverimg"></input>
                            <p style="float: right; margin-right: 70%;">Della Putriara<br>No Pol B 7890 FVJ</p>
                            <br><br>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        </form>

    </div>
   
<!-- jQuery library -->
<script src="assets/js/jquery.min.js"></script>

<!-- Popper JS -->
<script src="assets/js/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="assets/js/bootstrap4.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.smartWizard.min.js"></script>
<script type="text/javascript">
        $(document).ready(function(){

            // Step show event
            

            // Toolbar extra buttons
            var btnFinish = 
            $('<button></button>').text('Finish').addClass('btn btn-info')
                .on('click', function(){ 
                  alert('Finish Order');
                  window.location.href="detailorder.php";
                   });

            var btnCancel = 
            $('<button></button>').text('Cancel').addClass('btn btn-danger').on('click', function(){ 
                $('#smartwizard').smartWizard("reset"); 
            });

            // Please note enabling option "showStepURLhash" will make navigation conflict for multiple wizard in a page.
            // so that option is disabling => showStepURLhash: false

            // Smart Wizard 1
            $('#smartwizard').smartWizard({
                    selected: 0,
                    theme: 'arrows',
                    transitionEffect:'fade',
                    showStepURLhash: false,
                    toolbarSettings: 
                    {
                        toolbarPosition: 'bottom',
                        toolbarExtraButtons: [btnFinish, btnCancel]
                    }
            });

            
        });
    </script>
    
    <script src="mapsDefault.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRMGD9yRbxXALm2n_hjCbkZmbhB9yMLkk&libraries=places&callback=initMap"
        async defer></script>
          </body>
</html>
