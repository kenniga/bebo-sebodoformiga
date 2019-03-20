<section class="list-author-name">
    <div class="container">
        <div class="fillter-alphabeta">
            <?php $alphaBeta = bebostore_getprefixauth(); ?>
            <ul id="alphabeta-list">
                <li data-fillter="item-all" id="default-clickHere" class="item-authfillter active"><a href="#all"><?php esc_html_e('ALL','bebostore')?></a></li>
                <?php
                foreach ($alphaBeta as $value) {
                ?>
                <li class="item-authfillter" data-fillter="<?php echo esc_html($value); ?>"><a href="#<?php echo esc_html($value)?>"><?php echo esc_html( $value );?></a></li>
                <?php }?>
            </ul>
        </div>
        <div id="result-author"></div><!--End #result-author-->
    </div>
</section>
<div class="end-authorview"></div>
<div class="hidden-alphabeta">
    <ul class="listalphabeta">
       <li data-fillter="item-all" class="item-authfillter active"><a href="#all"><?php esc_html_e('ALL','bebostore')?></a></li>
        <?php
        foreach ($alphaBeta as $value) {
        ?>
        <li class="item-authfillter" data-fillter="<?php echo esc_html($value); ?>"><a href="#<?php echo esc_html($value)?>"><?php echo esc_html( $value );?></a></li>
        <?php }?>
    </ul>
</div><!--End hidden-alpabeta-->
<div id="page-loading"></div>
<script>
(function($){
    "user strict";
    $(document).ready(function() {
        $('#result-author').addClass('loading');
        $('#page-loading').addClass('active');
        $('.hidden-alphabeta').removeClass('textwhite');
        var data = {
            'author-prefix':'item-all',
            'action'       : 'bookstore_filltertext'
        }
        $.ajax({
            type: 'GET',
            url: ajaxurl,
            data: data,
            success: function(result) {
                $('#result-author').removeClass('loading');
                $('#result-author').html(result);
                $('#page-loading').removeClass('active');
            }
        }).done(function() {
            setTimeout(function() {
                bookstore_clickDetail();
            }, 500);
        });
    });
    function bookstore_clickDetail(){
        <?php if (is_single()) {?>
            $('#post-<?php echo get_the_ID();?>').click();
        <?php }else{?>
            return false;
        <?php }?>
    }
})(jQuery)
</script>
<?php wp_reset_postdata(); ?>