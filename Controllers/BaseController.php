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