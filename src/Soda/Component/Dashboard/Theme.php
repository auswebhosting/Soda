<?php

namespace Soda\Component\Dashboard;

/**
* Admin color schemes.
*
* @since 1.0
*/

class Theme {

    private $name;
    private $filename;
    private $colors;

    /**
    * Setup colors.
    *
    * @since 1.0
    * @uses add_action()
    * @access public
    *
    */

    public function __construct($name, $filename)
    {
        $this->name = $name;
        $this->filename = $filename;
        $this->colors = array($this->name);

		add_action( 'admin_enqueue_scripts', array( $this, 'setCss' ) );
		add_action( 'admin_init' , array( $this, 'setColor' ) );
	}

    /**
    * Setup colors.
    *
    * @since 1.0
    * @uses wp_admin_css_color()
    * @access private
    *
    */

	public function setColor() {
        
		$suffix = is_rtl() ? '-rtl' : '';

		wp_admin_css_color( 
			$this->name, __( ucfirst($this->name), 'admin_schemes' ), 
			plugins_url($this->filename . __FILE__)
		);

	}

    /**
    * Load color scheme CSS.
    *
    * @since 1.0
    * @access private
    *
    */

	public function setCss() {

		global $wp_styles, $_wp_admin_css_colors;

		$color_scheme = get_user_option( 'admin_color' );

		$scheme_screens = apply_filters( 'acs_picker_allowed_pages', array( 'profile', 'profile-network' ) );
		if ( in_array( $color_scheme, $this->colors ) || in_array( get_current_screen()->base, $scheme_screens ) ){
			$wp_styles->registered[ 'colors' ]->deps[] = 'colors-fresh';
		}

	}

    /**
    * Update default color scheme.
    *
    * @since 1.0
    * @access public
    *
    * @param string $str Color scheme to mark as default.
    */

    public function setTheme($str) {

        add_filter("get_user_option_admin_color", function($result) use($str) {
            return $str;
        }); 

    }

}