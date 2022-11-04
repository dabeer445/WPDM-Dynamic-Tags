<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
$files = array(
    '/mod-name.php',
    '/mod-breadcrumbs.php',
    '/mod-version.php',
    '/mod-createDate.php',
    '/mod-modifyDate.php',
    '/mod-mainLink.php',
    '/mod-editMod.php',
    '/mod-coverImage.php',
    '/mod-prevImage.php',
    '/mod-shortDescription.php',
    '/mod-size.php',
    '/mod-views.php',
    '/mod-downloads.php',
    '/mod-myMods.php',
    '/mod-myFavs.php',
    '/mod-myDownloads.php',
    '/mod-myContributions.php',
    '/mod-links.php',
    '/mod-prevGallery.php',
    '/mod-permalink.php',
    '/mod-authorLink.php',
    '/mod-tracking.php',
    '/mod-game-images.php',
    '/mod-dowloaded-id.php',
    '/mod-contribution-id.php',
    '/mod-displayed-user-mods-id.php',
    '/mod-delMod.php',
    '/custom-post-meta.php',
    '/mod-package-id.php',
    '/timer.php',
);
foreach ($files as $file) {
    require_once(TAG_DIR . $file);
}


// require_once( TAG_DIR . '/mod-name.php' );
