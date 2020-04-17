<?php

class Redireccion {
    public static function redirigir($url) {
        header('Location: ' . $url);
        exit();
    }
}