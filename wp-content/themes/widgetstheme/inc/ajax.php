<?php

/*

@package dojotheme

  =====================================
    AJAX FUNCTIONS
  =====================================
*/

add_action('wp_ajax_nopriv_ajaxConversion', 'ajaxConversion');
add_action('wp_ajax_ajaxConversion', 'ajaxConversion');

function ajaxConversion(){

  $errors = [];

  if ( isset( $_POST['name'], $_POST['email'] ) ) {

    // VARS
    $fields = [
      'name' => wp_strip_all_tags($_POST['name']),
      'email' => wp_strip_all_tags($_POST['email']),
    ];

    //DECODE SUBJECTS
    $json = wp_strip_all_tags($_POST['subjects']);
    $str = stripslashes($json);
    $obj = json_decode($str);

    $content = [
      // 'subject' => wp_strip_all_tags($_POST['subject']),
      'vorname' => wp_strip_all_tags($_POST['vorname']),
      'zodiacal' => wp_strip_all_tags($_POST['selectedZodiacal']),
      'phone' => wp_strip_all_tags($_POST['phone']),
      'website' => wp_strip_all_tags($_POST['website']),
      'message' => wp_strip_all_tags($_POST['message']),
    ];
    $attachments = [
      'name' => $_FILES['attachments']['name'],
      'size' => $_FILES['attachments']['size'],
      'tpname' => $_FILES['attachments']['tmp_name'],
      'type' => $_FILES['attachments']['type'],
    ];
    $file_count = count($attachments['name']);

    //MESSAGE HTML
    $message = '
      <html>
      <body>
        <b>Contact Details:</b><br />
        Name: '.$fields['name'].'<br />
        Vorname: '.$content['vorname'].'<br /><br />
        Tele: '.$content['phone'].'<br />
        Mail: '.$fields['email'].'<br /><br />
        Sternzeichen: '.$content['zodiacal'].'<br />
        Web: '.$content['website'].'<br /><br />
        <b>Message:</b><br />
        '.$content['message'].'<br />
      </body>
      </html>
    ';

    foreach ($fields as $field => $data) {
      if (empty($data)) {
        $errors[] = 'The '.$field.' field is required.';
      }
    }
    if (empty($errors)) {
      $to = $obj->{'toEmail'};
      $subject = 'Betreff - '.$obj->{'subject'};
      $headers[] = 'From: '.get_bloginfo('name').' <'. $to .'>';
      $headers[] = 'Reply-To: '. $fields['name'] .'<'. $fields['email'] .'>';
      $headers[] = "IME-Version: 1.0\r\n";
      $headers[] = "Content-Type: text/html; charset=ISO-8859-1\r\n";

      if($file_count > 0){ //IF ATTACHMENT


        $uploaddir = WP_CONTENT_DIR.'/uploads/';
        $attachmentName = basename($attachments['name']);
        $uploadfile = $uploaddir . $attachmentName;

        if (move_uploaded_file($attachments['tpname'], $uploadfile)) {

          $_SESSION['uploadedfile'] = $uploadfile;
          // MAIL
          $mail_attachment = array(WP_CONTENT_DIR . '/uploads/'.$attachmentName);
          wp_mail( $to, $subject, $message, $headers, $mail_attachment );
          echo 'success';

        } else {
          echo "Error Uploading file";
        }

        $file = $_SESSION['uploadedfile'];
        unlink($file);

      } else {
        wp_mail( $to, $subject, $message, $headers );
      }

    } else {
      echo "missing fields";
    }

  } else {
    echo "Something went wrong";
  }
  wp_die();
};
