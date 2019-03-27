<?php
/**
 * Created by Mike <zhengzhe94@gmail.com>.
 * Date: 2018/12/12
 * Time: 10:54
 */

namespace Gzoran\Exception\Templates;


use Gzoran\Exception\Contracts\TemplateContract;

class AppExceptionTemplate implements TemplateContract
{

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @return string
     */
    public function get()
    {
        return <<<EOF
<?php

namespace App\Exceptions;

use Exception;

class AppException extends Exception
{
    /**
     * @var array
     */
    protected \$codeList = [
        '10000' => [
            'message' => 'Business Error'
        ],
    ];

    /**
     * @var array
     */
    protected \$errors;

    /**
     * @var int
     */
    protected \$httpStatus;

    /**
     * AppException constructor.
     *
     * @param int \$code
     * @param array \$errors
     * @param int \$httpStatus
     */
    public function __construct(int \$code, array \$errors = [], int \$httpStatus = 400)
    {
        \$this->code       = \$code;
        \$this->message    = \$this->getCodeMessage(\$code);
        \$this->errors     = \$errors;
        \$this->httpStatus = \$httpStatus;
        
        if (\$errors && is_array(\$errors)) {
            \$this->message .= ' : ';
            foreach (\$errors as \$key => \$error) {
                \$this->message .= '[' . \$key . ' : ' . \$error . '], ';
            }
            \$this->message = rtrim( \$this->message, ', ');
        }

        if (\$errors && is_string(\$errors)) {
            \$this->message .= ' : ' . \$errors;
        }
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @return array
     */
    public function getResponse()
    {
        \$response = [
            config('exception.status.key') => config('exception.status.value'),
            'error_code' => \$this->code,
            'message'    => \$this->getCodeMessage(\$this->code),
        ];

        if (! empty(\$this->errors)) {
            \$response['errors'] = \$this->errors;
        }

        return \$response;
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @return int
     */
    public function getHttpStatus()
    {
        return \$this->httpStatus;
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @param \$code
     * @return mixed
     */
    public function getCodeMessage(\$code)
    {
        return \$this->codeList[\$code]['message'];
    }
}
EOF;
    }
}
