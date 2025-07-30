<?php

use WHMCS\Database\Capsule;
use WHMCS\Config\Setting;
use WHMCS\Session;

class HSCodeConfig
{
  public static function get($config)
  {
    $result = Capsule::table('tbladdonmodules')->where(['module' => 'Cookie', 'setting' => $config])->value('value');

    return $result;
  }
}

class HSCodeLang
{
  public static function get()
  {
    if(file_exists(ROOTDIR.'/modules/addons/Cookie/lang/'.strtolower(Session::get('Language')).'.php'))
    {
      require(ROOTDIR.'/modules/addons/Cookie/lang/'.strtolower(Session::get('Language')).'.php');
    }
    elseif(file_exists(ROOTDIR.'/modules/addons/Cookie/lang/'.strtolower(Setting::getValue('Language')).'.php'))
    {
      require(ROOTDIR.'/modules/addons/Cookie/lang/'.strtolower(Setting::getValue('Language')).'.php');
    }
    else
    {
      require(ROOTDIR.'/modules/addons/Cookie/lang/english.php');
    }

    return $_ADDONLANG;
  }
}


add_hook('ClientAreaFooterOutput', 699855, function($vars)
{
  $systemUrl = Setting::getValue('SystemURL');
  $lang      = HSCodeLang::get();
  $enable    = HSCodeConfig::get('Enable');
  $title     = HSCodeConfig::get('Title');
  $message   = HSCodeConfig::get('Message');
  $expires   = HSCodeConfig::get('Expires');
  $policy    = HSCodeConfig::get('PolicyURL');
  $redirect  = HSCodeConfig::get('RedirectURL');
  
  // Google Consent Mode settings
  $enableGCM         = HSCodeConfig::get('EnableGoogleConsentMode');
  $googleAnalyticsID = HSCodeConfig::get('GoogleAnalyticsID');
  $googleAdsID       = HSCodeConfig::get('GoogleAdsID');
  $regions           = HSCodeConfig::get('ConsentModeRegions') ?: 'PL';
  $defaultAdStorage  = HSCodeConfig::get('DefaultAdStorage') ?: 'denied';
  $defaultAnalytics  = HSCodeConfig::get('DefaultAnalyticsStorage') ?: 'denied';

  if($enable)
  {
    $output = '';
    
    // Add Google Consent Mode if enabled
    if($enableGCM && ($googleAnalyticsID || $googleAdsID)) {
      $output .= "
      <!-- Google Consent Mode v2 -->
      <script>
        // Initialize Google Consent Mode BEFORE any gtag calls
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        
        // Set default consent state for specified regions
        gtag('consent', 'default', {
          'ad_storage': '{$defaultAdStorage}',
          'analytics_storage': '{$defaultAnalytics}',
          'ad_user_data': 'denied',
          'ad_personalization': 'denied',
          'functionality_storage': 'granted',
          'security_storage': 'granted',
          'region': ['" . str_replace(',', "','", $regions) . "']
        });
        
        // Set granted for other regions
        gtag('consent', 'default', {
          'ad_storage': 'granted',
          'analytics_storage': 'granted',
          'ad_user_data': 'granted',
          'ad_personalization': 'granted',
          'functionality_storage': 'granted',
          'security_storage': 'granted'
        });
      </script>";
      
      // Add Google Analytics 4 if configured
      if($googleAnalyticsID) {
        $output .= "
        <!-- Google Analytics 4 -->
        <script async src=\"https://www.googletagmanager.com/gtag/js?id={$googleAnalyticsID}\"></script>
        <script>
          gtag('config', '{$googleAnalyticsID}');
        </script>";
      }
      
      // Add Google Ads if configured
      if($googleAdsID) {
        $output .= "
        <script>
          gtag('config', '{$googleAdsID}');
        </script>";
      }
    }
    
    // Add cookie consent dialog CSS and JS
    $output .= "
    <link href=\"{$systemUrl}/modules/addons/Cookie/lib/css/ihavecookies.css\" rel=\"stylesheet\">
    <script src=\"{$systemUrl}/modules/addons/Cookie/lib/js/ihavecookies.js\" type=\"text/javascript\"></script>

    <script type=\"text/javascript\">
    var options = {
        title: '{$title}',
        message: '{$message}',
        delay: 600,
        expires: '{$expires}',
        link: '{$policy}',
        redirect: '{$redirect}',
        uncheckBoxes: true,
        acceptBtnLabel: '{$lang["accept"]}',
        declineBtnLabel: '{$lang["decline"]}',
        moreInfoLabel: '{$lang["cookiepolicy"]}',
        cookieTypes: [
            {
                type: '" . ($lang["necessary"] ?? "Necessary") . "',
                value: 'necessary',
                description: 'Te pliki cookie są niezbędne do prawidłowego działania strony internetowej.'
            },
            {
                type: '" . ($lang["analytics"] ?? "Analytics") . "',
                value: 'analytics',
                description: 'Pliki cookie związane z odwiedzinami witryny, typami przeglądarek itp.'
            },
            {
                type: '" . ($lang["marketing"] ?? "Marketing") . "',
                value: 'marketing',
                description: 'Pliki cookie związane z marketingiem, np. newslettery, media społecznościowe itp.'
            }
        ],
        onAccept: function(){
            " . ($enableGCM ? "updateGoogleConsent();" : "") . "
        }
    }

    $(document).ready(function() {
        $('body').ihavecookies(options);

        $('#ihavecookiesBtn').on('click', function(){
            $('body').ihavecookies(options, 'reinit');
        });
        
        " . ($enableGCM ? "
        // Handle decline button click for Google Consent Mode
        $('body').on('click', '#gdpr-cookie-advanced', function(){
            updateGoogleConsentDeclined();
        });" : "") . "
    });
    
    " . ($enableGCM ? "
         // Google Consent Mode update function
     function updateGoogleConsent() {
         if (typeof gtag === 'function') {
             var prefs = $('body').ihavecookies('cookie');
             var analyticsGranted = prefs && prefs.indexOf('analytics') !== -1;
             var marketingGranted = prefs && prefs.indexOf('marketing') !== -1;
             
             gtag('consent', 'update', {
                 'analytics_storage': analyticsGranted ? 'granted' : 'denied',
                 'ad_storage': marketingGranted ? 'granted' : 'denied',
                 'ad_user_data': marketingGranted ? 'granted' : 'denied',
                 'ad_personalization': marketingGranted ? 'granted' : 'denied'
             });
             
             console.log('Google Consent Mode updated (Accept):', {
                 analytics_storage: analyticsGranted ? 'granted' : 'denied',
                 ad_storage: marketingGranted ? 'granted' : 'denied',
                 ad_user_data: marketingGranted ? 'granted' : 'denied',
                 ad_personalization: marketingGranted ? 'granted' : 'denied'
             });
         }
     }
     
     // Google Consent Mode decline function
     function updateGoogleConsentDeclined() {
         if (typeof gtag === 'function') {
             gtag('consent', 'update', {
                 'analytics_storage': 'denied',
                 'ad_storage': 'denied',
                 'ad_user_data': 'denied',
                 'ad_personalization': 'denied'
             });
             
             console.log('Google Consent Mode updated (Declined):', {
                 analytics_storage: 'denied',
                 ad_storage: 'denied',
                 ad_user_data: 'denied',
                 ad_personalization: 'denied'
             });
         }
     }" : "") . "
    </script>";
    
    return $output;
  }
});
