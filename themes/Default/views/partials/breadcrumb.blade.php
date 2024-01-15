  <nav class="mb-4 pt-md-3" aria-label="Breadcrumb">
      <ol class="breadcrumb">
          @foreach ($before as $key => $value)
              <li class="breadcrumb-item"><a href="{{ $value }}">{{ $key }}</a></li>
          @endforeach
          <li class="breadcrumb-item active" aria-current="page">{{ $active }}</li>
      </ol>
  </nav>
