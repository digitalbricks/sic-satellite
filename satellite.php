<?php
//ini_set('display_errors', 'On');
//error_reporting(E_ALL);
/**
 * SIC Satellite
 *
 * – EN –
 * PLEASE LEAVE THIS FILE IN PLACE
 * This file was placed by your website administrator
 * in order to get information of your website remotely,
 * such as the version of the CMS and the version of PHP.
 * The administrator uses that information for keeping
 * track of technical state of your site.
 * If you have any questions about this file, don't hesitate
 * to ask you administrator named below.
 *
 * – DE –
 * BITTE DIESE DATEI NICHT LÖSCHEN
 * Diese Datei wurde vom Administrator Ihrer Website abeglegt,
 * um aus der Ferne Daten Ihrer Website abzufragen, wie etwa die
 * Version des eingesetzten CMS und PHP-Version
 * Der Administrator nutzt diese Informationen, um den
 * technischen Status Ihrer Website im Blick zu behalten.
 * Falls Sie Fragen zu dieser Datei haben, zögern Sie nicht den
 * unten benannten Administrator Ihrer Site zu befragen.
 * 
 * 
 * [YOUR_CONTACT_INFORMATION]
 *
*/


/*--- SETUP -------------------------------------------------*/
// shared secret, matching the value defined in SIC site_config
$sat_secret = "[YOUR_SECRET]";



/*--- SATELLITE (no need for changes)------------------------*/
// satellite version: The current version of the satellite
// Will be displayed in your SIC
$siteinfo['sat_ver'] = "1.2.0";

/**
* see CHANGELOG.md for changes history
*/

// getting php version
$siteinfo['php_ver'] = phpversion();

