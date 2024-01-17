<script>
    (g => {
        var h, a, k, p = "The Google Maps JavaScript API",
            c = "google",
            l = "importLibrary",
            q = "__ib__",
            m = document,
            b = window;
        b = b[c] || (b[c] = {});
        var d = b.maps || (b.maps = {}),
            r = new Set,
            e = new URLSearchParams,
            u = () => h || (h = new Promise(async (f, n) => {
                await (a = m.createElement("script"));
                e.set("libraries", [...r] + "");
                for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                e.set("callback", c + ".maps." + q);
                a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                d[q] = f;
                a.onerror = () => h = n(Error(p + " could not load."));
                a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                m.head.append(a)
            }));
        d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() =>
            d[l](f, ...n))
    })({
        key: @js(env('GOOGLE_MAPS_API_KEY'))
        // Add other bootstrap parameters as needed, using camel case.
        // Use the 'v' parameter to indicate the version to load (alpha, beta, weekly, etc.)
    });

    let map;

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

    async function initMap() {
        const places = await google.maps.importLibrary("places");
        let input = document.getElementById('address_box');
        let options = {
            types: ['geocode'], // Limita la búsqueda a ubicaciones geográficas
        };
        let autocomplete = new google.maps.places.Autocomplete(input, options);

        autocomplete.addListener('place_changed', function() {
            let place = autocomplete.getPlace();

            // Accede a las propiedades del lugar seleccionado
            let country = obtenerComponenteDireccion(place, 'country');
            let city = obtenerComponenteDireccion(place, 'locality');
            let state = obtenerComponenteDireccion(place, 'administrative_area_level_1');
            let zip = obtenerComponenteDireccion(place, 'postal_code');

            if (document.getElementById('ap-country') && document.getElementById('ap-city') && document
                .getElementById('ap-state') && document.getElementById('ap-zip')) {
                document.getElementById('ap-country').value = country;
                document.getElementById('ap-city').value = city;
                document.getElementById('ap-state').value = state;
                document.getElementById('ap-zip').value = zip;
            }
        });

        console.log(autocomplete)
    }

    initMap();
</script>
