<?php
$title_text = $date_countdown = $month_countdown = $year_countdown = "";
extract(shortcode_atts(array(
    'title_text'	=> '',
    'date_countdown'	=> '',
    'month_countdown'	=> '',
    'year_countdown' => ''
), $atts));
?>

<?php if ( is_user_logged_in() ): ?>
<div class="sc-logged-in-widget my-5">
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-10">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="nav nav-pills nav-fill sc-logged-in-widget__nav mb-5">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Galeri Saya</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Profil Saya</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Keluar</a>
                        </li>
                    </ul>
                </div>
                </div>
            <div class="row align-items-center">
                <div class="col-sm-7">
                    <div class="sc-timecounter">
                        <div class="sc-timecounter__title">
                            <h5><?php echo $title_text; ?></h5>
                        </div>
                        <div class="sc-timecounter__content">
                            <ul class="sc-timecounter__time-remaining">
                                <li><span id="days"></span>Hari</li>
                                <li class="separator"><span>:</span></li>
                                <li><span id="hours"></span>Jam</li>
                                <li class="separator"><span>:</span></li>
                                <li><span id="minutes"></span>Menit</li>
                            </ul>
                        </div>
                        <script type="text/javascript">
                            var second = 1000,
                                    minute = second * 60,
                                    hour = minute * 60,
                                    day = hour * 24;

                                var countDown = new Date('<?php echo $month_countdown; ?> <?php echo $date_countdown; ?>, <?php echo $year_countdown; ?> 00:00:00').getTime(),
                                    x = setInterval(function() {

                                    var now = new Date().getTime(),
                                        distance = countDown - now;

                                    document.getElementById('days').innerText = Math.floor(distance / (day)),
                                    document.getElementById('hours').innerText = Math.floor((distance % (day)) / (hour)),
                                    document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute));
                                    
                                    //do something later when date is reached
                                    //if (distance < 0) {
                                    //  clearInterval(x);
                                    //  'IT'S MY BIRTHDAY!;
                                    //}

                                    }, second)
                        </script>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="sc-logged-in-widget__contest-info">
                        <div class="sc-logged-in-widget__registered-photo d-flex align-items-end mb-3">
                            <h5>
                                2000
                            </h5>
                            <span>
                                Foto yang sudah masuk
                            </span>
                        </div>
                        <div class="sc-logged-in-widget__registered-user d-flex align-items-end mb-4">
                            <h5>
                                300
                            </h5>
                            <span>
                                Peserta Terdaftar
                            </span>
                        </div>
                        <div class="sc-logged-in-widget__submission-action">
                            <a href="#upload-foto-kontes" data-toggle="modal" class="sc-logged-in-widget__submit-photo">
                                Unggah Foto
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

</div>

<!-- The Modal -->
<div class="modal sc-logged-in-widget__modal" id="upload-foto-kontes">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            <h5 class="modal-title" id="exampleModalLongTitle">Unggah Foto</h5>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <div class="container-small">
                <div class="row">
                    <div class="col-12">
                    <?php echo do_shortcode($content); ?>
                </div>

            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php endif; ?>

<script>
    (function($) {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('label[for="photo-contest-upload"]').css('background-image', 'url('+e.target.result +')');
                    $('label[for="photo-contest-upload"]').hide();
                    $('label[for="photo-contest-upload"]').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#photo-contest-upload").change(function() {
            readURL(this);
        });
    })(jQuery);
</script>

