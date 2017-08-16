<?php
/**
 * UsersWP Page related functions
 *
 * All UsersWP page related functions can be found here.
 *
 * @since      1.0.0
 * @author     GeoDirectory Team <info@wpgeodirectory.com>
 */
class UsersWP_Pages {

    
    public function __construct() {

        add_action( 'wpmu_new_blog', array($this, 'wpmu_generate_default_pages_on_new_site'), 10, 6 );
        
    }

    /**
     * Checks whether the current page is of given page type or not.
     *
     * @since   1.0.0
     * @package userswp
     * @param   string|bool $type Page type.
     * @return bool
     */
    public function is_page($type = false) {
        if (is_page()) {
            global $post;
            $current_page_id = $post->ID;
            if ($type) {
                $uwp_page = uwp_get_option($type, false);
                if ( $uwp_page && ((int) $uwp_page ==  $current_page_id ) ) {
                    return true;
                } else {
                    return false;
                }
            } else {
                if ($this->is_register_page() ||
                    $this->is_login_page() ||
                    $this->is_forgot_page() ||
                    $this->is_change_page() ||
                    $this->is_reset_page() ||
                    $this->is_account_page() ||
                    $this->is_profile_page() ||
                    $this->is_users_page() ||
                    $this->is_multi_register_page()) {
                    return true;
                } else {
                    return false;
                }
            }

        } else {
            return false;
        }
    }

    /**
     * Checks whether the current page is register page or not.
     *
     * @since       1.0.0
     * @package     userswp
     * @return      bool
     */
    public function is_register_page() {
        return $this->is_page('register_page');
    }

    /**
     * Checks whether the current page is login page or not.
     *
     * @since       1.0.0
     * @package     userswp
     * @return      bool
     */
    public function is_login_page() {
        return $this->is_page('login_page');
    }

    /**
     * Checks whether the current page is forgot password page or not.
     *
     * @since       1.0.0
     * @package     userswp
     * @return      bool
     */
    public function is_forgot_page() {
        return $this->is_page('forgot_page');
    }

    /**
     * Checks whether the current page is change password page or not.
     *
     * @since       1.0.0
     * @package     userswp
     * @return      bool
     */
    public function is_change_page() {
        return $this->is_page('change_page');
    }

    /**
     * Checks whether the current page is reset password page or not.
     *
     * @since       1.0.0
     * @package     userswp
     * @return      bool
     */
    public function is_reset_page() {
        return $this->is_page('reset_page');
    }

    /**
     * Checks whether the current page is account page or not.
     *
     * @since       1.0.0
     * @package     userswp
     * @return      bool
     */
    public function is_account_page() {
        return $this->is_page('account_page');
    }

    /**
     * Checks whether the current page is profile page or not.
     *
     * @since       1.0.0
     * @package     userswp
     * @return      bool
     */
    public function is_profile_page() {
        return $this->is_page('profile_page');
    }

    /**
     * Checks whether the current page is users page or not.
     *
     * @since       1.0.0
     * @package     userswp
     * @return      bool
     */
    public function is_users_page() {
        return $this->is_page('users_page');
    }

