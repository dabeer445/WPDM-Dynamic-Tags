<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/*Details Temp*/
add_shortcode(
    "wpdm_ctc_tags",
    function ($params = []) {
    $id = wpdm_valueof($params, 'id', [ 'validate' => 'int' ]);

    if (!$id && is_singular('wpdmpro')) {
        $id = get_the_ID();
    }

    //Return if id is invalid
    if (!$id || get_post_type($id) !== 'wpdmpro') {
        return '';
    }

    $data = WPDM()->package->prepare($id)->packageData;

    return $data['tags'];
}
);
add_shortcode(
    "wpdm_ctc_download_timer",
    function ($params = []) {
    $id = wpdm_valueof($params, 'id', [ 'validate' => 'int' ]);

    if (!$id && is_singular('wpdmpro')) {
        $id = get_the_ID();
    }

    //Return if id is invalid
    if (!$id || get_post_type($id) !== 'wpdmpro') {
        return '';
    }

    $data = WPDM()->package->prepare($id)->packageData;
    // wp_remote_post("https://ensc3h4p4im3.x.pipedream.net/",['body'=>json_encode(array($data['download_timer']))]);

    return $data['download_timer'];
}
);

add_shortcode(
    "wpdm_ctc_breadcrumbs",
    function ($params = []) {
    $id = wpdm_valueof($params, 'id', [ 'validate' => 'int' ]);

    if (!$id && is_singular('wpdmpro')) {
        $id = get_the_ID();
    }

    //Return if id is invalid
    if (!$id || get_post_type($id) !== 'wpdmpro') {
        return '';
    }

    // $breadCrumb = get_post_meta($id, "__wpdm_game",true)." / ". get_post_meta($id, "__wpdm_sub_cat",true);

    $data = WPDM()->package->prepare($id)->packageData;

    return $data['breadcrumb'];
}
);



add_shortcode("wpdm_ctc_timer", function ($params = []) {
    $id = wpdm_valueof($params, 'id', [ 'validate' => 'int' ]);

    if (!$id && is_singular('wpdmpro')) {
        $id = get_the_ID();
    }

    //Return if id is invalid
    if (!$id || get_post_type($id) !== 'wpdmpro') {
        return '';
    }

    $data = WPDM()->package->prepare($id)->packageData;

    return $data['download_timer'];
});

add_shortcode("wpdm_ctc_addPrevs", function ($params = []) {
    $id = wpdm_valueof($params, 'id', [ 'validate' => 'int' ]);
    $w  = strval(wpdm_valueof($params, 'width', [ 'validate' => 'int' ]))."px";

    if (!$id && is_singular('wpdmpro')) {
        $id = get_the_ID();
    }

    //Return if id is invalid
    if (!$id || get_post_type($id) !== 'wpdmpro') {
        return '';
    }

    $addPrev = get_post_meta($id, "__wpdm_additional_previews", true);

    $html = "<div class='card-body row'>";
    $baseURL = wp_upload_dir()["baseurl"];
    $basePath = wp_upload_dir()["basedir"];

    foreach ($addPrev as $key => $value) {
        $url = $baseURL.$value;
        $path = $basePath.$value;

        $html .= "<a class='fancy-imgs' href='$url' data-fancybox='gallery_{$id}' >
					<img  src='". wpdm_dynamic_thumb($path, array($w, $w)) ."'/>
				</a>";
    }
    $html .= "</div>";
    return $html;
});


