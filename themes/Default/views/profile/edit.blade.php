@extends('profile.layout', [
    'before' => [
        'Home' => route('home'),
        'Account' => route('profile.edit'),
    ],
    'active' => __('Personal Info'),
])
@section('content')
    <h1 class="h2">{{ __('Personal Info') }}</h1>
    <label class="form-label pt-2" for="account-bio">{{ __('Profile Photo') }}</label>
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="rounded-3 mb-4 border p-3" id="personal-info">
            <!-- Name-->
            <div class="border-bottom mb-3 pb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="pe-2">
                        <label class="form-label fw-bold">{{ __('Full name') }}</label>
                        <div id="name-value">{{ old('name', $user->fullname) }}</div>
                    </div>
                    <div data-bs-toggle="tooltip" title="Edit"><a class="nav-link py-0" href="#name-collapse"
                            data-bs-toggle="collapse"><i class="fi-edit"></i></a></div>
                </div>
                <div class="row collapse" id="name-collapse" data-bs-parent="#personal-info">
                    <div class="col">
                        <label for="form-label fw-bold">{{ __('Name') }}</label>
                        <input name="name" class="form-control @error('name') is-invalid @enderror mt-3" type="text"
                            data-bs-binded-element="#name-value" data-bs-unset-value="{{ __('Not specified') }}"
                            value="{{ old('name', $user->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="form-label fw-bold">{{ __('Lastname') }}</label>
                        <input name="lastname" class="form-control @error('lastname') is-invalid @enderror mt-3"
                            type="text" data-bs-binded-element="#lastname-value"
                            data-bs-unset-value="{{ __('Not specified') }}"
                            value="{{ old('lastname', $user->lastname) }}">
                        @error('lastname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- Email-->
            <div class="border-bottom mb-3 pb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="pe-2">
                        <label class="form-label fw-bold">{{ __('Email') }}</label>
                        <div id="email-value">{{ old('email', $user->email) }}</div>
                    </div>
                    <div data-bs-toggle="tooltip" title="{{ __('Edit') }}"><a class="nav-link py-0"
                            href="#email-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a>
                    </div>
                </div>
                <div class="collapse" id="email-collapse" data-bs-parent="#personal-info">
                    <input name="email" class="form-control @error('email') is-invalid @enderror mt-3" type="email"
                        data-bs-binded-element="#email-value" data-bs-unset-value="{{ __('Not specified') }}"
                        value="{{ old('email', $user->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Number Phone-->
            <div class="border-bottom mb-3 pb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="pe-2">
                        <label class="form-label fw-bold">{{ __('Phone') }}</label>
                        <div id="phone-value">{{ old('phone', $user->phone) }}</div>
                    </div>
                    <div data-bs-toggle="tooltip" title="{{ __('Edit') }}">
                        <a class="nav-link py-0" href="#phone-collapse" data-bs-toggle="collapse">
                            <i class="fi-edit"></i>
                        </a>
                    </div>
                </div>
                <div class="collapse" id="phone-collapse" data-bs-parent="#personal-info">
                    <input name="phone" class="form-control @error('phone') is-invalid @enderror mt-3" type="tel"
                        data-bs-binded-element="#phone-value" data-bs-unset-value="{{ __('Not specified') }}"
                        value="{{ old('phone', $user->phone) }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Company-->
            <div class="border-bottom mb-3 pb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="pe-2">
                        <label class="form-label fw-bold">{{ __('Company name') }}</label>
                        <div id="company-value">{{ old('company', $user->company) }}</div>
                    </div>
                    <div data-bs-toggle="tooltip" title="{{ __('Edit') }}"><a class="nav-link py-0"
                            href="#company-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a>
                    </div>
                </div>
                <div class="collapse" id="company-collapse" data-bs-parent="#personal-info">
                    <input value="{{ old('company', $user->company) }}" type="text"
                        class="form-control @error('company') is-invalid @enderror" name="company"
                        placeholder="{{ __('Your company') }}">
                    @error('company')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Address-->
            <div class="border-bottom mb-3 pb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="pe-2">
                        <label class="form-label fw-bold">{{ __('Your Address') }}</label>
                        <div id="address-value">{{ __('Your Address') }}</div>
                    </div>
                    <div data-bs-toggle="tooltip" title="{{ __('Edit') }}"><a class="nav-link py-0"
                            href="#address-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a>
                    </div>
                </div>
                <div class="collapse" id="address-collapse" data-bs-parent="#personal-info">
                    <textarea name="address" placeholder="{{ __('Your Address') }}"
                        class="form-control @error('address') is-invalid @enderror mt-3">{{ old('address', $user->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- About-->
            <div class="border-bottom mb-3 pb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="pe-2">
                        <label class="form-label fw-bold">{{ __('Short bio') }}</label>
                        <div id="about-value">{{ __('Short bio') }}</div>
                    </div>
                    <div data-bs-toggle="tooltip" title="{{ __('Edit') }}"><a class="nav-link py-0"
                            href="#about-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a>
                    </div>
                </div>
                <div class="collapse" id="about-collapse" data-bs-parent="#personal-info">
                    <textarea name="about" placeholder="{{ __('Short bio') }}"
                        class="form-control @error('about') is-invalid @enderror mt-3">{{ old('about', $user->about) }}</textarea>
                    @error('about')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Profile Photo Path-->
            <div class="p3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="pe-2">
                        <label class="form-label fw-bold">{{ __('Profile Photo') }}</label>
                        <div id="about-value">{{ __('Photo') }}</div>
                    </div>
                    <div data-bs-toggle="tooltip" title="{{ __('Edit') }}"><a class="nav-link py-0"
                            href="#photo-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a>
                    </div>
                </div>
                <div class="collapse" id="photo-collapse" data-bs-parent="#personal-info">
                    <input type="file" name="photo" accept="image/*" class="form-control">
                    @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if ($user->profile_photo_path)
                        <img src="{{ $user->profile_photo_url }}" class="rounded-circle mt-2"
                            alt="{{ $user->fullname }}" style="width: 48px;height:48px;object-fit:cover;">
                    @endif
                </div>
            </div>
        </div>
        <!-- Socials-->
        <div class="pt-2">
            <label class="form-label fw-bold mb-3">{{ __('Socials') }}</label>
        </div>
        <div x-data="{
            socials: [],
            socialsReady: @js(collect($user->socials)->slice(0, 3) ?? []),
            socialsRestants: @js(collect($user->socials)->slice(3) ?? []),
            addSocial() {
                this.socials.push({
                    social: '',
                    value: ''
        
                });
                console.log(this.socialsReady)
            },
            removeSocial(index) {
                this.socials.splice(index, 1);
            },
            removeFieldDefault(index) {
                delete this.socialsReady[index];
            },
            removeFieldDefaultRestants(index) {
                delete this.socialsRestants[index];
            }
        }">
            <template x-for="(link, social) in socialsReady" :key="social">
                <div class="d-flex align-items-center mb-3">
                    <div class="btn btn-icon btn-light btn-xs rounded-circle pe-none me-3 flex-shrink-0 shadow-sm">
                        <i :class="`fi-${social} text-body`"></i>
                    </div>
                    <input x-model="link" :name="'social[' + social + ']'" class="form-control" type="text"
                        placeholder="Your social account">
                    <button class="btn btn-xs btn-danger ms-2" type="button"
                        x-on:click="removeFieldDefault(social)">X</button>
                </div>
            </template>
            <div class="collapse" id="showMoreSocials">
                <template x-for="(link, social) in socialsRestants" :key="social">
                    <div class="d-flex align-items-center mb-3">
                        <div class="btn btn-icon btn-light btn-xs rounded-circle pe-none me-3 flex-shrink-0 shadow-sm">
                            <i :class="`fi-${social} text-body`"></i>
                        </div>
                        <input x-model="link" :name="'social[' + social + ']'" class="form-control" type="text"
                            placeholder="Your social account">
                        <button class="btn btn-xs btn-danger ms-2" type="button"
                            x-on:click="removeFieldDefaultRestants(social)">X</button>
                    </div>
                </template>
            </div>
            <!-- Additional Fields -->
            <template x-for="(social, index) in socials" :key="index">
                <div class="row mb-3">
                    <div class="col">
                        <input x-model="social.social" type="text" class="form-control"
                            placeholder="{{ __('Social Name') }}" name="socialKey[]">
                    </div>
                    <div class="col">
                        <input x-model="social.value" type="text" class="form-control"
                            placeholder="{{ __('Social Link') }}" name="socialValue[]">
                    </div>
                    <div class="d-flex justify-content-start">
                        <button type="button" class="btn btn-danger btn-xs mt-3"
                            x-on:click="removeSocial(index)">&times;</button>
                    </div>
                </div>
            </template>
            <div class="row">
                <div class="col-12 d-flex justify-content-center mb-3">
                    <button @click="addSocial()" type="button"
                        class="btn btn-xs btn-primary mt-2">{{ __('+') }}</button>
                </div>
            </div>
            <template x-if="Object.entries(socialsRestants).length > 0">
                <a x-transition
                    class="collapse-label collapsed d-inline-block fs-sm fw-bold text-decoration-none pb-3 pt-2"
                    href="#showMoreSocials" data-bs-toggle="collapse" data-bs-label-collapsed="{{ __('Show more') }}"
                    data-bs-label-expanded="{{ __('Show less') }}" role="button" aria-expanded="false"
                    aria-controls="showMoreSocials">
                    <i class="fi-arrow-down me-2"></i>
                </a>
            </template>
        </div>
        <div class="d-flex align-items-center justify-content-between border-top mt-4 pb-1 pt-4">
            <button class="btn btn-primary px-sm-4 px-3" type="submit">{{ __('Save changes') }}</button>
            <button data-bs-toggle="modal" data-bs-target="#deleteForm" class="btn btn-link btn-sm px-0" type="button">
                <i class="fi-trash me-2"></i>{{ __('Delete account') }}
            </button>
        </div>
    </form>
    @include('partials.modal.confirm', [
        'title' => 'Are you sure you want to delete your account?',
    ])
@endsection