    /**
     * Checks whether the current page is multi register page or not.
     *
     * @since       1.0.0
     * @package     userswp
     * @return      bool
     */
    public function is_multi_register_page() {
        global $post;
        $content = $post->post_content;
        if (strpos($content, '[uwp_register role_id') !== false) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks whether the current page is logged in user profile page or not.
     *
     * @since       1.0.0
     * @package     userswp
     * @return      bool
     */
    public function is_current_user_profile_page() {
        if (is_user_logged_in() &&
            $this->is_profile_page()
        ) {
            $author_slug = get_query_var('uwp_profile');
            if ($author_slug) {
                $url_type = apply_filters('uwp_profile_url_type', 'slug');
                if ($url_type == 'id') {
                    $user = get_user_by('id', $author_slug);
                } else {
                    $user = get_user_by('slug', $author_slug);
                }

                if ($user && $user->ID == get_current_user_id()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Gets the UsersWP page permalink based on page type.
     *
     * @since       1.0.0
     * @package     userswp
     * @param       string|bool     $type       Page type.
     * @return      string                      Page permalink.
     */
    public function get_page_permalink($type) {
        $link = false;
        $page_id = uwp_get_option($type, false);
        if ($page_id) {
            $link = get_permalink($page_id);
        }
        return $link;
    }

    /**
     * Gets the UsersWP register page permalink.
     *
     * @since       1.0.0
     * @package     userswp
     * @return      string      Page permalink.
     */
    public function get_register_permalink() {
        return $this->get_page_permalink('register_page');
    }

    /**
     * Gets the UsersWP login page permalink.
     *
     * @since       1.0.0
     * @package     userswp
     * @return      string      Page permalink.
     */
    public function get_login_permalink() {
        return $this->get_page_permalink('login_page');
    }

    /**
     * Gets the UsersWP forgot password page permalink.
     *
     * @since       1.0.0
     * @package     userswp
     * @return      string      Page permalink.
     */
    public function get_forgot_permalink() {
        return $this->get_page_permalink('forgot_page');
    }

    /**
     * Gets the UsersWP reset password page permalink.
     *
     * @since       1.0.0
     * @package     userswp
     * @return      string      Page permalink.
     */
    public function get_reset_permalink() {
        return $this->get_page_permalink('reset_page');
    }

    /**
     * Gets the UsersWP account page permalink.
     *
     * @since       1.0.0
     * @package     userswp
     * @return      string      Page permalink.
     */
    public function get_account_permalink() {
        return $this->get_page_permalink('account_page');
    }

    /**
     * Gets the UsersWP profile page permalink.
     *
     * @since       1.0.0
     * @package     userswp
     * @return      string      Page permalink.
     */
    public function get_profile_permalink() {
        return $this->get_page_permalink('profile_page');
    }

    /**
     * Gets the UsersWP users page permalink.
     *
     * @since       1.0.0
     * @package     userswp
     * @return      string      Page permalink.
     */
    public function get_users_permalink() {
        return $this->get_page_permalink('users_page');
    }

    /**
     * Returns all available pages as array to use in select dropdown.
     *
     * @since       1.0.0
     * @package     userswp
     * @return      array                      Page array.
     */
    public function get_pages() {
        $pages_options = array( '' => __( 'Select a Page', 'userswp' ) ); // Blank option

        $pages = get_pages();
        if ( $pages ) {
            foreach ( $pages as $page ) {
                $pages_options[ $page->ID ] = $page->post_title;
            }
        }
        return $pages_options;
    }

    /**
     * Gets the page slug using the given page type.
     *
     * @since       1.0.0
     * @package     userswp
     * @param       string      $page_type      Page type.
     * @return      string                      Page slug.
     */
    public function get_page_slug($page_type = 'register_page') {
        $page_id = uwp_get_option($page_type, 0);
        if ($page_id) {
            $slug = get_post_field( 'post_name', get_post($page_id) );
        } else {
            $slug = false;
        }
        return $slug;

    }

    /**
     * Creates UsersWP page if not exists.
     *
     * @since       1.0.0
     * @package     userswp
     * @param       string      $slug           Page slug.
     * @param       string      $option         Page setting key.
     * @param       string      $page_title     The post title.  Default empty.
     * @param       mixed       $page_content   The post content. Default empty.
     * @param       int         $post_parent    Set this for the post it belongs to, if any. Default 0.
     * @param       string      $status         The post status. Default 'draft'.
     */
    public function create_page($slug, $option, $page_title = '', $page_content = '', $post_parent = 0, $status = 'publish') {
        global $wpdb, $current_user;

        $settings = get_option( 'uwp_settings', array());
        if (isset($settings[$option])) {
            $option_value = $settings[$option];
        } else {
            $option_value = false;
        }

        if ($option_value > 0) :
            if (get_post($option_value)) :
                // Page exists
                return;
            endif;
        endif;

        $page_found = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT ID FROM " . $wpdb->posts . " WHERE post_name = %s LIMIT 1;",
                array($slug)
            )
        );

        if ($page_found) :
            // Page exists
            if (!$option_value) {
                $settings[$option] = $page_found;
                update_option( 'uwp_settings', $settings );
            }
            return;
        endif;

        $page_data = array(
            'post_status' => $status,
            'post_type' => 'page',
            'post_author' => $current_user->ID,
            'post_name' => $slug,
            'post_title' => $page_title,
            'post_content' => $page_content,
            'post_parent' => $post_parent,
            'comment_status' => 'closed'
        );
        $page_id = wp_insert_post($page_data);

        $settings[$option] = $page_id;
        update_option( 'uwp_settings', $settings );
    }

    /**
     * Generates default UsersWP pages. Usually called during plugin activation.
     *
     * @since       1.0.0
     * @package     userswp
     * @return      void
     */
    public function generate_default_pages() {
        
        $this->create_page(esc_sql(_x('register',   'page_slug', 'userswp')), 'register_page',  __('Register',          'userswp'), '[uwp_register]');
        $this->create_page(esc_sql(_x('login',      'page_slug', 'userswp')), 'login_page',     __('Login',             'userswp'), '[uwp_login]');
        $this->create_page(esc_sql(_x('account',    'page_slug', 'userswp')), 'account_page',   __('Account',           'userswp'), '[uwp_account]');
        $this->create_page(esc_sql(_x('forgot',     'page_slug', 'userswp')), 'forgot_page',    __('Forgot Password?',  'userswp'), '[uwp_forgot]');
        $this->create_page(esc_sql(_x('reset',      'page_slug', 'userswp')), 'reset_page',     __('Reset Password',    'userswp'), '[uwp_reset]');
        $this->create_page(esc_sql(_x('change',     'page_slug', 'userswp')), 'change_page',    __('Change Password',   'userswp'), '[uwp_change]');
        $this->create_page(esc_sql(_x('profile',    'page_slug', 'userswp')), 'profile_page',   __('Profile',           'userswp'), '[uwp_profile]');
        $this->create_page(esc_sql(_x('users',      'page_slug', 'userswp')), 'users_page',     __('Users',             'userswp'), '[uwp_users]');
    
    }

    
    /**
     * Generates default UsersWP pages on new wpmu blog creation.
     *
     * @since       1.0.0
     * @package     userswp
     *
     * @param       int         $blog_id        Blog ID.
     * @param       int         $user_id        User ID.
     * @param       string      $domain         Site domain.
     * @param       string      $path           Site path.
     * @param       int         $site_id        Site ID. Only relevant on multi-network installs.
     * @param       array       $meta           Meta data. Used to set initial site options.
     */
    public function wpmu_generate_default_pages_on_new_site( $blog_id, $user_id, $domain, $path, $site_id, $meta ) {

        if (uwp_get_installation_type() != 'multi_na_all') {
            return;
        }

        if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
            require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
        }

        // Bail if plugin is not network activated.
        if ( ! is_plugin_active_for_network( 'userswp/userswp.php' ) ) {
            return;
        }

        // Switch to the new blog.
        switch_to_blog( $blog_id );

        uwp_generate_default_pages();

        // Restore original blog.
        restore_current_blog();
    }

    /**
     * Gets the UsersWP page permalink based on page type.
     *
     * @since       1.0.0
     * @package     userswp
     * @param       string     $page       Page type.
     * @return      string                 Page permalink.
     */
    public function get_page_link($page) {

        $link = "";
        $page_id = false;

        switch ($page) {
            case 'register':
                $page_id = uwp_get_option('register_page', false);
                break;

            case 'login':
                $page_id = uwp_get_option('login_page', false);
                break;

            case 'forgot':
                $page_id = uwp_get_option('forgot_page', false);
                break;

            case 'account':
                $page_id = uwp_get_option('account_page', false);
                break;

            case 'profile':
                $page_id = uwp_get_option('profile_page', false);
                break;

            case 'users':
                $page_id = uwp_get_option('users_page', false);
                break;
        }

        if ($page_id) {
            $link = get_permalink($page_id);
        }

        return $link;
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
    public function build_profile_tab_url($user_id, $tab = false, $subtab = false) {

        $link = apply_filters('uwp_profile_link', get_author_posts_url($user_id), $user_id);

        if ($link != '') {
            if (isset($_REQUEST['page_id'])) {
                $permalink_structure = 'DEFAULT';
            } else {
                $permalink_structure = 'CUSTOM';
                $link = rtrim($link, '/') . '/';
            }

            if ('DEFAULT' == $permalink_structure) {
                $link = add_query_arg(
                    array(
                        'uwp_tab' => $tab,
                        'uwp_subtab' => $subtab
                    ),
                    $link
                );
            } else {
                if ($tab) {
                    $link = $link . $tab;
                }

                if ($subtab) {
                    $link = $link .'/'.$subtab;
                }
            }
        }

        return $link;
    }

}