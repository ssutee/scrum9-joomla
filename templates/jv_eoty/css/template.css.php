<?php 

// Gzip CSS 
// http://www.fiftyfoureleven.com/weblog/web-development/css/the-definitive-css-gzip-method

if (extension_loaded('zlib') && !ini_get('zlib.output_compression')) @ob_start('ob_gzhandler');
header('Content-type: text/css; charset: UTF-8');
header('Cache-Control: must-revalidate');
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', dirname(__FILE__) . DS);

/*---------------------------------------------------------------- 
  Copyright:
  Copyright (C) 2008 JoomVision. All Rights Reserved
  
  License:
  Copyrighted Commercial Software 
  
  Author:
  JoomVision - http://wwww.joomvision.com
---------------------------------------------------------------- */

/* General */
include(ROOT_DIR . 'default.css');

/* Style template  */ 
include(ROOT_DIR . 'template.css');

/* Typo template  */ 
include(ROOT_DIR . 'typo.css');

/* RTl template */
include(ROOT_DIR . 'template_rtl.css');

/* K2 support  */ 
//include(ROOT_DIR . 'k2.css');   


?>