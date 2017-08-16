<?php
/**
 * Gets the UsersWP page permalink based on page type.
 *
 * @since       1.0.0
 * @package     userswp
 * @param       string|bool     $type       Page type.
 * @return      string                      Page permalink.
 */
function get_uwp_page_permalink($type) {
    $page = new UsersWP_Pages();
    return $page->get_page_permalink($type);
}

/**
 * Gets the UsersWP register page permalink.
 *
 * @since       1.0.0
 * @package     userswp
 * @return      string      Page permalink.
 */
function get_uwp_register_permalink() {
    $page = new UsersWP_Pages();
    return $page->get_register_permalink();
}

/**
 * Gets the UsersWP login page permalink.
 *
 * @since       1.0.0
 * @package     userswp
 * @return      string      Page permalink.
 */
function get_uwp_login_permalink() {
    $page = new UsersWP_Pages();
    return $page->get_login_permalink();
}

/**
 * Gets the UsersWP forgot password page permalink.
 *
 * @since       1.0.0
 * @package     userswp
 * @return      string      Page permalink.
 */
function get_uwp_forgot_permalink() {
    $page = new UsersWP_Pages();
    return $page->get_forgot_permalink();
}

/**
 * Gets the UsersWP reset password page permalink.
 *
 * @since       1.0.0
 * @package     userswp
 * @return      string      Page permalink.
 */
function get_uwp_reset_permalink() {
    $page = new UsersWP_Pages();
    return $page->get_reset_permalink();
}

/**
 * Gets the UsersWP account page permalink.
 *
 * @since       1.0.0
 * @package     userswp
 * @return      string      Page permalink.
 */
function get_uwp_account_permalink() {
    $page = new UsersWP_Pages();
    return $page->get_account_permalink();
}

/**
 * Gets the UsersWP profile page permalink.
 *
 * @since       1.0.0
 * @package     userswp
 * @return      string      Page permalink.
 */
function get_uwp_profile_permalink() {
    $page = new UsersWP_Pages();
    return $page->get_profile_permalink();
}

/**
 * Gets the UsersWP users page permalink.
 *
 * @since       1.0.0
 * @package     userswp
 * @return      string      Page permalink.
 */
function get_uwp_users_permalink() {
    $page = new UsersWP_Pages();
    return $page->get_users_permalink();
}

/**
 * Gets the UsersWP page permalink based on page type.
 *
 * @since       1.0.0
 * @package     userswp
 * @param       string     $page_type      Page type.
 * @return      string                     Page permalink.
 */
function uwp_get_page_link($page_type) {
    $page = new UsersWP_Pages();
    return $page->get_page_link($page_type);
}

/**
 * Builds the profile page url based on the tab and sub tab given
 * yoursite.com/profile/username
 * yoursite.com/profile/username/tab
 * yoursite.com/profile/username/tab/subtab
 *
 * @since       1.0.0
 * @package     userswp
 * @param       int             $user_id            User ID.
 * @param       string|bool     $tab                Optional. Main tab
 * @param       string|bool     $subtab             Optional. Sub tab.
 * @return      string                              Built profile page link.
 */
function uwp_build_profile_tab_url($user_id, $tab = false, $subtab = false) {
    $page = new UsersWP_Pages();
    return $page->build_profile_tab_url($user_id, $tab, $subtab);
}

/**
 * Returns the page link for register page.
 *
 * @since       1.0.0
 * @package     userswp
 *
 * @return      array|bool|mixed    Page link.
 */
function uwp_get_register_page_url() {
    return uwp_get_page_url_data('register_page');
}

/**
 * Returns the page link for login page.
 *
 * @since       1.0.0
 * @package     userswp
 *
 * @return      array|bool|mixed    Page link.
 */
function uwp_get_login_page_url() {
    return uwp_get_page_url_data('login_page');
}

/**
 * Returns the page link for forgot password page.
 *
 * @since       1.0.0
 * @package     userswp
 *
 * @return      array|bool|mixed    Page link.
 */
function uwp_get_forgot_page_url() {
    return uwp_get_page_url_data('forgot_page');
}

/**
 * Returns the page link for change password page.
 *
 * @since       1.0.0
 * @package     userswp
 *
 * @return      array|bool|mixed    Page link.
 */
function uwp_get_change_page_url() {
    return uwp_get_page_url_data('change_page');
}

/**
 * Returns the page link for reset password page.
 *
 * @since       1.0.0
 * @package     userswp
 *
 * @return      array|bool|mixed    Page link.
 */
function uwp_get_reset_page_url() {
    return uwp_get_page_url_data('reset_page');
}

/**
 * Returns the page link for account page.
 *
 * @since       1.0.0
 * @package     userswp
 *
 * @return      array|bool|mixed    Page link.
 */
