<?php
$reqList = array(
    'php' => '7.2.5',
    'mcrypt' => false,
    'openssl' => true,
    'pdo' => true,
    'mbstring' => true,
    'tokenizer' => true,
    'xml' => true,
    'ctype' => true,
    'json' => true,
    'bcmath' => true,
    'fileinfo' => true,
);


$strOk = '<i class="icon-ok la la-check-circle"></i>';
$strFail = '<i class="icon-remove la la-times-circle-o"></i>';
$strUnknown = '<i class="la la-question"></i>';

$requirements = array();


// PHP Version
$requirements['php_version'] = version_compare(PHP_VERSION, $reqList['php'], ">=");

// OpenSSL PHP Extension
$requirements['openssl_enabled'] = extension_loaded("openssl");

// PDO PHP Extension
$requirements['pdo_enabled'] = defined('PDO::ATTR_DRIVER_NAME');

// Mbstring PHP Extension
$requirements['mbstring_enabled'] = extension_loaded("mbstring");

// Tokenizer PHP Extension
$requirements['tokenizer_enabled'] = extension_loaded("tokenizer");

// XML PHP Extension
$requirements['xml_enabled'] = extension_loaded("xml");

// CTYPE PHP Extension
$requirements['ctype_enabled'] = extension_loaded("ctype");

// JSON PHP Extension
$requirements['json_enabled'] = extension_loaded("json");

// Mcrypt
$requirements['mcrypt_enabled'] = extension_loaded("mcrypt_encrypt");

// BCMath
$requirements['bcmath_enabled'] = extension_loaded("bcmath");

//File Info
$requirements['fileinfo'] = extension_loaded("fileinfo");

// mod_rewrite
$requirements['mod_rewrite_enabled'] = null;

if (function_exists('apache_get_modules')) {
    $requirements['mod_rewrite_enabled'] = in_array('mod_rewrite', apache_get_modules());
}
?>
    <style>
        .logo img {
            margin-right: 1.25em;
        }

        p {
            margin: 0 0 5px;
        }

        p small {
            font-size: 13px;
            display: block;
            margin-bottom: 1em;
        }

        p.obs {
            margin-top: 20px;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
            color: #31708f;
            background-color: #d9edf7;
            border-color: #bce8f1;
        }

        .icon-ok {
            color: #27ae60;
        }

        .icon-remove {
            color: #c0392b;
        }
    </style>

<p>
    PHP <?php
    if (is_array($reqList['php'])) {
        $phpVersions = array();
        foreach ($reqList['php'] as $operator => $version) {
            $phpVersions[] = "{$operator} {$version}";
        }
        echo implode(" && ", $phpVersions);
    }else{
        echo ">= " . $reqList['php'];
    }

    echo " " . ($requirements['php_version'] ? $strOk : $strFail); ?>
    (<?php echo PHP_VERSION; ?>)
</p>


<?php if ($reqList['openssl']) : ?>
    <p>OpenSSL PHP Extension <?php echo $requirements['openssl_enabled'] ? $strOk : $strFail; ?></p>
<?php endif; ?>

<?php if ($reqList['pdo']) : ?>
    <p>PDO PHP Extension <?php echo $requirements['pdo_enabled'] ? $strOk : $strFail; ?></p>
<?php endif ?>

<?php if ($reqList['mbstring']) : ?>
    <p>Mbstring PHP Extension <?php echo $requirements['mbstring_enabled'] ? $strOk : $strFail; ?></p>
<?php endif ?>

<?php if ($reqList['tokenizer']) : ?>
    <p>Tokenizer PHP Extension <?php echo $requirements['tokenizer_enabled'] ? $strOk : $strFail; ?></p>
<?php endif ?>


<?php if ($reqList['xml']) : ?>
    <p>XML PHP Extension <?php echo $requirements['xml_enabled'] ? $strOk : $strFail; ?></p>
<?php endif ?>

<?php if ($reqList['ctype']) : ?>
    <p>CTYPE PHP Extension <?php echo $requirements['ctype_enabled'] ? $strOk : $strFail; ?></p>
<?php endif ?>

<?php if ($reqList['json']) : ?>
    <p>JSON PHP Extension <?php echo $requirements['json_enabled'] ? $strOk : $strFail; ?></p>
<?php endif ?>

<?php if ($reqList['mcrypt']) : ?>
    <p>Mcrypt PHP Extension <?php echo $requirements['mcrypt_enabled'] ? $strOk : $strFail; ?></p>
<?php endif ?>

<?php if (isset($reqList['bcmath']) && $reqList['bcmath']) : ?>
    <p>BCmath PHP Extension <?php echo $requirements['bcmath_enabled'] ? $strOk : $strFail; ?></p>
<?php endif ?>

<?php if (isset($reqList['fileinfo']) && $reqList['fileinfo']) : ?>
<p>Fileinfo PHP Extension <?php echo $requirements['fileinfo'] ? $strOk : $strFail; ?></p>
<?php endif ?>

<p>Root writable to write <code>.env</code> file <?php echo is_writable(base_path())? $strOk : $strFail; ?> </p>

<p>magic_quotes_gpc: <?php echo !ini_get('magic_quotes_gpc') ? $strOk : $strFail; ?> (value: <?php echo ini_get('magic_quotes_gpc') ?>)</p>
<p>register_globals: <?php echo !ini_get('register_globals') ? $strOk : $strFail; ?> (value: <?php echo ini_get('register_globals') ?>)</p>
<p>session.auto_start: <?php echo !ini_get('session.auto_start') ? $strOk : $strFail; ?> (value: <?php echo ini_get('session.auto_start') ?>)</p>
<p>mbstring.func_overload: <?php echo !ini_get('mbstring.func_overload') ? $strOk : $strFail; ?> (value: <?php echo ini_get('mbstring.func_overload') ?>)</p>

<p class="alert alert-light bg-light my-3">
    <strong>To continue the installation process, all the above requirements are needed to be checked {!! $strOk !!} </strong> <br />

    If you found any of requirement cross icon {!! $strFail !!}, please contact with your hosting provider to resolve this issue.
</p>