// check if he got valid data
if(isset($_POST['sys']) AND isset($_POST['secret']) AND $_POST['sys']!='' AND $_POST['secret']!=''){

    // check if phpinfo() request in POST action
    if(isset($_POST['action']) AND $_POST['action'] == "PHPINFO"){
        ob_start();
        phpinfo();
        $phpinfo = ob_get_clean();
        echo $phpinfo;
        exit;
    }

/**
* Currently supported systems
* NOTE: This list is parsed by the SIC, so please keep the format as it is and
*       update if new systems were added.
* 
* sys=LEPTON4       | Lepton CMS, since version 4.x
* sys=LEPTON24      | Lepton CMS, since version 2.4
* sys=LEPTON        | Lepton CMS, below version 2.4
* sys=MODX          | MODX Revolution CMS
* sys=WORDPRESS     | WordPress CMS
* sys=WEBSITEBAKER  | WebsiteBaker CMS
* sys=WBCE          | WBCE CMS
* sys=GETSIMPLE     | GetSimple CMS
* sys=PROCESSWIRE   | ProcessWire CMS/CMF
* sys=STATIC        | Static PHP Website
* sys=SHOPWARE5     | Shopware 5
* sys=SHOPWARE6     | Shopware 6
* sys=PAGEKIT       | Pagekit CMS
* sys=BLACKCAT      | BlackCat CMS
* sys=JOOMLA        | Joomla! CMS
* sys=JOOMLA15      | Joomla! CMS, legacy version 1.5
* sys=CONCRETE5     | Concrete5 CMS
* sys=NEXTCLOUD     | NextCloud
* sys=PIWIK         | Matomo / Piwik
* sys=JTLSHOP4      | JTL-Shop 4
* sys=JTLSHOP5      | JTL-Shop 5
* sys=MODIFIEDSHOP  | modified eCommerce Shop
* sys=MOODLE        | Moodle e-learning plattform
* sys=PHPLIST       | phpList Email Marketing 
* sys=TYPO3         | TYPO3 CMS 
*
*/

 // check if secret was correct
 if($sat_secret != $_POST['secret']){
    http_response_code(403);
    echo "Authentification failed.";
 } else {
    // everything seems to be fine, let's proceed ...
    // Determine wich function has to be called
    switch ($_POST['sys']) {
        case "LEPTON4":
            $siteinfo['sys_ver'] = sat_LEPTON4();
            break;
        case "LEPTON24":
            $siteinfo['sys_ver'] = sat_LEPTON24();
            break;
        case "LEPTON":
            $siteinfo['sys_ver'] = sat_LEPTON();
            break;
        case "MODX":
            $siteinfo['sys_ver'] = sat_MODX();
            break;
        case "WORDPRESS":
            $siteinfo['sys_ver'] = sat_WORDPRESS();
            break;
        case "WEBSITEBAKER":
            $siteinfo['sys_ver'] = sat_WB();
            break;
        case "WBCE":
            require_once('config.php'); // if included inside the sat_WBCE() it causes a Fatal Error
            $siteinfo['sys_ver'] = sat_WBCE();
            break;
        case "GETSIMPLE":
            $siteinfo['sys_ver'] = sat_GETSIMPLE();
            break;
        case "PROCESSWIRE":
            $siteinfo['sys_ver'] = sat_PROCESSWIRE();
            break;
        case "STATIC":
            $siteinfo['sys_ver'] = "static";
            break;
        case "SHOPWARE": // just for backwards compatibility
            $siteinfo['sys_ver'] = sat_SHOPWARE5();
            break;
        case "SHOPWARE5":
            $siteinfo['sys_ver'] = sat_SHOPWARE5();
            break;
        case "SHOPWARE6":
            $siteinfo['sys_ver'] = sat_SHOPWARE6();
            break;
        case "PAGEKIT":
            $siteinfo['sys_ver'] = sat_PAGEKIT();
            break;
        case "BLACKCAT":
            $siteinfo['sys_ver'] = sat_BLACKCAT();
            break;
        case "JOOMLA":
            $siteinfo['sys_ver'] = sat_JOOMLA();
            break;
        case "JOOMLA15":
            $siteinfo['sys_ver'] = sat_JOOMLA15();
            break;
        case "CONCRETE5":
            $siteinfo['sys_ver'] = sat_CONCRETE5();
            break;
        case "NEXTCLOUD":
            $siteinfo['sys_ver'] = sat_NEXTCLOUD();
            break;
        case "PIWIK":
            $siteinfo['sys_ver'] = sat_PIWIK();
            break;
        case "JTLSHOP": // just for backwards compatibility
            $siteinfo['sys_ver'] = sat_JTLSHOP4();
            break;
        case "JTLSHOP4":
            $siteinfo['sys_ver'] = sat_JTLSHOP4();
            break;
        case "JTLSHOP5":
            $siteinfo['sys_ver'] = sat_JTLSHOP5();
            break; 
        case "MODIFIEDSHOP":
            $siteinfo['sys_ver'] = sat_MODIFIEDSHOP();
            break; 
        case "MOODLE":
            $siteinfo['sys_ver'] = sat_MOODLE();
            break; 
        case "PHPLIST":
            $siteinfo['sys_ver'] = sat_PHPLIST();
            break;
        case "TYPO3":
            $siteinfo['sys_ver'] = sat_TYPO3();
            break; 
        default:
            http_response_code(400);
            echo "System not valid.";
    }

    // send response
    $response = json_encode($siteinfo);
    echo $response;

 }

} else {
    http_response_code(400);
    echo "No valid data";
};


/**
 * sat_CONCRETE5
 * Gets version of Concrete5, tested with 8.1.0 and 8.2.1
 * @since Version 0.12
 */
function sat_CONCRETE5(){
    // NOTE: When using Concrete5 Version 5, you HAVE to
    // comment out the include if concrete/bootstrap/configure.php
    // else the satellite will return a rendered output of the page
    $config = include('concrete/bootstrap/configure.php');
    $config = include('concrete/config/concrete.php');
    return $config['version_installed'];
}


/**
 * sat_JOOMLA
 * Gets version of Joomla! CMS, tested with 3.6 and 3.8.2
 * @since Version 0.11
 */
function sat_JOOMLA(){
    // needs to be defined
    define('_JEXEC', 1);
    if (!defined('_JDEFINES')){
        define('JPATH_BASE', __DIR__);
        require_once JPATH_BASE . '/includes/defines.php';
    }
    require_once JPATH_BASE . '/includes/framework.php';

    // create JVersion object
    $version = new JVersion();

    return $version->getShortVersion();
 }


 /**
 * sat_JOOMLA15
 * Gets version of legacy Joomla! CMS v1.5
 * @since Version 0.13
 */
 function sat_JOOMLA15(){
    // needs to be defined
    define('_JEXEC', 1);
    if (!defined('_JDEFINES')){
        define('JPATH_BASE', _DIR_);
        require_once JPATH_BASE . '/includes/defines.php';
    }
    require_once JPATH_BASE . '/libraries/joomla/version.php';
    
    // create JVersion object
    $version = new JVersion();
    
    return $version->getShortVersion();
 }


