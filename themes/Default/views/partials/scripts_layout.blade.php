<form action="{{ route('logout') }}" method="POST" id="logout-form">
    @csrf
</form>
<!-- Vendor scrits: js libraries and plugins-->
<script src="https://finder.createx.studio/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://finder.createx.studio/vendor/simplebar/dist/simplebar.min.js"></script>
<script src="https://finder.createx.studio/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
<script src="https://finder.createx.studio/vendor/nouislider/dist/nouislider.min.js"></script>
<script src="https://finder.createx.studio/vendor/lightgallery/lightgallery.min.js"></script>
<script src="https://finder.createx.studio/vendor/lightgallery/plugins/fullscreen/lg-fullscreen.min.js"></script>
<script src="https://finder.createx.studio/vendor/lightgallery/plugins/zoom/lg-zoom.min.js"></script>
<script src="https://finder.createx.studio/vendor/lightgallery/plugins/thumbnail/lg-thumbnail.min.js"></script>
<script src="https://finder.createx.studio/vendor/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://finder.createx.studio/vendor/tiny-slider/dist/min/tiny-slider.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>

{!! $js_vendor ?? null !!}

@stack('js_vendor')

<!-- Agrega esto en el encabezado de tu HTML -->
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            Toastify({
                text: @js($error),
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "center",
                style: {
                    background: "#F23B48",
                    borderRadius: "20px"
                }
            }).showToast();
        </script>
    @endforeach
@endif
<script>
    const logout = () => {
        if (!confirm(@js(__('Surely you want to log out?')))) return;
        let form = document.getElementById('logout-form');
        form.submit();
    }
    @session('status')
    Toastify({
        text: @js(session('status')),
        duration: 3000,
        newWindow: true,
        close: true,
        gravity: "top",
        position: "center",
        style: {
            background: "#FD390F",
            borderRadius: "20px"
        }
    }).showToast();
    @endsession

    @session('error')
    Toastify({
        text: @js(session('error')),
        duration: 3000,
        newWindow: true,
        close: true,
        gravity: "top",
        position: "center",
        style: {
            background: "#F23B48",
            borderRadius: "20px"
        }
    }).showToast();
    @endsession

    // Función auxiliar para obtener un componente específico de la dirección
    function obtenerComponenteDireccion(place, tipo) {
        for (var i = 0; i < place.address_components.length; i++) {
            var component = place.address_components[i];
            for (var j = 0; j < component.types.length; j++) {
                if (component.types[j] === tipo) {
                    return component.long_name;
                }
            }
        }
        return '';
    }

    function inicializarAutocompletar() {
        var input = document.getElementById('address_box');
        var options = {
            types: ['geocode'], // Limita la búsqueda a ubicaciones geográficas
        };

        var autocomplete = new google.maps.places.Autocomplete(input, options);
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();

            // Accede a las propiedades del lugar seleccionado
            var country = obtenerComponenteDireccion(place, 'country');
            var city = obtenerComponenteDireccion(place, 'locality');
            var state = obtenerComponenteDireccion(place, 'administrative_area_level_1');
            var zip = obtenerComponenteDireccion(place, 'postal_code');

            if (document.getElementById('ap-country') && document.getElementById('ap-city') && document
                .getElementById('ap-state') && document.getElementById('ap-zip')) {
                document.getElementById('ap-country').value = country;
                document.getElementById('ap-city').value = city;
                document.getElementById('ap-state').value = state;
                document.getElementById('ap-zip').value = zip;
            }
        });
    }

    function toggleFor(e, value) {
        let currentUrl = new URL(@js(request()->fullUrl()))
        currentUrl.searchParams.set('for', value);

        // Redirecciona a la nueva URL
        window.location.href = currentUrl.toString();
    }

    let sortBySearch = document.getElementById('sortby_search');

    if (sortBySearch) {
        sortBySearch.addEventListener('change', function(e) {

            let currentUrl = new URL(@js(request()->fullUrl()))
            currentUrl.searchParams.set('sort_by', e.target.value);

            // Redirecciona a la nueva URL
            window.location.href = currentUrl.toString();
        })
    }

    let btnsLikeProperties = document.querySelectorAll('.like-properties-btn');
    btnsLikeProperties.forEach((btn) => {
        btn.addEventListener('click', async (e) => {
            let req = await fetch(`/properties/like/${btn.getAttribute('data-model')}`, {
                method: 'POST',
                headers: {
                    "X-CSRF-TOKEN": @js(csrf_token())
                }
            });
            let res = await req.json()

            if (res.status == 1) {
                btn.classList.toggle('bg-primary');
                btn.classList.toggle('text-white');
            }

        })
    })
    let btnsLikeReviews = document.querySelectorAll('.like-reviews-btn');
    btnsLikeReviews.forEach((btn) => {
        btn.addEventListener('click', async (e) => {
            let req = await fetch(`/review/like/${btn.getAttribute('data-model')}`, {
                method: 'POST',
                headers: {
                    "X-CSRF-TOKEN": @js(csrf_token())
                }
            });
            let res = await req.json()

            if (res.status == 1) {
                btn.getElementsByTagName('span')[0].innerHTML = res.count;
                btn.classList.toggle('text-success');
            }

        })
    })


    // Llama a la función de inicialización cuando se carga la página
    google.maps.event.addListener(window, 'load', inicializarAutocompletar);
</script>
<!-- Main theme script-->
<script src="https://finder.createx.studio/js/theme.min.js"></script>
