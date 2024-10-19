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

  if($enable)
  {
    return <<<HTML
    <link href="{$systemUrl}/modules/addons/Cookie/lib/css/ihavecookies.css" rel="stylesheet">
    <script src="{$systemUrl}/modules/addons/Cookie/lib/js/ihavecookies.js" type="text/javascript"></script>

    <script type="text/javascript">
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
        moreInfoLabel: '{$lang["cookiepolicy"]}'
    }

    $(document).ready(function() {
        $('body').ihavecookies(options);

        $('#ihavecookiesBtn').on('click', function(){
            $('body').ihavecookies(options, 'reinit');
        });
    });
    </script>
HTML;
  }
});
