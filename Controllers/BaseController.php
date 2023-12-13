<?php

class BaseController
{
    public function checkAdmin() {
        if(session_start() === true) {
            if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 1) {
                $this->redirect('login.php','../../scr/pages/');
            }
        } else {
            session_start();

            if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 1) {
                $this->redirect('login.php','../scr/pages/');
            }
        }
    }

    public function convertToCapitolFirstChar($str) {
        $strTemp = strtolower($str);
        $strFinal = ucfirst($strTemp);

        return $strFinal;
    }

    public function redirect($page,$path,$params = null) {
        if ($path !== null) {
            $page = $path . $page;
        }

        if ($params !== null) {
            $parameter = '?' . http_build_query($params);
            $page .= $parameter;
        }

        header("Location: $page");
        exit();
    }
}