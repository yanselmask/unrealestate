  @include('partials.modal.confirm', [
      'id' => 'deleteForm-' . $property->id,
      'route' => route('profile.listing.destroy', $property),
      'title' => 'Surely you want to delete this property',
  ])
  <div class="card card-hover card-horizontal mb-4 border-0 shadow-sm">
      <a class="card-img-top" href="{{ route('home.listing.show', $property) }}"
          style="background-image: url({{ $property->image_thumb_url }});">
          @if (is_new($property->created_at))
              <div class="position-absolute start-0 top-0 ps-3 pt-3">
                  <span class="d-table badge bg-info">{{ __('New') }}</span>
              </div>
          @endif
      </a>
      <div class="card-body position-relative pb-3">
          <div class="dropdown position-absolute zindex-5 end-0 top-0 me-3 mt-3">
              <button class="btn btn-icon btn-light btn-xs rounded-circle shadow-sm" type="button" id="contextMenu1"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fi-dots-vertical"></i>
              </button>
              <ul class="dropdown-menu my-1" aria-labelledby="contextMenu1">
                  <li>
                      <a class="dropdown-item" href="{{ route('home.listing.edit', $property) }}">
                          <i class="fi-edit me-2 opacity-60"></i>{{ __('Edit') }}
                      </a>
                  </li>
                  <li>
                      <button class="dropdown-item" type="button">
                          <i class="fi-flame me-2 opacity-60"></i>{{ __('Promote') }}
                      </button>
                  </li>
                  @if ($property->status->value == 0)
                      <li>
                          <form action="{{ route('profile.listing.change.status', $property) }}" method="POST">
                              @csrf
                              @method('PATCH')
                              <input type="hidden" name="status" value="1">
                              <button class="dropdown-item" type="submit">
                                  <i class="fi-power me-2 opacity-60"></i>{{ __('Publish') }}
                              </button>
                          </form>
                      </li>
                      <li>
                          <form action="{{ route('profile.listing.change.status', $property) }}" method="POST">
                              @csrf
                              @method('PATCH')
                              <input type="hidden" name="status" value="2">
                              <button class="dropdown-item" type="submit">
                                  <i class="fi-archive me-2 opacity-60"></i>{{ __('Archive') }}
                              </button>
                          </form>
                      </li>
                  @elseif($property->status->value == 1)
                      <li>
                          <form action="{{ route('profile.listing.change.status', $property) }}" method="POST">
                              @csrf
                              @method('PATCH')
                              <input type="hidden" name="status" value="0">
                              <button class="dropdown-item" type="submit">
                                  <i class="fi-power me-2 opacity-60"></i>{{ __('Deactive') }}
                              </button>
                          </form>
                      </li>
                  @else
                      <li>
                          <form action="{{ route('profile.listing.change.status', $property) }}" method="POST">
                              @csrf
                              @method('PATCH')
                              <input type="hidden" name="status" value="1">
                              <button class="dropdown-item" type="submit">
                                  <i class="fi-power me-2 opacity-60"></i>{{ __('Publish') }}
                              </button>
                          </form>
                      </li>
                  @endif
                  <li>
                      <button data-bs-toggle="modal" data-bs-target="#deleteForm-{{ $property->id }}"
                          class="dropdown-item" type="button">
                          <i class="fi-trash me-2 opacity-60"></i>{{ __('Delete') }}
                      </button>
                  </li>
              </ul>
          </div>
          <h4 class="fs-xs fw-normal text-uppercase text-primary mb-1">
              {{ $property->property_type == 0 ? 'For Sell' : 'For Rent' }}
          </h4>
          <h3 class="h6 fs-base mb-2">
              <a class="nav-link stretched-link" href="{{ route('home.listing.show', $property) }}">
                  {{ $property->title }}
              </a>
          </h3>
          <p class="fs-sm text-muted mb-2">{{ $property->address }}</p>
          <div class="fw-bold">
              <i class="fi-cash mt-n1 lead me-2 align-middle opacity-70"></i>
              {{ $property->price }}
          </div>
          <div
              class="d-flex align-items-center justify-content-center justify-content-sm-start border-top text-nowrap mt-3 pb-2 pt-3">
              @if ($property->facilities)
                  @foreach ($property->facilities()->whereIn('type', ['radio'])->get()->slice(0, 3) as $item)
                      <span class="d-inline-block fs-sm mx-1 px-2">{{ facility_value($property->id, $item->id) }}
                          {!! $item->icon ?? null !!}
                      </span>
                  @endforeach
              @endif
          </div>
      </div>
  </div>
