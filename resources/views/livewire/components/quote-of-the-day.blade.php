<div>
    @if($quote)
        <div class="border border-gray-800 bg-gray-900/40 p-4 rounded-md h-full flex flex-col">
            <blockquote class="italic text-gray-300 flex-grow">
                "{{ $quote->quote }}"
            </blockquote>
            <p class="mt-4 text-right text-sm text-green-400 font-mono">
                – {{ $quote->author ?? 'Unknown Source' }}
            </p>
        </div>
    @else
        <div class="border border-gray-800 bg-gray-900/40 p-4 rounded-md h-full flex items-center justify-center">
            <p class="font-mono text-gray-600 text-sm">// QUOTE_STREAM_UNAVAILABLE</p>
        </div>
    @endif
</div>