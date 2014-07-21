<?php

namespace Soda\Component\Menu;

class Menu
{
    
  /**
    * Creates a menu.
    *
    * @since 1.0
    * @access public
    *
    * @param array $args Menu arguments.
    * @param bool $is_network Create a network menu.
    * @param bool $is_submenu Create a submenu.
    */

    public function create($args, $is_network = false, $is_submenu = false) {

        ($is_network == false ? $method = "admin_menu" : $method = "network_admin_menu");
        ($is_submenu == false ? $action = "add_menu_page" : $action = "add_submenu_page");

    	add_action($method, function() use($args, $action) {

            call_user_func_array($action, $args);

    	});

    }

   /**
    * Rename a menu.
    *
    * @since 1.0
    * @access public
    *
    * @param string $key Key to target for replacement.
    * @param string $str Replacement text.
    * @param string $sub Submenu key to target for replacement.
    * @param bool $is_network Rename network menus.
    */

    public function rename($key, $str, $sub = "", $is_network = false) {

        ($is_network == false ? $method = "admin_menu" : $method = "network_admin_menu");

        add_action($method, function() use($key, $str, $sub) {

            if ($sub == "") {
                global $menu;
                $menu[$key][0] = $str;
            }
            else {
                global $submenu;
                $submenu[$sub][$key][0] = $str;
            }

        });

    }

   /**
    * Create a menu seperator.
    *
    * @since 1.0
    * @access public
    *
    * @param int $position Position for menu seperator.
    */

    public function createSeperator($position) {

        add_action("admin_menu", function() use ($position) {

            global $menu;
            
            $index = 0;

            foreach($menu as $offset => $section) {
                if (substr($section[2],0,9)=='separator')
                    $index++;
                    if ($offset>=$position) {
                        $menu[$position] = array('','read',"separator{$index}",'','wp-menu-separator');
                        break;
                    }
            }

            ksort( $menu );

        });

    }
}