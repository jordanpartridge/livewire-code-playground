<?php

namespace JordanPartridge\LivewireCodePlayground\Tests\Services;

use JordanPartridge\LivewireCodePlayground\Services\CodeExecutor;
use Orchestra\Testbench\TestCase;

class CodeExecutorTest extends TestCase
{
    private CodeExecutor $executor;

    protected function setUp(): void
    {
        parent::setUp();
        $this->executor = new CodeExecutor();
    }

    /** @test */
    public function it_executes_php_code_in_docker(): void
    {
        $output = $this->executor->execute(
            code: 'echo "Hello Docker";',
            language: 'php'
        );

        $this->assertEquals('Hello Docker', trim($output));
    }

    /** @test */
    public function it_respects_timeout_limits(): void
    {
        $this->expectException(\Exception::class);

        $this->executor->execute(
            code: 'while(true) {};',
            language: 'php',
            timeout: 1
        );
    }

    /** @test */
    public function it_handles_syntax_errors(): void
    {
        $output = $this->executor->execute(
            code: '<?php echo "Incomplete string;',
            language: 'php'
        );

        $this->assertStringContainsString('syntax error', strtolower($output));
    }
}
