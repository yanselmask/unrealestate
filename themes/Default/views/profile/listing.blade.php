@extends('profile.layout', [
    'before' => [
        'Home' => route('home'),
        'Account' => route('profile.edit'),
    ],
    'active' => __('My Properties'),
])
@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h2 mb-0">{{ __('My Properties') }}</h1>
        @include('partials.modal.confirm', [
            'route' => route('profile.listing.destroy.all'),
            'title' => 'Surely you want to delete all properties',
            'aditional' => 'status',
            'aditionalValue' => request()->query('status'),
        ])
        @if ($properties->count() > 0)
            <a type="button" data-bs-toggle="modal" data-bs-target="#deleteForm" class="fw-bold text-decoration-none"
                href="javascript:;">
                <i class="fi-trash mt-n1 me-2"></i>{{ __('Delete all') }}
            </a>
        @endif
    </div>
    <p class="mb-4 pt-1">{{ __('Here you can see your property offers and edit them easily') }}.</p>
    <!-- Nav tabs-->
    <ul class="nav nav-tabs border-bottom mb-4" role="tablist">
        <li class="nav-item mb-3">
            <a class="nav-link {{ request()->query('status', '') == 'published' || request()->query('status', '') == '' ? 'active' : '' }}"
                href="{{ request()->url() . '?status=published' }}" role="tab"
                aria-selected="{{ request()->query('status', '') == 'published' }}">
                <i class="fi-file fs-base me-2"></i>{{ __('Published') }}
            </a>
        </li>
        <li class="nav-item mb-3">
            <a class="nav-link {{ request()->query('status', '') == 'draft' ? 'active' : '' }}"
                href="{{ request()->url() . '?status=draft' }}" role="tab"
                aria-selected="{{ request()->query('status', '') == 'draft' }}">
                <i class="fi-file-clean fs-base me-2"></i>{{ __('Drafts') }}
            </a>
        </li>
        <li class="nav-item mb-3">
            <a class="nav-link {{ request()->query('status', '') == 'archived' ? 'active' : '' }}"
                href="{{ request()->url() . '?status=archived' }}" role="tab"
                aria-selected="{{ request()->query('status', '') == 'archived' }}">
                <i class="fi-archive fs-base me-2"></i>{{ __('Archived') }}
            </a>
        </li>
    </ul>
    <!-- Item-->
    @each('partials.listing.grid', $properties, 'property', 'partials.not_found')
    <!-- Pagination-->
    {{ $properties->appends(request()->query())->links() }}
@endsection
