<x-app-layout :routePrefix="auth()->user()->user_type=='admin' ? 'admin' : 'company'">
    <div class="container-fluid py-4">
        <div class="container py-4">
            <h2 class="fw-bold mb-4">Hello, {{ Auth::user()->name }}</h2>
        </div>

    </div>
</x-app-layout>