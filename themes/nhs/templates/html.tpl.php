<?php print $doctype; ?>
<html lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"<?php print $rdf->version . $rdf->namespaces; ?>>
<head<?php print $rdf->profile; ?>>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>  
  <?php print $styles; ?>
  <?php print $scripts; ?>
  <!--[if lt IE 8]><link rel="stylesheet" type="text/css" href="<?php echo base_path() . drupal_get_path("theme", "nhs") . '/css/ie7-keystaff-fix.css' ?>" /><![endif]-->
  <!--[if lt IE 9]><link rel="stylesheet" type="text/css" href="<?php echo drupal_get_path("theme", "nhs") . '/css/nhs-nhs-default-narrow.css' ?>" /><![endif]-->
  <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body<?php print $attributes;?>>
  <div id="skip-link">
    <a href="#main-content" accesskey="c" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
    <a href="#main-menu" accesskey="n" class="element-invisible element-focusable"><?php print t('Skip to main menu'); ?></a>
    <a href="#section-content" accesskey="s" class="element-invisible element-focusable"><?php print t('Skip navigation'); ?></a>
    <a href="#section-footer" accesskey="f" class="element-invisible element-focusable"><?php print t('Skip to footer'); ?></a>
  </div>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
</body>
</html>