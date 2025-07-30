<?php

if (!defined("WHMCS")) { die("This file cannot be accessed directly");}

function Cookie_config()
{
  $message = 'Używamy plików cookie, aby zapewnić najlepsze doświadczenia na naszej stronie internetowej. Kontynuując przeglądanie tej witryny, wyrażasz zgodę na korzystanie z plików cookie.';

  return [
    'name'        => 'Cookie Consent',
    'description' => 'Moduł dodatkowy wyświetlający komunikat o zgodzie na pliki cookie z integracją Google Consent Mode.',
    'author'      => '<a href="https://www.hardsoftcode.com" target="_blank">HSCode</a>',
    'language'    => 'english',
    'version'     => '1.0.2',
    'fields'      => [
      'Enable'           => ['FriendlyName' => 'Włącz', 'Type' => 'yesno', 'Description' => 'Zaznacz to pole, aby włączyć dialog cookie'],
      'Title'            => ['FriendlyName' => 'Tytuł', 'Type' => 'text', 'Size' => '40', 'Default' => 'Pliki Cookie'],
      'Message'          => ['FriendlyName' => 'Wiadomość', 'Type' => 'textarea', 'Rows' => '4', 'Default' => $message, 'Description' => 'W tej wiadomości można używać HTML'],
      'Expires'          => ['FriendlyName' => 'Wygasa po (dni)', 'Type' => 'text', 'Size' => '10', 'Default' => '30', 'Description' => 'Podaj liczbę dni, po których cookie wygaśnie'],
      'PolicyURL'        => ['FriendlyName' => 'URL Polityki Cookie', 'Type' => 'text', 'Size' => '60'],
      'RedirectURL'      => ['FriendlyName' => 'URL Przekierowania po Odrzuceniu', 'Type' => 'text', 'Size' => '60'],
      
      // Google Consent Mode settings
      'EnableGoogleConsentMode' => ['FriendlyName' => 'Włącz Google Consent Mode', 'Type' => 'yesno', 'Description' => 'Włącz integrację z Google Consent Mode v2'],
      'GoogleAnalyticsID'       => ['FriendlyName' => 'Google Analytics 4 ID', 'Type' => 'text', 'Size' => '30', 'Description' => 'Np. G-XXXXXXXXXX'],
      'GoogleAdsID'             => ['FriendlyName' => 'Google Ads ID', 'Type' => 'text', 'Size' => '30', 'Description' => 'Opcjonalne. Np. AW-XXXXXXXXX'],
      'ConsentModeRegions'      => ['FriendlyName' => 'Regiony Consent Mode', 'Type' => 'text', 'Size' => '40', 'Default' => 'PL,EU', 'Description' => 'Kody krajów oddzielone przecinkami (np. PL,DE,FR)'],
      'DefaultAdStorage'        => ['FriendlyName' => 'Domyślne Ad Storage', 'Type' => 'dropdown', 'Options' => 'denied,granted', 'Default' => 'denied', 'Description' => 'Domyślny stan zgody na reklamowe cookies'],
      'DefaultAnalyticsStorage' => ['FriendlyName' => 'Domyślne Analytics Storage', 'Type' => 'dropdown', 'Options' => 'denied,granted', 'Default' => 'denied', 'Description' => 'Domyślny stan zgody na analityczne cookies'],
    ]
  ];
}

function Cookie_output($vars)
{
  header('Location: configaddonmods.php#Cookie');
  exit;
}
