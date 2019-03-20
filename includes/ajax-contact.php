<?php
add_action('wp_ajax_send_contact', 'beau_Contact');
add_action('wp_ajax_nopriv_send_contact', 'beau_Contact');
function beau_valid_email($str)
{
    return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}
function beau_Contact(){
    if ( isset($_POST['txt-email']) )
    {
        $_POST = array_map('trim', $_POST);
        $contact_firstname = stripslashes($_POST['txt-firstname']);
        $contact_lastname = stripslashes($_POST['txt-lastname']);
        $contact_website = stripslashes($_POST['txt-website']);
        $contact_email = stripslashes($_POST['txt-email']);
        $contact_message = stripslashes($_POST['txt-message']);
        $regex_email = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
        if ( empty($contact_firstname) ) {
            $halt[] = esc_html__('empty fist name', 'bebostore');
        }
        if ( empty($contact_lastname) ) {
            $halt[] = esc_html__('empty last name', 'bebostore');
        }
        if ( empty($contact_email) ) {
            $halt[] = esc_html__('empty email', 'bebostore');
        }
        elseif ( !beau_valid_email($contact_email) ) {
            $halt[] = esc_html__('email is malformed', 'bebostore');
        }
        if ( empty($contact_message) ) {
            $halt[] = esc_html__('empty message', 'bebostore');
        }
        if ( isset($halt) )
        {
            return esc_html__('Error: ','bebostore').@implode(', ', $halt);
            exit();
        }
        else {
            $messages = '
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
            "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head></head>
            <body>
            <table>
                <tr><td colspan="3"><strong>'.esc_html__('You have a messages from website','bebostore').'</strong> '.get_site_url().'</td></tr>
                <tr><td valign="top"><b>'. esc_html__('Fist name', 'bebostore') .'</b></td><td valign="top">:</td><td valign="top">' . $contact_firstname . ' </td></tr>
                <tr><td valign="top"><b>'. esc_html__('Last name', 'bebostore') .'</b></td><td valign="top">:</td><td valign="top">' . $contact_lastname . ' </td></tr>';
                if ($contact_website) {
                $messages .= '<tr><td valign="top"><b>'. esc_html__('Website', 'bebostore') .'</b></td><td valign="top">:</td><td valign="top">' . $contact_website . ' </td></tr>';
                }
                $messages .= '<tr><td valign="top"><b>'. esc_html__('Email', 'bebostore') .'</b></td><td valign="top">:</td><td valign="top">' . $contact_email . '</td></tr>
                <tr><td valign="top"><b>'. esc_html__('Message', 'bebostore') .'</b></td><td valign="top">:</td><td valign="top">' . $contact_message . '</td></tr>
            </table>
            </body>
            </html>';
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=utf-8" . "\r\n";
            $headers .= "From: " . stripslashes($contact_firstname).' '. stripslashes($contact_lastname) . " <" . $contact_email . ">" . "\r\n";
            $headers .= "Sender-IP: " . $_SERVER["SERVER_ADDR"] . "\r\n";
            $headers .= "Priority: normal" . "\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();
            $body = utf8_decode($messages);
            $to = get_option('admin_email');
            global $beau_option;
            if (isset($beau_option['admin-email'])) {
                $to = $beau_option['admin-email'];
            }
            $subject = esc_html__('Contact email from', 'bebostore') .': '. $contact_firstname;
            $sendEmail = wp_mail( $to, $subject, $body, $headers);
            if ($sendEmail){
                return true;
                exit();
            }else{
                return esc_html__('Sending email error please try again','bebostore');
                exit();
            }
        }
    }else{
        return esc_html__('Nodata Post','bebostore');
        exit();
    }
}
if (isset($_POST['txt-email'])) { echo beau_Contact(); exit();}