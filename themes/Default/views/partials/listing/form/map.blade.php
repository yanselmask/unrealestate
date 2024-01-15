<div class="interactive-map rounded-3 leaflet-container leaflet-touch leaflet-retina leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom"
    data-map-options="{&quot;mapLayer&quot;: &quot;https://api.maptiler.com/maps/pastel/{z}/{x}/{y}.png?key=5vRQzd34MMsINEyeKPIs&quot;, &quot;coordinates&quot;: [40.7447, -73.9485], &quot;zoom&quot;: 13, &quot;scrollWheelZoom&quot;: false, &quot;markers&quot;: [{&quot;coordinates&quot;: [40.7447, -73.9485], &quot;className&quot;: &quot;custom-marker-dot&quot;, &quot;popup&quot;: &quot;<div class='p-3'><h6 class='fs-base'>Pine Apartments</h6><p class='fs-xs text-muted mt-n3 mb-0 pt-1'>28 Jackson Ave Long Island City, NY</p></div>&quot;}]}"
    style="height: 250px; position: relative;" tabindex="0">
    <div class="leaflet-pane leaflet-map-pane" style="transform: translate3d(-75px, 0px, 0px);">
        <div class="leaflet-pane leaflet-tile-pane">
            <div class="leaflet-layer" style="z-index: 1; opacity: 1;">
                <div class="leaflet-tile-container leaflet-zoom-animated"
                    style="z-index: 18; transform: translate3d(0px, 0px, 0px) scale(1);"><img crossorigin=""
                        alt=""
                        src="https://api.maptiler.com/maps/pastel/12/1206/1539.png?key=5vRQzd34MMsINEyeKPIs"
                        class="leaflet-tile leaflet-tile-loaded"
                        style="width: 512px; height: 512px; transform: translate3d(81px, -151px, 0px); opacity: 1;"><img
                        crossorigin="" alt=""
                        src="https://api.maptiler.com/maps/pastel/12/1205/1539.png?key=5vRQzd34MMsINEyeKPIs"
                        class="leaflet-tile leaflet-tile-loaded"
                        style="width: 512px; height: 512px; transform: translate3d(-431px, -151px, 0px); opacity: 1;"><img
                        crossorigin="" alt=""
                        src="https://api.maptiler.com/maps/pastel/12/1207/1539.png?key=5vRQzd34MMsINEyeKPIs"
                        class="leaflet-tile leaflet-tile-loaded"
                        style="width: 512px; height: 512px; transform: translate3d(593px, -151px, 0px); opacity: 1;">
                </div>
            </div>
        </div>
        <div class="leaflet-pane leaflet-overlay-pane"></div>
        <div class="leaflet-pane leaflet-shadow-pane"><img src="../img/map/marker-shadow.png"
                class="leaflet-marker-shadow custom-marker-dot leaflet-zoom-animated" alt=""
                style="margin-left: -13px; margin-top: -41px; width: 41px; height: 41px; transform: translate3d(404px, 125px, 0px);">
        </div>
        <div class="leaflet-pane leaflet-marker-pane"><img src="../img/map/marker-icon.png"
                class="leaflet-marker-icon custom-marker-dot leaflet-zoom-animated leaflet-interactive" alt="Marker"
                tabindex="0" role="button"
                style="margin-left: -12px; margin-top: -39px; width: 25px; height: 39px; transform: translate3d(404px, 125px, 0px); z-index: 125; outline: none;">
        </div>
        <div class="leaflet-pane leaflet-tooltip-pane"></div>
        <div class="leaflet-pane leaflet-popup-pane">
            <div class="leaflet-popup leaflet-zoom-animated"
                style="opacity: 1; transform: translate3d(405px, 97px, 0px); bottom: -7px; left: -140px;">
                <div class="leaflet-popup-content-wrapper">
                    <div class="leaflet-popup-content" style="width: 281px;">
                        <div class="p-3">
                            <h6 class="fs-base">Pine Apartments</h6>
                            <p class="fs-xs text-muted mt-n3 mb-0 pt-1">28 Jackson Ave Long Island City, NY</p>
                        </div>
                    </div>
                </div>
                <div class="leaflet-popup-tip-container">
                    <div class="leaflet-popup-tip"></div>
                </div><a class="leaflet-popup-close-button" role="button" aria-label="Close popup" href="#close"><span
                        aria-hidden="true">×</span></a>
            </div>
        </div>
        <div class="leaflet-proxy leaflet-zoom-animated"
            style="transform: translate3d(617794px, 788244px, 0px) scale(4096);"></div>
    </div>
    <div class="leaflet-control-container">
        <div class="leaflet-top leaflet-left">
            <div class="leaflet-control-zoom leaflet-bar leaflet-control"><a class="leaflet-control-zoom-in"
                    href="#" title="Zoom in" role="button" aria-label="Zoom in" aria-disabled="false"><span
                        aria-hidden="true">+</span></a><a class="leaflet-control-zoom-out" href="#"
                    title="Zoom out" role="button" aria-label="Zoom out" aria-disabled="false"><span
                        aria-hidden="true">−</span></a></div>
        </div>
        <div class="leaflet-top leaflet-right"></div>
        <div class="leaflet-bottom leaflet-left"></div>
        <div class="leaflet-bottom leaflet-right">
            <div class="leaflet-control-attribution leaflet-control"><a href="https://leafletjs.com"
                    title="A JavaScript library for interactive maps"><svg aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8"
                        class="leaflet-attribution-flag">
                        <path fill="#4C7BE1" d="M0 0h12v4H0z"></path>
                        <path fill="#FFD500" d="M0 4h12v3H0z"></path>
                        <path fill="#E0BC00" d="M0 7h12v1H0z"></path>
                    </svg> Leaflet</a> <span aria-hidden="true">|</span> <a href="https://www.maptiler.com/copyright/"
                    target="_blank">© MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">©
                    OpenStreetMap
                    contributors</a></div>
        </div>
    </div>
</div>
@push('css_vendor')
    <link rel="stylesheet" href="https://finder.createx.studio/vendor/leaflet/dist/leaflet.css">
@endpush
@push('js_vendor')
    <script src="https://finder.createx.studio/vendor/leaflet/dist/leaflet.js"></script>
@endpush
