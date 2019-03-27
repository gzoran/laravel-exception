<?php
/**
 * Created by Mike <zhengzhe94@gmail.com>.
 * Date: 2019/3/27
 * Time: 13:55
 */

namespace Gzoran\Exception\Demos;

use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class DemoHandlerTest extends TestCase
{
    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    public function testExpectsJson()
    {
        $request = \Mockery::mock(Request::class)->makePartial();
        $request->shouldAllowMockingProtectedMethods()->allows()->getPathInfo()->andReturn('/api');
        $request->shouldAllowMockingProtectedMethods()->allows()->expectsJson()->andReturn(false);

        $handler = \Mockery::mock(DemoHandler::class)->makePartial();
        $handler->shouldAllowMockingProtectedMethods()->allows()->apiStartsWith()->andReturn(['/api']);

        $this->assertSame(true, $handler->expectsJson($request));
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    public function testMatchExceptionRender()
    {
        $request = \Mockery::mock(Request::class)->makePartial();

        $handler = \Mockery::mock(DemoHandler::class)->makePartial();
        $handler->shouldAllowMockingProtectedMethods()->allows()->handlers()->andReturn([
            DemoException::class => DemoExceptionHandler::class
        ]);
        $handler->shouldAllowMockingProtectedMethods()->allows()->expectsJson($request)->andReturn(true);

        $exception = new DemoException();

        $this->assertSame('api', $handler->matchExceptionRender($request, $exception));
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    public function testBaseExceptionRender()
    {
        $request = \Mockery::mock(Request::class)->makePartial();

        $handler = \Mockery::mock(DemoHandler::class)->makePartial();
        $handler->shouldAllowMockingProtectedMethods()->allows()->baseExceptionHandler()->andReturn(DemoExceptionHandler::class);
        $handler->shouldAllowMockingProtectedMethods()->allows()->expectsJson($request)->andReturn(true);

        $exception = new DemoException();

        $this->assertSame('api', $handler->baseExceptionRender($request, $exception));
    }

    /**
     * @author Mike <zhengzhe94@gmail.com>
     */
    public function testHandlersRender()
    {
        $request = \Mockery::mock(Request::class)->makePartial();

        $exception = new DemoException();

        $handler = \Mockery::mock(DemoHandler::class)->makePartial();
        $handler->shouldAllowMockingProtectedMethods()->allows()->matchExceptionRender($request, $exception)->andReturn('ok');

        $this->assertSame('ok', $handler->handlersRender($request, $exception));
    }
}