<?php
/**
 * Created by Mike <zhengzhe94@gmail.com>.
 * Date: 2018/12/12
 * Time: 10:54
 */

namespace Gzoran\Exception\Templates;


use Gzoran\Exception\Contracts\TemplateContracts;

class AppExceptionTemplate implements TemplateContracts
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
use Illuminate\Support\Arr;

class AppException extends Exception
{
    /**
     * 错误码消息列表
     *
     * @var array
     */
    protected \$codeList = [
        '10000' => [
            'message' => '业务错误'
        ],
    ];

    /**
     * 错误详情
     *
     * @var array
     */
    protected \$errors;

    /**
     * 状态码
     *
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
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @return array
     */
    public function getResponse()
    {
        \$response = [
            'status'     => 0,
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
        return Arr::get(\$this->codeList, \$code)['message'];
    }
}
EOF;
    }
}
