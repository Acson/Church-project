<?php
define("INC", TEMPLATEPATH . "/functions");
define("WIDGETS", TEMPLATEPATH . "/widgets");

require_once INC . "/wpzoom-functions.php";
require_once INC . "/wpzoom-core.php";

/**
 * Widgets
 */
require_once WIDGETS . "/wpzoom-video-widget.php";

?>