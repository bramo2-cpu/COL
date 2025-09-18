<?php
// include the autoloader (and config if you have it)
require 'ClassAutoLoad.php';
if (file_exists('conf.php')) {
    require 'conf.php';
}

// Prefer existing variables created by autoload, otherwise try to instantiate classes
// Map possible object names the project might be using
$layouts = $layouts ?? ($ObjLayouts ?? null);
$forms   = $forms   ?? ($ObjForms   ?? null);
$ObjSendMail = $ObjSendMail ?? null;

// If $layouts or $forms are still null, try to create them (if the classes exist)
if (!$layouts) {
    if (class_exists('Layouts')) {
        // pass $conf if your Layouts constructor expects it
        $layouts = new Layouts($conf ?? null);
    } else {
        die('Error: Layouts object not found and class Layouts does not exist. Check ClassAutoLoad.php');
    }
}
if (!$forms) {
    if (class_exists('Forms')) {
        $forms = new Forms($conf ?? null);
    } else {
        die('Error: Forms object not found and class Forms does not exist. Check ClassAutoLoad.php');
    }
}

// If SendMail object isn't provided by autoload, instantiate it if class exists
if (!$ObjSendMail && class_exists('SendMail')) {
    $ObjSendMail = new SendMail();
}

// Now safe to call layout methods
$layouts->header($conf);

// Handle form submission (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userName  = trim($_POST['name']  ?? '');
    $userEmail = trim($_POST['email'] ?? '');

    $errors = [];
    if ($userName === '')  $errors[] = 'Name is required.';
    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) $errors[] = 'A valid email is required.';

    if (empty($errors)) {
        // Prepare mail content
        $mailCnt = [
            'name_from' => 'BBIT Systems Admin',
            'mail_from' => 'anekeabramwel@gmail.com',
            'name_to'   => $userName,
            'mail_to'   => $userEmail,
            'subject'   => 'Welcome to BBIT Enterprise',
            'body'      => "Welcome <b>$userName</b>,<br>We’re glad to have you on board!"
        ];

        if ($ObjSendMail) {
            $ObjSendMail->Send_Mail($conf, $mailCnt);
        } else {
            echo 'Mailer not available. Check that SendMail class is loaded.';
        }
    } else {
        // display errors (you can style or integrate with your layouts)
        foreach ($errors as $err) {
            echo "<p style='color:red;'>$err</p>";
        }
    }
}

// Show the form (using your existing forms object)
$forms->login();

$layouts->footer($conf);