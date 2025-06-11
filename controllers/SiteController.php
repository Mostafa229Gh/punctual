<?php

namespace controllers;

require_once __DIR__ . '/../core/Controller.php';

class SiteController extends \Controller
{
    public function login($request)
    {
        if ($request->isPost()) {
            $body = $request->getBody();

            // فقط نمایش ورودی‌ها برای تست
            echo "<pre>";
            print_r($body);
            echo "</pre>";
            return;
        }

        return $this->render('site/login');
    }
}

?>