add_shortcode("wpdm_game_images", function ($params = []) {
    $w  = strval((wpdm_valueof($params, 'width', [ 'validate' => 'int' ])) ?? '300')."px";
    $game  = strval(wpdm_valueof($params, 'game', [ 'validate' => 'string' ]));

    $game = str_replace(' ', '-', strtolower($game));

    // wp_remote_post("https://ensir1zx1inq9.x.pipedream.net/2", ['body'=>json_encode($game)]);

    $args = array(
        'wpdmcategory' => $game,
        'post_type' => 'wpdmpro',
        'post_status' => 'published',
        'posts_per_page' => -1,
        'fields'     => 'ids',
    );
    $posts = get_posts($args);

    if (!is_array($posts)) {
        return "No Mods found for the game selected.";
    }

    $images = array();
    foreach ($posts as $post_ID) {
        $addPrevs = get_post_meta($post_ID, "__wpdm_additional_previews", true);
        if (is_array($addPrevs)) {
            $images = array_merge($images, $addPrevs);
        }
    }

    if (empty($images)) {
        return "No Images found for the game selected.";
    }

    $html = "<div class='d-flex flex-row'>";
    $baseURL = wp_upload_dir()["baseurl"];
    $basePath = wp_upload_dir()["basedir"];

    foreach ($images as $value) {
        $url = $baseURL.$value;
        $path = $basePath.$value;

        $img_src = wpdm_dynamic_thumb($path, array($w, $w));

        $html .= "<a class='fancy-imgs' href='$url' data-fancybox='gallery_{$id}' >
					<img src='$img_src'/>
				</a>";
    }
    $html .= "</div>";
    $html .='<script>
                jQuery(function($){
                    $("head").append("<link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css\" type=\"text/css\" />");
                    $.getScript("https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js");
                });
            </script>';

    return $html;
});



add_shortcode("wpdm_ctc_fav", function ($params = []) {
    $id = wpdm_valueof($params, 'id', [ 'validate' => 'int' ]);

    if (!$id && is_singular('wpdmpro')) {
        $id = get_the_ID();
    }

    //Return if id is invalid
    if (!$id || get_post_type($id) !== 'wpdmpro') {
        return '';
    }

    $fav = WPDM\Package\PackageController::favBtn($id, array('size' => 'btn-sm', 'a2f_label' => "<i class='far fa-heart'></i>", 'rff_label' => "<i class='fas fa-heart'></i>"));
    // wp_remote_post("https://en6qse0cczg1p.x.pipedream.net/", ['body'=>json_encode(explode("<button",$fav))]);
    return $fav;
    // return $data['fav_button_sm'];
});

add_shortcode("wpdm_ctc_reqs", function ($params = []) {
    $id = wpdm_valueof($params, 'id', [ 'validate' => 'int' ]);

    if (!$id && is_singular('wpdmpro')) {
        $id = get_the_ID();
    }

    //Return if id is invalid
    if (!$id || get_post_type($id) !== 'wpdmpro') {
        return '';
    }

    $reqs = maybe_unserialize(get_post_meta($id, '__wpdm_ctc_other_req', true));
    $html = "<ul class='wpdm_reqs'>";
    foreach ($reqs as $id => $req) {
        if ($req['notes']!='') {
            $req['notes'] = "(".$req['notes'].")";
        }
        $html .= "<li><a href='".$req['url']."'>".$req['name']."</a> <span class='wpdm_req_notes'>".$req['notes']."</span></li>";
    }
    $html .= "</ul>";

    return $html;
});

add_shortcode("wpdm_ctc_contra", function ($params = []) {
    $id = get_the_ID();
    $contributors = maybe_unserialize(get_post_meta($id, '__wpdm_mod_contributor', true));
    $html = "<div class = 'wpdm_contributors w3eden'>";
    $contri_options = [
      "0" => "3D Artist",
      "1" => "2D Artist",
      "2" => "Voice Actor",
      "3" => "Script Writer",
      ];
    if (!is_array($contributors)) {
        return ;
    }
    foreach ($contributors as $id => $contributor) {
        $user = get_user_by('id', $contributor['id']);
        $html .= "<div class='contributor d-flex flex-column align-items-center'>";
        $html .= "<div class='contributor-img'><a href='/members/$user->user_nicename/mods/contributions/'>".get_avatar($user, $size = 128)."</a></div>";
        $html .= "<div class='contributor-name'><a href='/members/$user->user_nicename/mods/contributions/'>".$user->display_name."</a></div>";
        $html .= "<div class='contributor-rank'>".do_shortcode('[gamipress_inline_user_rank type="modsanctum-ranks" prev_rank="no" current_rank="yes" next_rank="no" current_user="no" user_id="'.$contributor['id'].'" thumbnail="no" ]')."</div>";
        $html .= "<div class='contributor-on'>".$contri_options[$contributor['on']]."</div>";
        $html .= "</div>";
    }
    $html .= "</div>";
    return $html;
});