/**
 * sat_BLACKCAT
 * Gets version of BlackCat CMS, 1.x series
 * @since Version 0.10
 */
function sat_BLACKCAT(){
    require_once('config.php');
    
    include CAT_PATH.'/framework/class.frontend.php';
    $wb = new frontend();

    return CAT_VERSION;
 }


/**
 * sat_PAGEKIT
 * Gets version of Pagekit since version 1
 * @since Version 0.9
 */
function sat_PAGEKIT(){
    // config file requires a `$path`, setting an empty path variable
    $path = '';
    $config = require('app/system/config.php');
    $version = $config['application']['version'];

    return $version;
}


/**
 * sat_SHOPWARE5
 * Gets version of Shopware since version 5
 * @since Version 0.9
 */
function sat_SHOPWARE5(){
    require __DIR__ . '/autoload.php';
    $environment = getenv('SHOPWARE_ENV') ?: getenv('REDIRECT_SHOPWARE_ENV') ?: 'production';
    $kernel = new \Shopware\Kernel($environment, $environment !== 'production');

    $releaseinfo = $kernel->getRelease();
    return $releaseinfo['version'];
}

/**
 * sat_SHOPWARE6
 * Gets version of Shopware since version 6
 * @since Version 0.20, updated in 0.24
 */
function sat_SHOPWARE6(){
    require __DIR__ . '/../vendor/autoload.php';
    $version = \Composer\InstalledVersions::getVersion('shopware/core');
    return $version;
};


/**
 * sat_LEPTON4
 * Gets version of LEPTON CMS since version 4.x
 * @since Version 0.19
 */
function sat_LEPTON4(){
    require_once(dirname(__FILE__).'/config/config.php');
    $oLEPTON = new LEPTON_frontend();
    return LEPTON_VERSION;
}


/**
 * sat_LEPTON24
 * Gets version of LEPTON CMS since version 2.4
 * @since Version 0.8
 */
function sat_LEPTON24(){
    require_once('config.php');
    require_once(LEPTON_PATH.'/framework/class.frontend.php');
    // Create new frontend object
    $wb = new frontend();

    return  LEPTON_VERSION;
}


/**
 * sat_LEPTON
 * Gets version of LEPTON CMS
 * @since Version 0.1
 */
function sat_LEPTON(){
    require_once('config.php');

    // connect to db
    $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }
    // get information
    $sql = "SELECT value FROM ".TABLE_PREFIX."settings WHERE name = 'lepton_version'";

    if($result = $mysqli->query($sql)){
        $row=$result->fetch_assoc();
        return $row['value'];
    } else {
        return "not found";
    };
}


/**
 * sat_WB
 * Gets version of WebsiteBaker CMS
 * @since Version 0.2
 */
function sat_WB(){
  require_once('config.php');

  // connect to db
  $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
  if ($mysqli->connect_errno) {
      printf("Connect failed: %s\n", $mysqli->connect_error);
      exit();
  }
  // intinal values
  $wb_version = "not found";
  $wb_sp = "";
  $wb_revision = "";

  // get version information
  $sql = "SELECT * FROM ".TABLE_PREFIX."settings WHERE name = 'wb_version'";
  if($result = $mysqli->query($sql)){
  	$row=$result->fetch_assoc();
    $wb_version = $row['value'];
  };

  // get service pack information
  $sql = "SELECT * FROM ".TABLE_PREFIX."settings WHERE name = 'wb_sp'";
  if($result = $mysqli->query($sql)){
  	$row=$result->fetch_assoc();
    $wb_sp = " ".$row['value'];
  };

  // get revision information
  $sql = "SELECT * FROM ".TABLE_PREFIX."settings WHERE name = 'wb_revision'";
  if($result = $mysqli->query($sql)){
  	$row=$result->fetch_assoc();
    $wb_revision = " Rev".$row['value'];
  };

  // combine version
  $version = $wb_version.$wb_sp.$wb_revision;
  return $version;
}

