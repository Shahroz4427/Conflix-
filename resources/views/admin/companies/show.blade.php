<x-app-layout :routePrefix="auth()->user()->user_type=='admin' ? 'admin' : 'company'">
    <div class="container-fluid py-4">
        <h4 class="fw-bold mb-3">{{ $company->user->name }}</h4>

        <div class="bg-light rounded p-3 mb-4">
            <p class="text-muted mb-1">ID# {{ str_pad($company->id, 2, '0', STR_PAD_LEFT) }}</p>
            <p><strong>Email:</strong> <a href="mailto:{{ $company->user->email }}">{{ $company->user->email }}</a></p>
            <p><strong>Created on:</strong> {{ $company->created_at->format('d M Y') }}</p>
            <p><strong>Number of Clients:</strong> {{ $company->total_clients }}</p>
            <p><strong>Number of Lawyers:</strong> {{ $company->total_lawyers }}</p>
            <p><strong>Conflicts Sent:</strong> {{ str_pad($company->total_conflict_sent, 2, '0', STR_PAD_LEFT) }}</p>
            <v>

                <h5 class="fw-bold mb-2">Subscription Details</h5>

                <div class="bg-light rounded p-3">
                    <div class="row fw-semibold border-bottom pb-2 mb-2">
                        <div class="col-3">Plan</div>
                        <div class="col-3">Charges</div>
                        <div class="col-3">Purchase On</div>
                        <div class="col-3">Recurring Date</div>
                    </div>
                    <div class="row">
                        <div class="col-3">{{ $company->subscriptionPlan->plan ?? '-' }}</div>
                        <div class="col-3">${{ $company->subscriptionPlan->charges ?? '0' }}</div>
                        <div class="col-3">{{ $company->subscriptionPlan->created_at->format('d M Y') ?? '-' }}</div>
                        <div class="col-3">
                            {{ $company->subscriptionPlan->created_at->addYear()->subDay()->format('d M Y') ?? '-' }}
                        </div>
                    </div>
                </div>
        </div>
</x-app-layout>