<?php

namespace Gzoran\Exception\Commands;

use Gzoran\Exception\Templates\AppExceptionHandlerTemplate;
use Gzoran\Exception\Templates\AppExceptionTemplate;
use Gzoran\Exception\Templates\ExceptionHandlerTemplate;
use Illuminate\Console\Command;

class ExceptionInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exception:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the AppException and Handlers';

    /**
     * @var AppExceptionTemplate
     */
    private $appExceptionTemplate;

    /**
     * @var AppExceptionHandlerTemplate
     */
    private $appExceptionHandlerTemplate;

    /**
     * @var ExceptionHandlerTemplate
     */
    private $exceptionHandlerTemplate;

    /**
     * Create a new command instance.
     *
     * @param AppExceptionTemplate $appExceptionTemplate
     * @param AppExceptionHandlerTemplate $appExceptionHandlerTemplate
     * @param ExceptionHandlerTemplate $exceptionHandlerTemplate
     */
    public function __construct(
        AppExceptionTemplate $appExceptionTemplate,
        AppExceptionHandlerTemplate $appExceptionHandlerTemplate,
        ExceptionHandlerTemplate $exceptionHandlerTemplate
    )
    {
        parent::__construct();

        $this->appExceptionTemplate        = $appExceptionTemplate;
        $this->appExceptionHandlerTemplate = $appExceptionHandlerTemplate;
        $this->exceptionHandlerTemplate    = $exceptionHandlerTemplate;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->makeHandlersFolder();

        $this->generateAppException();
        $this->generateAppExceptionHandler();
        $this->generateExceptionHandler();

        $this->info('Generate the AppException and Handlers successfully.');
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function makeHandlersFolder()
    {
        $handler_folder = app_path() . '/Exceptions/Handlers';
        if (! is_dir($handler_folder)) {
            mkdir($handler_folder);
        }
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateAppException()
    {
        $file_path = app_path() . '/Exceptions/AppException.php';
        file_put_contents($file_path, $this->appExceptionTemplate->get());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateAppExceptionHandler()
    {
        $handler_path = app_path() . '/Exceptions/Handlers/AppExceptionHandler.php';
        file_put_contents($handler_path, $this->appExceptionHandlerTemplate->get());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateExceptionHandler()
    {
        $handler_path = app_path() . '/Exceptions/Handlers/ExceptionHandler.php';
        file_put_contents($handler_path, $this->exceptionHandlerTemplate->get());
    }
}
