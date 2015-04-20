<?php
/**
 * @package iRecharge
 * @version 1.0
 */
/*
Plugin Name: iRecharge
Plugin URI: http://irecharge.com.ng/
Description: This plugin enables your website visitors to recharge their mobile lines. All major telecommunication networks in Nigeria are supported. To get started: 1) Click the "Activate" link to the left of this description, 3) Go through the Settings and select 'iRecharge Vendor Set' to set your Vendor ID, this is displayed on your profile at irecharge.com.ng/profile 4) put [irecharge] on any page area you want the plugin to appear.
Author: Chukwuebuka Ngene, IST Nigeria
Contributor: Layi Funsho, IST Nigeria
Version: 1.0
Author URI: http://ebuka@istrategytech.com/
License: GPLv2
*/

if($_POST['ist_irecharge_hidden'] == 'Y') {
        //Form data sent

        $ir_vendor_id = $_POST['irecharge_dashboard_vendorid'];

    if ( $ir_vendor_id == null || strlen( $ir_vendor_id ) < 6  )  {
        wp_die( __( 'Please Enter a Valid Vendor ID' ) );
    }else
        update_option('irecharge_dashboard_vendorid', $ir_vendor_id);
        ?>
        <div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
        <?php
    } else {
        //Normal page display
        $ir_vendor_id = get_option('irecharge_dashboard_vendorid');
    }


//admin settings
add_action('admin_menu', 'ist_irecharge_admin_actions');
add_action('admin_init', 'ist_irecharge_init'); //to initialize our setting fields
//create short code for display 
add_action('init', 'ist_ir_register_shortcodes');
//register for script loader
add_action('wp', 'irecharge_ext_init');



//function to add admin sublevel menu
function ist_irecharge_admin_actions() {
    add_options_page("iRecharge Vendor Set", "iRecharge Vendor Set", "manage_options", "iRecharge-Vendor-Set", "ist_irecharge_admin");
}
//function to initialize the settings fields
function ist_irecharge_init()
{
    register_setting('irecharge_field_group', 'irecharge_vendor_id');
}

//function to display form when the settings sublink is clicked on
function ist_irecharge_admin()
{

    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    //include('/ist_irecharge_admin.php');
    ?>
        <div class='wrap'>
            <?php screen_icon(); ?>
            <h2>iRecharge Vendor Settings</h2><hr/>
            <form action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" method="post">
                <?php settings_fields('irecharge_field_group'); ?>
                <?php @do_settings_fields('irecharge_field_group'); ?>
                <table class="form-table">
                    <tr valid="top">
                        <th scope="row"><label for="irecharge_dashboard_vendorid">iRecharge Vendor ID</label></th>
                        <td>
                            <input type="hidden" name="ist_irecharge_hidden" value="Y">
                            <input type="text" name="irecharge_dashboard_vendorid" id="dashboard_vendorid" value="<?php echo get_option('irecharge_dashboard_vendorid'); ?>" />
                            <br/><small>Enter your iRecharge Vendor ID</small>
                        </td>
                    </tr>
                </table><?php @submit_button(); ?>
            </form>
        </div>
    <?php

}

//function to add shortcode
function ist_ir_register_shortcodes() {
    add_shortcode('irecharge','ist_irecharge_content');
}

//make plugin show on page with registered shortcode
function ist_irecharge_content($args, $content)
{
    //Connect to the  updated option
    $ir_vendor_id = get_option('irecharge_dashboard_vendorid');

    if($ir_vendor_id){ //if we get something, then display the widget

       // now we add images locally
        $logo = plugin_dir_url( __FILE__ ) .'/img/logo.png';
        $mtn = plugin_dir_url( __FILE__ ) .'/img/mtn.png';
        $glo = plugin_dir_url( __FILE__ ) .'/img/glo.jpg';
        $etisalat = plugin_dir_url( __FILE__ ) .'/img/etisalat.jpg';
        $airtel = plugin_dir_url( __FILE__ ) .'/img/airtel.png';
        $visaphone = plugin_dir_url( __FILE__ ) .'/img/visafone.png';

        echo "<form action='' method=POST id='topup_form8975'>";
        echo "<div id=\"topup_formxyz\"><div id=\"left12345\"><img src=\"$logo\" width=\"36\" height=\"36\" alt=\"irecharge\" align=\"absmiddle\"> iRecharge</div>	<div id=\"right12345\"><img src=\"$mtn\" alt=\"mtn\"><img src=\"$airtel\" alt=\"airtel\"><img src=\"$visaphone\" alt=\"visafone\"><img src=\"$glo\" alt=\"glo\"><img src=\"$etisalat\" alt=\"etisalat\"></div><div style=\"clear:both; line-height:0; height:0; overflow:hidden\"></div></div><span id=\"topup_display_message123\">Instantly recharge your mobile phone. Major networks supported.</span>";
        echo "<input type='hidden' name='vendorId' id='vendorId' value='$ir_vendor_id'>";
        echo "<br><select required name='selected_network' id='selected_network'><option value=''>Select a network</option><option value='MTN'>MTN</option><option value='Glo'>GLO</option><option value='Etisalat'>Etisalat</option><option value='Visafone'>Visafone</option><option value='Airtel'>Airtel</option></select></br>";
        echo "<br><input type='number' name='vtu_amount' id='vtu_amount' value='' placeholder='Enter amount' autocomplete='off' required></br>";
        echo "<br><input type='phone' name='vtu_number' id='vtu_number' value='' placeholder='Enter phone number' autocomplete='off' minlength='11' required></br>";
        echo "<br><input type='email' name='vtu_email' id='vtu_email' value='' size = '30' placeholder='Email address to send receipt' autocomplete='off' required></br>";
        echo "<br><input type='button' value='Send' id='irecharge_i_button'></br>";
        echo "</form>";
		echo "<div style=\"border-top:solid thin #eee; padding:10px 0 10px 0; margin-top:10px; font-size:0.8em; text-align:left;\" id=\"top_up_support123\">For support or enquiries<a href=\"http://www.facebook.com/irechargeng\" target=\"_blank\"><img src=\"http://irecharge.com.ng/img/facebook_circle.png\" alt=\"call\" align=\"absmiddle\"></a><a href=\"https://twitter.com/@i_recharge\" target=\"_blank\"><img src=\"http://irecharge.com.ng/img/twitter_circle.png\" alt=\"call\" align=\"absmiddle\"></a> <br/> <br/><img src=\"http://irecharge.com.ng/img/call.png\" alt=\"call\" align=\"absmiddle\"> 0700-isupport (0700-47877678)<br/><a href=\"mailto:support@irecharge.com.ng\"><img src=\"http://irecharge.com.ng/img/email.png\" alt=\"call\" align=\"absmiddle\"> support@irecharge.com.ng</a></div>";

    }
    else{ //else return null
        return 'null';
    }

}

//function to load external script
function irecharge_ext_init()
{
    wp_register_script('irecharge_pluginscript.js',plugins_url('/js/irecharge_pluginscript.js',_FILE_), array('jquery'));
    wp_register_script('irecharge_jquerycookie.js',plugins_url('/js/jquery_cookie.js',_FILE_), array('jquery'));
    wp_register_style( 'irecharge_pluginstyle.css', plugins_url('/css/irecharge_pluginstyle.css', _FILE_ ), array());

    wp_enqueue_script('jquery');
    wp_enqueue_script('irecharge_jquerycookie.js');
    wp_enqueue_script('irecharge_pluginscript.js');
    wp_enqueue_style('irecharge_pluginstyle.css');
}
