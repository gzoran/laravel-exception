<?php

namespace Gzoran\Exception\Commands;

use Gzoran\Exception\Templates\AppExceptionHandlerTemplate;
use Gzoran\Exception\Templates\AppExceptionTemplate;
use Gzoran\Exception\Templates\AuthenticationExceptionHandlerTemplate;
use Gzoran\Exception\Templates\ExceptionHandlerTemplate;
use Gzoran\Exception\Templates\HttpExceptionHandlerTemplate;
use Gzoran\Exception\Templates\MethodNotAllowedExceptionHandlerTemplate;
use Gzoran\Exception\Templates\MethodNotAllowedHttpExceptionHandlerTemplate;
use Gzoran\Exception\Templates\ModelNotFoundExceptionHandlerTemplate;
use Gzoran\Exception\Templates\NotFoundHttpExceptionHandlerTemplate;
use Gzoran\Exception\Templates\QueryExceptionHandlerTemplate;
use Gzoran\Exception\Templates\RelationNotFoundExceptionHandlerTemplate;
use Gzoran\Exception\Templates\UnauthorizedExceptionHandlerTemplate;
use Gzoran\Exception\Templates\ValidationExceptionHandlerTemplate;
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
     * @var AuthenticationExceptionHandlerTemplate
     */
    private $authenticationExceptionHandlerTemplate;

    /**
     * @var HttpExceptionHandlerTemplate
     */
    private $httpExceptionHandlerTemplate;

    /**
     * @var MethodNotAllowedExceptionHandlerTemplate
     */
    private $methodNotAllowedExceptionHandlerTemplate;

    /**
     * @var MethodNotAllowedHttpExceptionHandlerTemplate
     */
    private $methodNotAllowedHttpExceptionHandlerTemplate;

    /**
     * @var ModelNotFoundExceptionHandlerTemplate
     */
    private $modelNotFoundExceptionHandlerTemplate;

    /**
     * @var NotFoundHttpExceptionHandlerTemplate
     */
    private $notFoundHttpExceptionHandlerTemplate;

    /**
     * @var QueryExceptionHandlerTemplate
     */
    private $queryExceptionHandlerTemplate;

    /**
     * @var RelationNotFoundExceptionHandlerTemplate
     */
    private $relationNotFoundExceptionHandlerTemplate;

    /**
     * @var UnauthorizedExceptionHandlerTemplate
     */
    private $unauthorizedExceptionHandlerTemplate;

    /**
     * @var ValidationExceptionHandlerTemplate
     */
    private $validationExceptionHandlerTemplate;

    /**
     * Create a new command instance.
     *
     * @param AppExceptionTemplate $appExceptionTemplate
     * @param AppExceptionHandlerTemplate $appExceptionHandlerTemplate
     * @param ExceptionHandlerTemplate $exceptionHandlerTemplate
     * @param AuthenticationExceptionHandlerTemplate $authenticationExceptionHandlerTemplate
     * @param HttpExceptionHandlerTemplate $httpExceptionHandlerTemplate
     * @param MethodNotAllowedExceptionHandlerTemplate $methodNotAllowedExceptionHandlerTemplate
     * @param MethodNotAllowedHttpExceptionHandlerTemplate $methodNotAllowedHttpExceptionHandlerTemplate
     * @param ModelNotFoundExceptionHandlerTemplate $modelNotFoundExceptionHandlerTemplate
     * @param NotFoundHttpExceptionHandlerTemplate $notFoundHttpExceptionHandlerTemplate
     * @param QueryExceptionHandlerTemplate $queryExceptionHandlerTemplate
     * @param RelationNotFoundExceptionHandlerTemplate $relationNotFoundExceptionHandlerTemplate
     * @param UnauthorizedExceptionHandlerTemplate $unauthorizedExceptionHandlerTemplate
     * @param ValidationExceptionHandlerTemplate $validationExceptionHandlerTemplate
     */
    public function __construct(
        AppExceptionTemplate $appExceptionTemplate,
        AppExceptionHandlerTemplate $appExceptionHandlerTemplate,
        ExceptionHandlerTemplate $exceptionHandlerTemplate,
        AuthenticationExceptionHandlerTemplate $authenticationExceptionHandlerTemplate,
        HttpExceptionHandlerTemplate $httpExceptionHandlerTemplate,
        MethodNotAllowedExceptionHandlerTemplate $methodNotAllowedExceptionHandlerTemplate,
        MethodNotAllowedHttpExceptionHandlerTemplate $methodNotAllowedHttpExceptionHandlerTemplate,
        ModelNotFoundExceptionHandlerTemplate $modelNotFoundExceptionHandlerTemplate,
        NotFoundHttpExceptionHandlerTemplate $notFoundHttpExceptionHandlerTemplate,
        QueryExceptionHandlerTemplate $queryExceptionHandlerTemplate,
        RelationNotFoundExceptionHandlerTemplate $relationNotFoundExceptionHandlerTemplate,
        UnauthorizedExceptionHandlerTemplate $unauthorizedExceptionHandlerTemplate,
        ValidationExceptionHandlerTemplate $validationExceptionHandlerTemplate
    )
    {
        parent::__construct();

        $this->appExceptionTemplate                         = $appExceptionTemplate;
        $this->appExceptionHandlerTemplate                  = $appExceptionHandlerTemplate;
        $this->exceptionHandlerTemplate                     = $exceptionHandlerTemplate;
        $this->authenticationExceptionHandlerTemplate       = $authenticationExceptionHandlerTemplate;
        $this->httpExceptionHandlerTemplate                 = $httpExceptionHandlerTemplate;
        $this->methodNotAllowedExceptionHandlerTemplate     = $methodNotAllowedExceptionHandlerTemplate;
        $this->methodNotAllowedHttpExceptionHandlerTemplate = $methodNotAllowedHttpExceptionHandlerTemplate;
        $this->modelNotFoundExceptionHandlerTemplate        = $modelNotFoundExceptionHandlerTemplate;
        $this->notFoundHttpExceptionHandlerTemplate         = $notFoundHttpExceptionHandlerTemplate;
        $this->queryExceptionHandlerTemplate                = $queryExceptionHandlerTemplate;
        $this->relationNotFoundExceptionHandlerTemplate     = $relationNotFoundExceptionHandlerTemplate;
        $this->unauthorizedExceptionHandlerTemplate         = $unauthorizedExceptionHandlerTemplate;
        $this->validationExceptionHandlerTemplate           = $validationExceptionHandlerTemplate;
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
        $this->generateAuthenticationExceptionHandler();
        $this->generateHttpExceptionHandler();
        $this->generateMethodNotAllowedExceptionHandlerTemplate();
        $this->generateMethodNotAllowedHttpExceptionHandlerTemplate();
        $this->generateModelNotFoundExceptionHandlerTemplate();
        $this->generateNotFoundHttpExceptionHandlerTemplate();
        $this->generateQueryExceptionHandlerTemplate();
        $this->generateRelationNotFoundExceptionHandlerTemplate();
        $this->generateUnauthorizedExceptionHandlerTemplate();
        $this->generateValidationExceptionHandlerTemplate();

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

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateAuthenticationExceptionHandler()
    {
        $handler_path = app_path() . '/Exceptions/Handlers/AuthenticationExceptionHandler.php';
        file_put_contents($handler_path, $this->authenticationExceptionHandlerTemplate->get());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateHttpExceptionHandler()
    {
        $handler_path = app_path() . '/Exceptions/Handlers/HttpExceptionHandler.php';
        file_put_contents($handler_path, $this->httpExceptionHandlerTemplate->get());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateMethodNotAllowedExceptionHandlerTemplate()
    {
        $handler_path = app_path() . '/Exceptions/Handlers/MethodNotAllowedExceptionHandler.php';
        file_put_contents($handler_path, $this->methodNotAllowedExceptionHandlerTemplate->get());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateMethodNotAllowedHttpExceptionHandlerTemplate()
    {
        $handler_path = app_path() . '/Exceptions/Handlers/MethodNotAllowedHttpExceptionHandler.php';
        file_put_contents($handler_path, $this->methodNotAllowedHttpExceptionHandlerTemplate->get());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateModelNotFoundExceptionHandlerTemplate()
    {
        $handler_path = app_path() . '/Exceptions/Handlers/ModelNotFoundExceptionHandler.php';
        file_put_contents($handler_path, $this->modelNotFoundExceptionHandlerTemplate->get());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateNotFoundHttpExceptionHandlerTemplate()
    {
        $handler_path = app_path() . '/Exceptions/Handlers/NotFoundHttpExceptionHandler.php';
        file_put_contents($handler_path, $this->notFoundHttpExceptionHandlerTemplate->get());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateQueryExceptionHandlerTemplate()
    {
        $handler_path = app_path() . '/Exceptions/Handlers/QueryExceptionHandler.php';
        file_put_contents($handler_path, $this->queryExceptionHandlerTemplate->get());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateRelationNotFoundExceptionHandlerTemplate()
    {
        $handler_path = app_path() . '/Exceptions/Handlers/RelationNotFoundExceptionHandler.php';
        file_put_contents($handler_path, $this->relationNotFoundExceptionHandlerTemplate->get());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateUnauthorizedExceptionHandlerTemplate()
    {
        $handler_path = app_path() . '/Exceptions/Handlers/UnauthorizedExceptionHandler.php';
        file_put_contents($handler_path, $this->unauthorizedExceptionHandlerTemplate->get());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateValidationExceptionHandlerTemplate()
    {
        $handler_path = app_path() . '/Exceptions/Handlers/ValidationExceptionHandler.php';
        file_put_contents($handler_path, $this->validationExceptionHandlerTemplate->get());
    }
}
