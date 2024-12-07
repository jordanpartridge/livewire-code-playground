<?php

namespace JordanPartridge\LivewireCodePlayground\Services;

use Illuminate\Support\Facades\Log;
use JordanPartridge\LivewireCodePlayground\Exceptions\ExecutionException;

class CodeExecutor
{
    private const DOCKER_IMAGE = 'php:8.2-cli';

    public function execute(string $code, string $language, int $timeout = 5, string $memoryLimit = '128M'): string
    {
        try {
            $this->validateCode($code, $language);
            
            return match($language) {
                'php' => $this->executePhp($code, $timeout, $memoryLimit),
                'javascript' => $this->executeJavaScript($code, $timeout, $memoryLimit),
                'html' => $this->executeHtml($code),
                default => throw new ExecutionException('Unsupported language'),
            };
        } catch (\Exception $e) {
            Log::error('Code execution failed', [
                'code_hash' => hash('sha256', $code),
                'language' => $language,
                'error' => $e->getMessage()
            ]);
            
            throw new ExecutionException($e->getMessage());
        }
    }

    private function executePhp(string $code, int $timeout, string $memoryLimit): string
    {
        // Run in Docker for isolation
        $command = [
            'docker', 'run',
            '--rm',
            '--memory=' . $memoryLimit,
            '--cpus=0.5',
            '--network=none',
            '--timeout=' . $timeout,
            self::DOCKER_IMAGE,
            'php', '-r', $code
        ];

        $process = new Process($command);
        $process->setTimeout($timeout);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ExecutionException($process->getErrorOutput());
        }

        return $process->getOutput();
    }

    private function executeJavaScript(string $code, int $timeout, string $memoryLimit): string
    {
        // Implement Node.js execution in Docker
        return 'JavaScript execution not yet implemented';
    }

    private function executeHtml(string $code): string
    {
        // For HTML, we just return the code as it will be rendered client-side
        return $code;
    }

    private function validateCode(string $code, string $language): void
    {
        // Implement more sophisticated validation using AST parsing
    }
}
