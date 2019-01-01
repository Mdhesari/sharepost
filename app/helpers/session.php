<?php
session_start();
// Flash alert messages
// DISPLAY IN VIEW
function flash($name = '', $message = '', $class = 'alert alert-success')
{
    if (!empty($name)) {
        // Set sessions
        if (!empty($message) && empty($_SESSION[$name])) {

            // Check if there is class set and if there is, unset it
            if (!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;

        } elseif (empty($message) && !empty($_SESSION[$name])) {

            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
            echo "<div class='$class' id='msg-flash'>" . $_SESSION[$name] .
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>' .
                "</div>";

            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}
