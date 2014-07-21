<?php
/**
 * Error class.
 * Implements methods to work with error handling.
 *
 * @author      Drew <drew@hipley.net>
 * @copyright   Hipley, 2014
 * @since       1.0
 * @version     1.0
 * @package     core
 */

namespace Soda\Component\Error;

class Error {

    /**
    * Creates an error.
    *
    * @since 1.0
    * @access public
    *
    * @param string $message Error message.
    * @param bool $is_notice Creates an admin notice.
    */

    public function create($message, $is_notice = true) {

        $error = new \WP_Error("Error", $message);

        switch($is_notice) {

            case false:

                wp_die(esc_html($error->get_error_message()), "Error");
                break;

            default:

                $notification = new Notification();
                $notification->create(esc_html($error->get_error_message()), "error");

        }

    }

}