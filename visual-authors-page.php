<?php

/*
  Plugin Name: Visual Authors Page
  Description: This "Visual Authors page" plugin display authors list in any page by placing shortcode on it.
  Author: alcharkov
  Author URI: https://github.com/alcharkov
  Version: 1.0
 */

function vap_register_admin_menu_page() {
    add_menu_page(
            __('Authors page', 'vap'), 'Authors', 'manage_options', 'visual-authors-page/visual-authors-page-admin.php', '', '', 6
    );
}

add_action('admin_menu', 'vap_register_admin_menu_page');

//TODO: add only on admin page
wp_enqueue_script('vauthor-script', plugin_dir_url(__FILE__) . 'js/admin.js', null, false, true);
wp_enqueue_style('vauthor-style', plugin_dir_url(__FILE__) . 'css/style.css');

function vap_checkRoles($roles) {
    $db_roles = vap_get_roles_keys();
    $roles_lower = explode(',', strtolower($roles));
    return array_intersect($roles_lower, $db_roles);
}


function vap_aup_render_authors_page($roles = null, $authors = null, $post_counter = '', $bio = false, $avatar = false, $border = false) {
    global $wp_query;
    
    $args = array(
        'blog_id' => $GLOBALS['blog_id'],
        'role__in' => vap_checkRoles($roles),
        'exclude' => explode(',', $authors),
        'orderby' => 'post_count',
        'order' => 'DESC',
    );

    $authors = get_users($args);
    
    $html = '<div id="vauthors">';

    foreach ($authors as $author) {

        $html .= '<div class="vauthor-entry" ' . 'style="' . ($border ? 'border: 1px solid #000;' : '') . '">';

        $url = get_author_posts_url($author->ID, $author->user_nicename);

        $post_counter_html = '';
        if (!empty($post_counter)) {
            $counter = count_user_posts($author->ID);
            if ('post' === $post_counter) {
                $post_counter_html = '(' . $counter . ')';
            } else {
                $post_counter_html = str_replace('%post%', $counter, $post_counter);
            }
        }

        $html .= '<div class="vauthor-data">';
        if ($avatar) {
            $html .= '<a href="' . esc_attr($url) . '" >' . get_avatar($author->ID) . '</a>';
        }
        $html .= '<div class="vauthor-post-counter"><a href="' . esc_attr($url) . '" >' . $post_counter_html . '</a></div>';
        $html .= '</div>';

        $html .= '<div class="vauthor-bio">';
        $html .= '<a href="' . esc_attr($url) . '" >' . $author->display_name . '</a> ';
        if ($bio) {
            $html .= nl2br(get_the_author_meta('description', $author->ID));
        }
        $html .= '</div>';

        $html .= '<br style="clear: both;" />';

        $html .= '</div>';
    }

    $html .= '</div>';
    return $html;
}

add_filter('query_vars', 'vap_my_add_query_vars');

function vap_my_add_query_vars($public_query_vars) {
    $public_query_vars[] = 'author_login';
    return $public_query_vars;
}

add_shortcode('vauthors_page', 'vap_aup_shortcode');

function vap_aup_shortcode($atts) {

    $role = isset($atts['roles']) ? sanitize_text_field($atts['roles']) : null;
    $authors = isset($atts['authors']) ? sanitize_text_field($atts['authors']) : null;
    $post_counter = isset($atts['counter']) ? sanitize_text_field($atts['counter']) : '';
    $bio = in_array('bio', $atts);
    $avatar = in_array('avatar', $atts);
    $border = in_array('border', $atts);

    return vap_aup_render_authors_page($role, $authors, $post_counter, $bio, $avatar, $border);
}

function vap_get_roles_keys() {
    $Roles = vap_get_roles();
    $RoleKeys = array_keys($Roles);
    return $RoleKeys;
}

function vap_get_roles() {
    /**
     * @var WP_Roles
     */
    global $wp_roles;
    if (!isset($wp_roles))
        $wp_roles = new WP_Roles();
    $Roles = $wp_roles->get_names();
    return $Roles;
}
