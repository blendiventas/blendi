<?php
if (!function_exists('view')) {
    function view($view, $data = []): void
    {
        try {

            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/'.$view)) {
                throw new Exception('View ' . $view . ' not found');
            }

            if (!empty($data)) {
                extract($data);
            }

            include $_SERVER['DOCUMENT_ROOT'] . '/' . $view;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}