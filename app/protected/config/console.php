<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return CMap::mergeArray(
    require(dirname(__FILE__).'/common.php'),
    array(
        'name'=>'Me-Travel (Console)',
        'import'=>array(
            'application.models.*',
            'application.components.*',
        ),
    )
);