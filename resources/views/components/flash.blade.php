@if (session('success'))
    <div class="flash-message bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded" role="alert">
        <p class="font-bold">{{ __('Success') }}</p>
        <p>{{ session('success') }}</p>
    </div>
@endif

@if (session('error'))
    <div class="flash-message bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded" role="alert">
        <p class="font-bold">{{ __('Error') }}</p>
        <p>{{ session('error') }}</p>
    </div>
@endif

@if (session('warning'))
    <div class="flash-message bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4 rounded" role="alert">
        <p class="font-bold">{{ __('Warning') }}</p>
        <p>{{ session('warning') }}</p>
    </div>
@endif

@if (session('info'))
    <div class="flash-message bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-4 rounded" role="alert">
        <p class="font-bold">{{ __('Info') }}</p>
        <p>{{ session('info') }}</p>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            const flashMessages = document.querySelectorAll('.flash-message');
            flashMessages.forEach(message => {
                message.style.transition = 'opacity 0.5s ease-out';
                message.style.opacity = '0';
                setTimeout(() => message.remove(), 500);
            });
        }, 5000);
    });
</script>
