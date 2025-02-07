<div>
    @if($selectedAsset)
        <div class="p-4 border border-gray-600 rounded shadow-md">
            <h4 class="text-lg font-bold">{{ $selectedAsset->name }}</h4>
            <p><strong>Category:</strong> {{ $selectedAsset->category }}</p>
            <p><strong>Number:</strong> {{ $selectedAsset->fa_number }}</p>
            <p><strong>Cost:</strong> {{ number_format($selectedAsset->cost, 2) }}</p>
            <p><strong>Location:</strong> {{ $selectedAsset->location }}</p>
        </div>
    @else
        <p class="text-gray-800">Click on a row to view details.</p>
    @endif
</div>