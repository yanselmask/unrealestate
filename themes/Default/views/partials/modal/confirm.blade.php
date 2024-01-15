@props([
    'id' => 'deleteForm',
    'route' => route('profile.destroy'),
    'title' => 'Are you sure you want to perform this action?',
])
<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $id }}Label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ $route }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ __($title) }}
                    </h5>
                    <button type="button" class="close btn btn-link" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        @if (isset($aditional) && isset($aditionalValue))
                            <input type="hidden" name="{{ $aditional }}" value="{{ $aditionalValue }}">
                        @endif
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" id="password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-danger">{{ __('Confirm') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
