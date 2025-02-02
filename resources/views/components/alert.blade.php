@if(session('success'))
    <div id="success-alert" class="fixed top-3 right-4 transform -translate-x-1/2 bg-green-500 text-white p-4 rounded-lg shadow-lg opacity-100 transition-opacity duration-500">
            <span>{{ session('success') }}</span>
    </div>

    <script>
        setTimeout(function() {
            const alert = document.getElementById('success-alert');
            alert.classList.add('opacity-0');
            setTimeout(function() {
                alert.style.display = 'none';
            }, 500); 
        }, 3000);
    </script>
@endif
