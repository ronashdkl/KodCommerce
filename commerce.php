<?php


class CommercePlugin{
    function __construct()
    {
        require __DIR__."/vendor/autoload.php";
        Yii::setAlias('@kodcommerce',__DIR__."/src/");
    }

    public function install(){
       $this->migrate('up');
    }

    function register(){
        \kodCommerce\Init::registerServices();
    }

    function disable(){

    }

    function update($id){
         $this->migrate($id);
    }

    function uninstall(){
      $this->migrate('down');
    }

    private function migrate(string $id){
        ob_start();
        defined('STDIN') or define('STDIN', fopen('php://stdin', 'r'));
        defined('STDOUT') or define('STDOUT', fopen('php://stdout', 'w'));
        defined('STDERR') or define('STDERR', fopen('php://stderr', 'w'));
        $migration = new \yii\console\controllers\MigrateController('migrate', Yii::$app);
        $status = $migration->runAction($id, ['migrationNamespaces' => 'kodcommerce\migrations', 'interactive' => false]);
        fclose(\STDOUT);
        fclose(\STDERR);

        Yii::$app->session->setFlash('success',ob_get_clean());
    }
}