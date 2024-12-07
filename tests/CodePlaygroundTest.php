<?php

namespace JordanPartridge\LivewireCodePlayground\Tests;

use JordanPartridge\LivewireCodePlayground\CodePlayground;
use Livewire\Component;
use Orchestra\Testbench\TestCase;

class CodePlaygroundTest extends TestCase
{
    /** @test */
    public function it_validates_code_input(): void
    {
        $component = new CodePlayground();
        
        // Test dangerous code is rejected
        try {
            $component->code = 'system("ls");';
            $component->executeCode();
            $this->fail('Should not allow dangerous functions');
        } catch (\Exception $e) {
            $this->assertStringContainsString('validation', $e->getMessage());
        }
    }

    /** @test */
    public function it_executes_safe_code(): void
    {
        $component = new CodePlayground();
        
        $component->code = 'echo "Hello World";';
        $component->executeCode();
        
        $this->assertEquals('Hello World', trim($component->output));
    }

    /** @test */
    public function it_handles_memory_limits(): void
    {
        $component = new CodePlayground();
        
        $component->code = '$array = array_fill(0, 1000000, "test");';
        $component->executeCode();
        
        $this->assertStringContainsString('memory', $component->output);
    }
}
