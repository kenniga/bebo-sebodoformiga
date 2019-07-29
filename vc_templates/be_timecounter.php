<?php
$title_text = $date_countdown = $month_countdown = $year_countdown = "";
extract(shortcode_atts(array(
    'title_text'	=> '',
    'date_countdown'	=> '',
    'month_countdown'	=> '',
    'year_countdown' => ''
), $atts));
?>
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
