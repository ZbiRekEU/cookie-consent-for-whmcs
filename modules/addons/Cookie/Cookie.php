<?php

if (!defined("WHMCS")) { die("This file cannot be accessed directly");}

function Cookie_config()
{
  $message = 'We use cookies to ensure that we give you the best experience on our website. By continuing to visit this site you agree to our use of cookies.';

  return [
    'name'        => 'Cookie Consent',
    'description' => 'A lightweight addon module that displays a cookie consent message. The addon module displays a message on the user\'s first visit to your website.',
    'author'      => '<a href="https://www.hardsoftcode.com" target="_blank">HSCode</a>',
    'language'    => 'english',
    'version'     => '1.0.1',
    'fields'      => [
      'Enable'      => ['FriendlyName' => 'Enable', 'Type' => 'yesno', 'Description' => 'Tick this box to enable the cookie dialog'],
      'Title'       => ['FriendlyName' => 'Title', 'Type' => 'text', 'Size' => '40', 'Default' => 'Cookies'],
      'Message'     => ['FriendlyName' => 'Message', 'Type' => 'textarea', 'Rows' => '4', 'Default' => $message, 'Description' => 'HTML can be included within this message'],
      'Expires'     => ['FriendlyName' => 'Expires', 'Type' => 'text', 'Size' => '10', 'Default' => '30', 'Description' => 'Enter the days for the cookie to expire'],
      'PolicyURL'   => ['FriendlyName' => 'Cookie Policy URL', 'Type' => 'text', 'Size' => '60'],
      'RedirectURL' => ['FriendlyName' => 'Decline Redirect URL', 'Type' => 'text', 'Size' => '60'],
    ]
  ];
}

function Cookie_output($vars)
{
  header('Location: configaddonmods.php#Cookie');
  exit;
}
