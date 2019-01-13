<?php

namespace Gzoran\Exception\Commands;

use Gzoran\Exception\Templates\HandlerTemplate;
use Illuminate\Console\Command;

class MakeExceptionHandler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:exception_handler {handler_class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new exception handler';

    /**
     * @var string
     */
    private $handlerClass;

    /**
     * @var array
     */
    private $classExplode;

    /**
     * @var string
     */
    private $className;

    /**
     * @var string
     */
    private $folderPath;

    /**
     * @var string
     */
    private $namespace;

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->handlerClass = $this->getHandlerClass();
        $this->classExplode = explode('\\', $this->handlerClass);
        $this->className    = end($this->classExplode);

        if (count($this->classExplode) == 1) {
            $this->folderPath = 'app' . DIRECTORY_SEPARATOR . 'Exceptions' . DIRECTORY_SEPARATOR . 'Handlers';
            $this->namespace  = 'App\\Exceptions\\Handlers';
        } else {
            $this->folderPath = $this->getFolderPath();
            $this->namespace  = $this->getNamespace();
        }

        if (! is_dir($this->folderPath)) {
            mkdir($this->folderPath, 0777, true);
        }

        $template = new HandlerTemplate($this->namespace, $this->className);

        $handler_path = $this->folderPath . DIRECTORY_SEPARATOR . $this->className . '.php';
        file_put_contents($handler_path, $template->get());

        $this->info('Exception handler created successfully.');
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @return mixed
     */
    private function getHandlerClass()
    {
        return str_replace('/', '\\', $this->argument('handler_class'));
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @return string
     */
    private function getFolderPath()
    {
        $folder_path = '';
        $count       = count($this->classExplode);

        foreach ($this->classExplode as $key => $value) {
            if (($key + 1) == $count) {
                break;
            }
            $folder_path .= DIRECTORY_SEPARATOR . $value;
        }

        return app_path() . $folder_path;
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @return string
     */
    private function getNamespace()
    {
        $namespace = '';
        $count     = count($this->classExplode);

        foreach ($this->classExplode as $key => $value) {
            if (($key + 1) == $count) {
                break;
            }

            $namespace .= '\\' . $value;
        }

        return 'App\\' . ltrim($namespace, '\\');
    }
}
