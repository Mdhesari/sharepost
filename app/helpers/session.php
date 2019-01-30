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

// Store user's data in order to keep them logged in
function createUserSession($user)
{
    // Set values
    $_SESSION['user_id'] = $user->id;
    $_SESSION['user_email'] = $user->email;
    $_SESSION['user_gender'] = $user->gender;
    $_SESSION['user_fullname'] = $user->full_name;
    $_SESSION['user_accessiblity'] = $user->accessiblity;

    // Redircet to home page
    redirect();
}

// Destroy all sessions
function logoutUser()
{
    session_destroy();

    redirect('users/login');
}

// Point accessiblities
function isAdminMaster()
{
    if ($_SESSION['user_accessiblity'] == 'admin' || $_SESSION['user_accessiblity'] == 'master') {
        return true;

    }

    return false;
}

function isMaster()
{
    if ($_SESSION['user_accessiblity'] == 'master') {
        return true;

    }

    return false;

}

function checkBothAccess($user_id)
{
    if ($user_id == $_SESSION['user_id']) {
        return true;

    } else if (isAdminMaster()) {
        return true;

    }

    return false;
}

// Check if session is still set
function isLoggedIn()
{
    if (isset($_SESSION['user_id'])) {
        return true;
    }

    return false;

}
