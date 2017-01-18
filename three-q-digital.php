<?php
/*
Plugin Name: 3Q Digital Functionality 2014
Plugin URI: http://3qdigital.com
Description: Theme independent custom functionality for 3qdigital.com
Version: 0.1
Author: Raymond Johnson
Author URI: http://raymondjohnson.us/
*/

/********************* Whitepaper Form Shortcodes *********************/

/* Multiwhiatepaper Form Shortcode */
function three_q_digital_whitepaper_form() {
	get_template_part( 'forms/form' , 'multi-whitepaper' );
} 
add_shortcode('whitepaper-form', 'three_q_digital_whitepaper_form'); 

/* Contact Form Short Code */
function three_q_digital_contact_form() {
    ob_start(); /* Clear Output Buffer http://kovshenin.com/2013/get_template_part-within-shortcodes/ */
    get_template_part( 'forms/form' , 'contact' );
    return ob_get_clean();
} 
add_shortcode('contact-form', 'three_q_digital_contact_form');

/* Newsletter Subscription Form */
function three_q_digital_newsletter_subscription_form() {
    ob_start(); /* Clear Output Buffer http://kovshenin.com/2013/get_template_part-within-shortcodes/ */
    get_template_part( 'forms/form' , 'newsletter-subscription' );
    return ob_get_clean();
} 
add_shortcode('newsletter-subscription-form', 'three_q_digital_newsletter_subscription_form');
add_filter('widget_text', 'do_shortcode');

/****************************************************************************************************/

/* Allow php code in text widgets */
add_filter('widget_text','execute_php',100);
function execute_php($html){
     if(strpos($html,"<"."?php")!==false){
          ob_start();
          eval("?".">".$html);
          $html=ob_get_contents();
          ob_end_clean();
     }
     return $html;
}

/********************* Site-Wite Header Scripts *********************/

function custom_header_scripts(){ ?>
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');
    
        fbq('init', '289666441241578');
        fbq('track', "PageView");
    </script>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=289666441241578&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
<?php }
add_action('wp_head', 'custom_header_scripts');

/********************* Site-Wite Footer Scripts *********************/

function custom_footer_scripts() { ?>
    <!-- Bracaketeers -->
    <script src="//d9bv6r0coyif7.cloudfront.net/js/iframeResizer.min.js?cb4b22"></script>
    <script type='text/javascript'>
        jQuery(document).ready(function($) {
            $('#bracketeers').iFrameResize({
                log:false,
                enablePublicMethods:true,
                autoResize:false,
                heightCalculationMethod:'max'
            });
        })
    </script>
    <!-- Bracaketeers -->
    <!-- Daddy Analytics Scripts for Sales Force -->
    <script src="//cdn.daddyanalytics.com/w2/daddy.js" type="text/javascript"></script>
    <script type="text/javascript">
        var da_data =daddy_init('{"da_token":"00NU00000046DWm","da_url":"00NU00000046DWs"}');
        var clicky_custom = {session: {DaddyAnalytics: da_data}};
    </script>
    <script src="//hello.staticstuff.net/w/__stats.js" type="text/javascript"></script>
    <script type="text/javascript">try{ clicky.init(100743134); }catch(e){}</script>
    
    <!-- ActOn Script -->    
    <script>/*<![CDATA[*/(function(w,a,b,d,s){w[a]=w[a]||{};w[a][b]=w[a][b]||{q:[],track:function(r,e,t){this.q.push({r:r,e:e,t:t||+new Date});}};var e=d.createElement(s);var f=d.getElementsByTagName(s)[0];e.async=1;e.src='//marketing.3qdigital.com/cdnr/50/acton/bn/tracker/8109';f.parentNode.insertBefore(e,f);})(window,'ActOn','Beacon',document,'script');ActOn.Beacon.track();/*]]>*/</script>
    
    <!-- Twitter Script -->
    <script src="//platform.twitter.com/oct.js" type="text/javascript"></script>
	<script type="text/javascript">
		twttr.conversion.trackPid('l4x9q');
	</script>
	<noscript>
		<img height="1" width="1" style="display:none;" alt="" src="https://analytics.twitter.com/i/adsct?txn_id=l4x9q&p_id=Twitter" />
		<img height="1" width="1" style="display:none;" alt="" src="//t.co/i/adsct?txn_id=l4x9q&p_id=Twitter" />
	</noscript>
	
    <!-- Google Plus Place this tag after the last +1 button tag. -->
    <script type="text/javascript">
        ( function() {
            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
            po.src = 'https://apis.google.com/js/platform.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
        })();
    </script>
<?php 
} 

add_action('wp_footer', 'custom_footer_scripts');

function three_q_downloadalytics() {
    /**
     * Downloadalytics
     *
     * Copyright (c) 2014 Van Patten Media Inc.
     *
     * Released under the terms of the MIT License.
     * Find the license here: http://opensource.org/licenses/MIT
     * or consult the included README file.
     */
    
    /**
     * Step 1:
     * Downloadalytics requires the Server Side Google Analytics script,
     * available here: https://github.com/dancameron/server-side-google-analytics
     *
     * Make sure the path below is correct.
     */
    require_once(dirname(__FILE__).'/inc/ss-ga.class.php');
    
    /**
     * Step 2:
     * Supply your Google Analytics property ID and domain:
     */
    $ssga = new ssga('UA-43522254-1','3qdigital.com');
    
    if(isset($_GET['url']))
    {
    	$domain = $_GET['url'];
    	$domain = urldecode($domain);
    	$domain = filter_var($domain, FILTER_SANITIZE_URL);
    
    	/**
    	 * Step 3:
    	 * Make sure to replace the domain names below with your own domain name,
    	 * and the file type ('mp3') with the type you want to track.
    	 */
    	if( strstr($domain, '3qdigital.com') && strstr($domain, 'mp3') )
    	{
    		$domain   = preg_replace('/http?:\/\/(www\.)?3qdigital.com/', '', $domain);
    		$filename = basename($domain);
    		
    		/**
    		 * Step 4:
    		 * Replace the below line with your Event parameters.
    		 */
    		$ssga->set_event('Downloads', 'MP3', $filename);
    
    		$ssga->send();
    		$ssga->reset();
    
    		header('Location: ' . $domain);
    	}
    	else
    	{
    		trigger_error('Sorry, this file is invalid.');
    	}
    }
    else
    {
    	trigger_error('Sorry, you didn\'t specify a URL to download.');
    }
}
// add_action( 'wp_head', 'three_q_downloadalytics' );