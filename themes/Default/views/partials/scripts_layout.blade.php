<form action="{{ route('logout') }}" method="POST" id="logout-form">
    @csrf
</form>
<!-- Vendor scrits: js libraries and plugins-->
<script src="https://finder.createx.studio/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://finder.createx.studio/vendor/simplebar/dist/simplebar.min.js"></script>
<script src="https://finder.createx.studio/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
<script src="https://finder.createx.studio/vendor/nouislider/dist/nouislider.min.js"></script>
<script src="https://finder.createx.studio/vendor/tiny-slider/dist/min/tiny-slider.js"></script>
<script src="https://finder.createx.studio/vendor/lightgallery/lightgallery.min.js"></script>
<script src="https://finder.createx.studio/vendor/cleave.js/dist/cleave.min.js"></script>
<script src="https://finder.createx.studio/vendor/lightgallery/plugins/fullscreen/lg-fullscreen.min.js"></script>
<script src="https://finder.createx.studio/vendor/lightgallery/plugins/zoom/lg-zoom.min.js"></script>
<script src="https://finder.createx.studio/vendor/lightgallery/plugins/thumbnail/lg-thumbnail.min.js"></script>
<script src="https://finder.createx.studio/vendor/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>

@include('partials.toastify')
@include('partials.toggle_likes')
@include('partials.places_api')

{!! $js_vendor ?? null !!}

@stack('js_vendor')

<script>
    const logout = () => {
        if (!confirm(@js(__('Surely you want to log out?')))) return;
        let form = document.getElementById('logout-form');
        form.submit();
    }
</script>
<!-- Main theme script-->
<script src="https://finder.createx.studio/js/theme.min.js"></script>
