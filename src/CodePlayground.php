<?php

namespace JordanPartridge\LivewireCodePlayground;

use Livewire\Component;

class CodePlayground extends Component
{
    public string $code = '';
    public string $language = 'php';
    public ?string $output = null;
    public bool $isExecuting = false;
    
    protected $listeners = ['executeCode', 'updateCode'];

    public function mount(string $initialCode = '', string $language = 'php')
    {
        $this->code = $initialCode;
        $this->language = $language;
    }

    public function updateCode(string $code): void
    {
        $this->code = $code;
    }

    public function executeCode(): void
    {
        $this->validate([
            'code' => 'required|string|max:10000',
            'language' => 'required|in:php,javascript,html'
        ]);

        $this->isExecuting = true;

        try {
            // TODO: Implement secure code execution
            $this->output = 'Code execution coming soon...';
        } catch (\Exception $e) {
            $this->output = "Error: {$e->getMessage()}";
        } finally {
            $this->isExecuting = false;
        }
    }

    public function render()
    {
        return view('livewire-code-playground::playground');
    }
}