<?php

namespace Soda\Component\Notification;

class Notification {

    /**
    * Create notifications.
    *
    * @since 1.0
    * @access public
    *
    * @param string $message Notification message.
    * @param string $type Notification type, accepts error and updated.
    */

    public function create($message, $type = "updated") {

        $message = esc_html($message);

    	add_action("admin_notices", function() use ($message, $type) {
    		echo "<div class=\"${type}\"><p>${message}</p></div>";
    	});

    	add_action("network_admin_notices", function() use ($message, $type) {
    		echo "<div class=\"${type}\"><p>${message}</p></div>";
    	});

    }

}
