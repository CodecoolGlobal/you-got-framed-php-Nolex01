<?php

namespace app\Utils;

class SuperglobalsManager {
    public function getRequestData($key = null) {
        if ($key !== null) {
            return $_REQUEST[$key] ?? null;
        }
        return $_REQUEST;
    }

    public function getSessionData($key = null) {
        if (!isset($_SESSION)) {
            session_start();
        }
        if ($key !== null) {
            return $_SESSION[$key] ?? null;
        }
        return $_SESSION;
    }
}
