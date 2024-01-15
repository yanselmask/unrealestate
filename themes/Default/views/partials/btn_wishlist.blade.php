<button data-model="{{ $property->id }}"
    class="like-properties-btn @auth @if ($property->liked()) bg-primary text-white @endif @endauth btn btn-icon btn-light-primary btn-xs rounded-circle mb-2 ms-2 shadow-sm"
    type="button"
    data-bs-toggle="tooltip"@auth @if ($property->liked()) title="{{ __('Remove of Wishlist') }}" @else title="{{ __('Add to Wishlist') }}" @endif @endauth>
    <i class="fi-heart"></i>
</button>
