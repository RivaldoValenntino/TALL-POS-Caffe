<div>
    <div class="max-w-md justify-center items-center mx-auto">
        <button wire:click='printInvoice' target="_blank"
            class="w-full px-3 py-2 mt-4 text-center transition duration-300 ease-in-out rounded-lg bg-blue-600 text-white">
            <i class="ph ph-printer text-lg"></i>
            <span>Print Invoice</span>
        </button>
        <button id="pay-button"
            class="w-full px-3 py-2 mt-4 text-center transition duration-300 ease-in-out rounded-lg bg-blue-600 text-white">
            <i class="ph ph-money text-lg"></i>
            <span>Pay Now</span>
        </button>
    </div>
    @push('scripts')
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
        </script>
        <script>
            document.getElementById('pay-button').onclick = function() {
                // SnapToken acquired from previous step
                snap.pay('{{ $transaction->snap_token }}', {
                    // Optional
                    onSuccess: function(result) {
                        // window.location.href = "{{ route('orders') }}"
                    },
                    // Optional
                    onPending: function(result) {

                    },
                    // Optional
                    onError: function(result) {

                    }
                });
            };
        </script>
    @endpush
</div>
