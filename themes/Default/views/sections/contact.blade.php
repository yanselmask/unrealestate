<!-- Breadcrumb-->
<div class="mb-md-4 container mt-5 pt-5">
    <nav class="pt-md-3 mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $content[0]['data']['heading'] }}</li>
        </ol>
    </nav>
</div>
<section class="pb-md-4 pb-lg-5 container mb-5 pb-2">
    <div class="row align-items-md-start align-items-center gy-4">
        <div class="col-lg-5 col-md-6">
            <div class="mx-md-0 mb-md-5 pb-md-4 text-md-start mx-auto mb-4 text-center" style="max-width: 416px;">
                <h1 class="mb-4">{{ $content[0]['data']['heading'] }}</h1>
                <p class="fs-lg text-muted mb-0">{!! $content[0]['data']['description'] !!}</p>
            </div><img class="d-block mx-auto" src="{{ Storage::url($content[0]['data']['image']) }}"
                alt="{{ $content[0]['data']['heading'] }}">
        </div>
        <div class="col-md-6 offset-lg-1">
            <div class="card bg-secondary p-sm-3 border-0 p-2">
                <div class="card-body m-1">
                    <form action="{{ route('contacts.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label" for="c-name">{{ __('Full Name') }}</label>
                            <input name="fullname"
                                class="form-control form-control-lg @error('fullname') is-invalid @enderror"
                                id="c-name" type="text" required>
                            @error('fullname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="c-email">{{ __('Your Email') }}</label>
                            <input name="email"
                                class="form-control form-control-lg @error('email') is-invalid @enderror" id="c-email"
                                type="email" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="c-message">{{ __('Message') }}</label>
                            <textarea name="message" class="form-control form-control-lg @error('message') is-invalid @enderror" id="c-message"
                                rows="4" placeholder="{{ __('Leave your message') }}" required></textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="pt-sm-2 pt-1">
                            <button class="btn btn-lg btn-primary w-sm-auto w-100"
                                type="submit">{{ __($content[0]['data']['btn_text'] ?? 'Submit form') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
