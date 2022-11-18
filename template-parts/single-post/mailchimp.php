<?php
$mailchimp_code     = '';
if ( class_exists( 'CSF' ) ) {
	$opt         = get_option( 'ela_option_data' );
	$mailchimp_code     = $opt['mailchimp_code'];
}
?>
<div class="newsletter_susbcripe_form newsletter_susbcripe_form_single">
	<div class="newsletter_icon"><i class="far fa-envelope-open"></i></div>
	<?php echo wp_kses_post( $mailchimp_code ); ?>
	<script src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
	<script type='text/javascript'>(function ($) {
        window.fnames = new Array()
        window.ftypes = new Array()
        fnames[0] = 'EMAIL'
        ftypes[0] = 'email'
      }(jQuery))
      var $mcj = jQuery.noConflict(true)</script>
</div>