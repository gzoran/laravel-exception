<?php

/*
 * This file is part of the gzoran/laravel-exception.
 *
 * (c) gzoran <gzoran@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

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
     * @param AppExceptionTemplate                         $appExceptionTemplate
     * @param AppExceptionHandlerTemplate                  $appExceptionHandlerTemplate
     * @param ExceptionHandlerTemplate                     $exceptionHandlerTemplate
     * @param AuthenticationExceptionHandlerTemplate       $authenticationExceptionHandlerTemplate
     * @param HttpExceptionHandlerTemplate                 $httpExceptionHandlerTemplate
     * @param MethodNotAllowedExceptionHandlerTemplate     $methodNotAllowedExceptionHandlerTemplate
     * @param MethodNotAllowedHttpExceptionHandlerTemplate $methodNotAllowedHttpExceptionHandlerTemplate
     * @param ModelNotFoundExceptionHandlerTemplate        $modelNotFoundExceptionHandlerTemplate
     * @param NotFoundHttpExceptionHandlerTemplate         $notFoundHttpExceptionHandlerTemplate
     * @param QueryExceptionHandlerTemplate                $queryExceptionHandlerTemplate
     * @param RelationNotFoundExceptionHandlerTemplate     $relationNotFoundExceptionHandlerTemplate
     * @param UnauthorizedExceptionHandlerTemplate         $unauthorizedExceptionHandlerTemplate
     * @param ValidationExceptionHandlerTemplate           $validationExceptionHandlerTemplate
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
    ) {
        parent::__construct();

        $this->appExceptionTemplate = $appExceptionTemplate;
        $this->appExceptionHandlerTemplate = $appExceptionHandlerTemplate;
        $this->exceptionHandlerTemplate = $exceptionHandlerTemplate;
        $this->authenticationExceptionHandlerTemplate = $authenticationExceptionHandlerTemplate;
        $this->httpExceptionHandlerTemplate = $httpExceptionHandlerTemplate;
        $this->methodNotAllowedExceptionHandlerTemplate = $methodNotAllowedExceptionHandlerTemplate;
        $this->methodNotAllowedHttpExceptionHandlerTemplate = $methodNotAllowedHttpExceptionHandlerTemplate;
        $this->modelNotFoundExceptionHandlerTemplate = $modelNotFoundExceptionHandlerTemplate;
        $this->notFoundHttpExceptionHandlerTemplate = $notFoundHttpExceptionHandlerTemplate;
        $this->queryExceptionHandlerTemplate = $queryExceptionHandlerTemplate;
        $this->relationNotFoundExceptionHandlerTemplate = $relationNotFoundExceptionHandlerTemplate;
        $this->unauthorizedExceptionHandlerTemplate = $unauthorizedExceptionHandlerTemplate;
        $this->validationExceptionHandlerTemplate = $validationExceptionHandlerTemplate;
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
        $handlerFolder = app_path().'/Exceptions/Handlers';
        if (!is_dir($handlerFolder)) {
            mkdir($handlerFolder);
        }
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateAppException()
    {
        $filePath = app_path().'/Exceptions/AppException.php';
        file_put_contents($filePath, $this->appExceptionTemplate->get());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateAppExceptionHandler()
    {
        $handlerPath = app_path().'/Exceptions/Handlers/AppExceptionHandler.php';
        file_put_contents($handlerPath, $this->appExceptionHandlerTemplate->get());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateExceptionHandler()
    {
        $handlerPath = app_path().'/Exceptions/Handlers/ExceptionHandler.php';
        file_put_contents($handlerPath, $this->exceptionHandlerTemplate->get());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateAuthenticationExceptionHandler()
    {
        $handlerPath = app_path().'/Exceptions/Handlers/AuthenticationExceptionHandler.php';
        file_put_contents($handlerPath, $this->authenticationExceptionHandlerTemplate->get());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateHttpExceptionHandler()
    {
        $handlerPath = app_path().'/Exceptions/Handlers/HttpExceptionHandler.php';
        file_put_contents($handlerPath, $this->httpExceptionHandlerTemplate->get());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateMethodNotAllowedExceptionHandlerTemplate()
    {
        $handlerPath = app_path().'/Exceptions/Handlers/MethodNotAllowedExceptionHandler.php';
        file_put_contents($handlerPath, $this->methodNotAllowedExceptionHandlerTemplate->get());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateMethodNotAllowedHttpExceptionHandlerTemplate()
    {
        $handlerPath = app_path().'/Exceptions/Handlers/MethodNotAllowedHttpExceptionHandler.php';
        file_put_contents($handlerPath, $this->methodNotAllowedHttpExceptionHandlerTemplate->get());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateModelNotFoundExceptionHandlerTemplate()
    {
        $handlerPath = app_path().'/Exceptions/Handlers/ModelNotFoundExceptionHandler.php';
        file_put_contents($handlerPath, $this->modelNotFoundExceptionHandlerTemplate->get());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateNotFoundHttpExceptionHandlerTemplate()
    {
        $handlerPath = app_path().'/Exceptions/Handlers/NotFoundHttpExceptionHandler.php';
        file_put_contents($handlerPath, $this->notFoundHttpExceptionHandlerTemplate->get());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateQueryExceptionHandlerTemplate()
    {
        $handlerPath = app_path().'/Exceptions/Handlers/QueryExceptionHandler.php';
        file_put_contents($handlerPath, $this->queryExceptionHandlerTemplate->get());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateRelationNotFoundExceptionHandlerTemplate()
    {
        $handlerPath = app_path().'/Exceptions/Handlers/RelationNotFoundExceptionHandler.php';
        file_put_contents($handlerPath, $this->relationNotFoundExceptionHandlerTemplate->get());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateUnauthorizedExceptionHandlerTemplate()
    {
        $handlerPath = app_path().'/Exceptions/Handlers/UnauthorizedExceptionHandler.php';
        file_put_contents($handlerPath, $this->unauthorizedExceptionHandlerTemplate->get());
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    private function generateValidationExceptionHandlerTemplate()
    {
        $handlerPath = app_path().'/Exceptions/Handlers/ValidationExceptionHandler.php';
        file_put_contents($handlerPath, $this->validationExceptionHandlerTemplate->get());
    }
}
