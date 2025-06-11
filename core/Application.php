<?php

require_once __DIR__ . '/Router.php';
require_once __DIR__ . '/Request.php';
require_once __DIR__ . '/Response.php';
require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Session.php';

class Application {
    public static Application $app;
    public static string $ROOT_DIR;

    public Request $request;
    public Response $response;
    public Router $router;
    public Database $db;
    public Session $session;
    public ?Controller $controller = null;
    public ?UserModel $user = null;

    public function __construct($rootPath, array $config) {
        self::$app = $this;
        self::$ROOT_DIR = $rootPath;

        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();

        $this->db = new Database($config['db']);

        $userId = $this->session->get('user');
        if ($userId) {
            // فرض: UserModel یک کلاس پایه برای User هست که بعداً تعریف می‌کنیم
            $this->user = UserModel::findOne(['id' => $userId]);
        }
    }

    public function run() {
        echo $this->router->resolve();
    }

    public function setController(Controller $controller) {
        $this->controller = $controller;
    }

    public function getController(): ?Controller {
        return $this->controller;
    }

    public function login(UserModel $user) {
        $this->user = $user;
        $this->session->set('user', $user->id);
        return true;
    }

    public function logout() {
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest(): bool {
        return !self::$app->user;
    }
}

?>