function uwp_get_account_page_url() {
    return uwp_get_page_url_data('account_page');
}

/**
 * Returns the page link for profile page.
 *
 * @since       1.0.0
 * @package     userswp
 *
 * @return      array|bool|mixed    Page link.
 */
function uwp_get_profile_page_url() {
    return uwp_get_page_url_data('profile_page');
}

/**
 * Returns the page link for users page.
 *
 * @since       1.0.0
 * @package     userswp
 *
 * @return      array|bool|mixed    Page link.
 */
function uwp_get_users_page_url() {
    return uwp_get_page_url_data('users_page');
}

/**
 * Returns the page info like page title, slug and link.
 * If output type is "link", then only the link is returned.
 *
 * @since       1.0.0
 * @package     userswp
 *
 * @param       string              $page_type      Page type.
 * @param       string              $output_type    Link or Array?
 *
 * @return      array|bool|mixed                    Page info or link.
 */
function uwp_get_page_url_data($page_type, $output_type = 'link') {

    $install_type = uwp_get_installation_type();

    $page_data = array();
    switch ($install_type) {
        case "single":
            $page_data = uwp_get_page_url_page_data($page_data, $page_type);
            break;
        case "multi_na_all":
            $page_data = uwp_get_page_url_page_data($page_data, $page_type);
            break;
        case "multi_na_site_id":
            if (defined('UWP_ROOT_PAGES')) {
                $blog_id = UWP_ROOT_PAGES;
            } else {
                $blog_id = (int) get_network()->site_id;
            }
            $current_blog_id = get_current_blog_id();
            if (!is_int($blog_id)) {
                $page_data = array();
            } else {
                if ($blog_id == $current_blog_id) {
                    $page_data = uwp_get_page_url_page_data($page_data, $page_type);
                } else {
                    // Switch to the new blog.
                    switch_to_blog( $blog_id );
                    $page_data = uwp_get_page_url_page_data($page_data, $page_type);
                    // Restore original blog.
                    restore_current_blog();
                }
            }
            break;
        case "multi_na_default":
            $is_main_site = is_main_site();
            if ($is_main_site) {
                $page_data = uwp_get_page_url_page_data($page_data, $page_type);
            } else {
                $main_blog_id = (int) get_network()->site_id;
                // Switch to the new blog.
                switch_to_blog( $main_blog_id );
                $page_data = uwp_get_page_url_page_data($page_data, $page_type);
                // Restore original blog.
                restore_current_blog();
            }
            break;
        case "multi_not_na":
            $page_data = uwp_get_page_url_page_data($page_data, $page_type);
            break;
        default:
            $page_data = array();

    }

    if ($output_type == 'link') {
        if (empty($page_data)) {
            return false;
        } else {
            return $page_data['link'];
        }
    } else {
        return $page_data;
    }
}

/**
 * Returns the page info like page title, slug and link.
 *
 * @since       1.0.0
 * @package     userswp
 *
 * @param       string      $page_data      Page data array.
 * @param       string      $page_type      Page type.
 *
 * @return      array                       Page data array.
 */
function uwp_get_page_url_page_data($page_data, $page_type) {
    $page_id = uwp_get_option($page_type, false, false);
    if ($page_id) {
        $page = get_post($page_id);
        $page_data = array(
            'name' => $page->post_title,
            'slug' => $page->post_name,
            'link' => get_permalink( $page->ID ),
        );
    }
    return $page_data;
}


add_action('init', 'uwp_process_activation_link');

/**
 * Handles the activation request coming via email activation link.
 *
 * @since       1.0.0
 * @package     userswp
 *
 * @return      void
 */
function uwp_process_activation_link() {
    if (isset($_GET['uwp_activate']) && $_GET['uwp_activate'] == 'yes') {
        $key =  strip_tags(esc_sql($_GET['key']));
        $login =  strip_tags(esc_sql($_GET['login']));
        $login_page = uwp_get_option('login_page', false);
        $result = uwp_check_activation_key($key, $login);

        if (is_wp_error($result)) {
            if ($login_page) {
                $redirect_to = add_query_arg(array('uwp_err' => 'act_wrong'), get_permalink($login_page));
                wp_redirect($redirect_to);
                exit();
            }
        } else {
            if (!$result) {
                if ($login_page) {
                    $redirect_to = add_query_arg(array('uwp_err' => 'act_error'), get_permalink($login_page));
                    wp_redirect($redirect_to);
                    exit();
                }
            } else {
                if ($login_page) {
                    $user_data = get_user_by('login', $login);
                    update_user_meta( $user_data->ID, 'uwp_mod', '0' );
                    $redirect_to = add_query_arg(array('uwp_err' => 'act_success'), get_permalink($login_page));
                    wp_redirect($redirect_to);
                    exit();
                }
            }
        }
    }
}