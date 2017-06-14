<?php
/**
 * Created by PhpStorm.
 * User: Hariss
 * Date: 09.03.2017
 * Time: 1:04
 */

class Session {
    public static function init() {
        @session_start();
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        if(isset($_SESSION[$key]))
            return $_SESSION[$key];
    }

    public static function destroy($key = NULL) {
        if($key) unset($_SESSION[$key]);
        else unset($_SESSION);
        //session_destroy();
    }
}