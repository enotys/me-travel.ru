#!/bin/sh
cd ../app/
sed -i -e "s/defined('YII_DEBUG') or define('YII_DEBUG',true);/defined('YII_DEBUG') or define('YII_DEBUG',false);/g" index.php
sed -i -e "s/defined('YII_DEBUG') or define('YII_DEBUG',true);/defined('YII_DEBUG') or define('YII_DEBUG',false);/g" protected/yiic.php
sed -i -e "s/defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);//g" index.php
sed -i -e "s/defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);//g" protected/yiic.php