/**
 * sat_WORDPRESS
 * Gets version of WordPress
 * @since Version 0.3
 */
function sat_WORDPRESS(){
  require_once('wp-includes/version.php');
  return $wp_version;
}

/**
 * sat_WBCE
 * Gets version of WebsiteBaker Community Edition
 * @since Version 0.4
 */
function sat_WBCE(){
    // connect to db
    $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }

    // get information
    $sql = "SELECT * FROM ".TABLE_PREFIX."settings WHERE name = 'wbce_version'";

    if($result = $mysqli->query($sql)){
        $row=$result->fetch_assoc();
        return $row['value'];
    } else {
        return "not found";
    };
}

/**
 * sat_PROCESSWIRE
 * Gets version of ProcessWire
 * @since Version 0.5
 */
function sat_PROCESSWIRE(){
  // loading the API
  require_once('index.php');
  $version = $wire->config->version;

  // check if Debug-Mode is ON
  // and if so, give a hint to SIC
  if($wire->config->debug===true){
    $version.= " (Debug ON)";
  }
  return $version;
}

/**
 * sat_MODX
 * Gets version of MODX Revolution
 * @since Version 0.6
 */
function sat_MODX(){
  // loading MODX
  require_once 'config.core.php';
  require_once MODX_CORE_PATH.'model/modx/modx.class.php';
  $modx = new modX();
  $modx->initialize('web');
  $modx->getService('error','error.modError', '', '');

  // getting version
  $vers = $modx->getVersionData();
  return $vers['full_version'];
}

/**
 * sat_GETSIMPLE
 * Gets version of GetSimple CMS
 * @since Version 0.7
 */
function sat_GETSIMPLE(){
    define("IN_GS",true);
    require_once('admin/inc/basic.php');
    require_once('admin/inc/configuration.php');
    return $site_version_no;
}

/**
 * sat_NEXTCLOUD
 * Gets version of NextCloud
 * @since Version 0.15
 */
function sat_NEXTCLOUD(){
    require_once('version.php');
    return $OC_VersionString;
}

/**
 * sat_PIWIK
 * Gets version of PIWIK / Matomo
 * @since Version 0.16
 */
function sat_PIWIK(){
    require_once('core/Version.php');
    $version = new Piwik\Version;
    return $version::VERSION;
}

/**
 * sat_JTLSHOP4
 * Gets version of JTL-Shop 4
 * @since Version 0.17
 */
function sat_JTLSHOP4(){
    require_once('includes/defines_inc.php');
    return (JTL_VERSION / 100)." (Build: ".JTL_MINOR_VERSION.")";
}

/**
 * sat_JTLSHOP5
 * Gets version of JTL-Shop 5
 * @since Version 0.23
 */
function sat_JTLSHOP5(){
    define('PFAD_LOGFILES',false);
    require_once('includes/defines_inc.php');
    return APPLICATION_VERSION;
}

/**
 * sat_MODIFIEDSHOP
 * Gets version of modified eCommerce Shop
 * @since Version 0.18
 */
function sat_MODIFIEDSHOP(){
    require_once('admin/includes/version.php');
    return PROJECT_MAJOR_VERSION . '.' . PROJECT_MINOR_VERSION;
}

/**
 * sat_MOODLE
 * Gets version of modified Moodle e-learning plattform
 * @since Version 0.21
 */
function sat_MOODLE(){
    define('MOODLE_INTERNAL',true);
    require_once 'version.php';
    return $release;
}

/**
 * sat_PHPLIST
 * Gets version of phpList Email marketing / newsletter system
 * @since Version 1.1.0
 */
function sat_PHPLIST(){
    if(file_exists('lists/admin/init.php')){
        include_once 'lists/admin/init.php';
    } elseif(file_exists('lists/admin/about.php')){
        include_once 'admin/init.php';
    }
    if(defined('VERSION')){
        return VERSION;
    }
}

/**
 * sat_TYPO3
 * Gets version of TYPO3 CMS
 * @since Version 1.2.0
 */
function sat_TYPO3(){
    if(!file_exists('typo3/sysext/core/Classes/Information/Typo3Version.php')) return;
    include('typo3/sysext/core/Classes/Information/Typo3Version.php');
    $t3version = new \TYPO3\CMS\Core\Information\Typo3Version();
    return $t3version->getVersion(); 
}