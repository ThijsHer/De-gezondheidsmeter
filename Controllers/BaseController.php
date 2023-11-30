<?php

class BaseController
{
    public function checkAdmin() {
        //nog niks
    }

    public function convertToCapitolFirstChar($str) {
        $strTemp = strtolower($str);
        $strFinal = ucfirst($strTemp);

        return $strFinal;
    }

    public function redirect($page,$params = null) {
        if ($params !== null) {
            $parameter = '?' . http_build_query($params);
            $page .= $parameter;
        }

        // Your redirection logic here, for example:
        header("Location: $page");
        exit();
    }
}