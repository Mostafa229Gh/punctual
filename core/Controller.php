<?php

class Controller {
    public string $layout = 'main';

    public function render($view, $params = []) {
        return Application::$app->router->renderView($view, $params);
    }
}
?>
