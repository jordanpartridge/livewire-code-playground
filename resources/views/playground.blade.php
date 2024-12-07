<div>
    <div class="border rounded-lg overflow-hidden bg-white shadow-sm">
        <div class="p-4 bg-gray-50 border-b flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <select
                    wire:model.live="language"
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >
                    <option value="php">PHP</option>
                    <option value="javascript">JavaScript</option>
                    <option value="html">HTML</option>
                </select>

                <button
                    wire:click="executeCode"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-75"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-75"
                >
                    <span wire:loading.remove wire:target="executeCode">Run Code</span>
                    <span wire:loading wire:target="executeCode">Running...</span>
                </button>
            </div>
        </div>

        <div class="relative">
            <div id="editor" class="h-64 font-mono text-sm"></div>
        </div>

        @if($output !== null)
            <div class="p-4 bg-gray-50 border-t">
                <h3 class="text-sm font-semibold text-gray-900 mb-2">Output:</h3>
                <pre class="bg-white p-3 rounded border overflow-x-auto">{{ $output }}</pre>
            </div>
        @endif
    </div>

    @push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            const editor = CodeMirror(document.getElementById('editor'), {
                value: @json($code),
                mode: @json($language),
                theme: 'monokai',
                lineNumbers: true,
                autoCloseBrackets: true,
                matchBrackets: true,
                indentUnit: 4,
                tabSize: 4,
                lineWrapping: true,
                extraKeys: {
                    'Ctrl-Space': 'autocomplete',
                    'Tab': 'indentMore',
                    'Shift-Tab': 'indentLess'
                }
            });

            editor.on('change', (cm) => {
                @this.updateCode(cm.getValue());
            });

            Livewire.on('languageChanged', (language) => {
                editor.setOption('mode', language);
            });
        });
    </script>
    @endpush
</div>