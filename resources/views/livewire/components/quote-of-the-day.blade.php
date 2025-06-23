<div>
    @if($quote)
        <div class="p-4 bg-white rounded shadow">
            <blockquote class="italic text-lg text-gray-800">
                "{{ $quote->quote }}"
            </blockquote>
            <p class="mt-2 text-right text-sm text-gray-600">
                – {{ $quote->author ?? 'Unknown' }}
            </p>
        </div>
    @else
        <div class="p-4 bg-white rounded shadow">
            <p class="text-gray-600">Quote of the day not available</p>
        </div>
    @endif
</div>