<?php
/**
 * Created by Mike <zhengzhe94@gmail.com>.
 * Date: 2018/12/4
 * Time: 17:12
 */

namespace Gzoran\Exception;

use Exception;
use Gzoran\ApiResponse\ApiResponseTrait;
use Gzoran\Exception\Contracts\ExceptionHandlerContract;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait ExceptionHandlerTrait
{
    use ApiResponseTrait;

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @return array
     */
    protected function handlers()
    {
        return config('exception.handlers');
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @return string
     */
    protected function baseExceptionHandler()
    {
        return config('exception.base_exception_handler');
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @return array
     */
    protected function apiStartsWith()
    {
        return config('exception.api_starts_with');
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @param Request $request
     * @param Exception $exception
     * @return mixed
     */
    protected function handlersRender(Request $request, Exception $exception)
    {
        if ($render = $this->matchExceptionRender($request, $exception)) {
            return $render;
        }

        if ($render = $this->baseExceptionRender($request, $exception)) {
            return $render;
        }

        return parent::render($request, $exception);
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @param Request $request
     * @return bool
     */
    protected function expectsJson(Request $request)
    {
        $api_starts_with = $this->apiStartsWith();

        foreach ($api_starts_with as $value) {
            if (Str::startsWith($request->getPathInfo(), $value)) {
                return true;
            }
        }

        return $request->expectsJson();
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @param Request $request
     * @param Exception $exception
     * @return mixed
     */
    protected function matchExceptionRender(Request $request, Exception $exception)
    {
        $render   = false;
        $handlers = $this->handlers();

        /**
         * @var $handler_class ExceptionHandlerContract
         */
        foreach ($handlers as $exception_class => $handler_class) {
            if (get_class($exception) != $exception_class) {
                continue;
            }
            if ($this->expectsJson($request)) {
                $render = app($handler_class)->apiRender($request, $exception);
            } else {
                $render = app($handler_class)->pageRender($request, $exception);
            }
            break;
        }

        return $render;
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     * @param Request $request
     * @param Exception $exception
     * @return mixed
     */
    protected function baseExceptionRender(Request $request, Exception $exception)
    {
        $handler = app($this->baseExceptionHandler());

        if ($this->expectsJson($request)) {
            $render = $handler->apiRender($request, $exception);
        } else {
            $render = $handler->pageRender($request, $exception);
        }

        return $render;
    }
}
