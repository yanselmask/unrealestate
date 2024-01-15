<section class="card card-body mb-4 border-0 p-4 shadow-sm" id="photos">
    <h2 class="h4 mb-4">
        <i class="fi-image text-primary fs-5 mt-n1 me-2"></i>{{ __('Photos') }}
    </h2>
    <div class="mb-3">
        <label class="form-label" for="main_image">{{ __('Main Image') }}</label>
        <input id="main_image" class="rounded border" name="main_image">
    </div>
    <div class="mb-3">
        <label class="form-label" for="gallery">{{ __('Gallery') }}</label>
        <input id="gallery" class="rounded border" name="gallery[]">
    </div>
</section>
<x-slot name="js_vendor">
    <script>
        let loadedGallery = () => {
            let files = [];
            let gallery = @js($property->gallery->toArray());

            gallery.forEach((image) => {
                files.push({
                    source: image.original_url,
                    options: {
                        type: 'local'
                    }
                })
            })

            return files;
        }
        let loadedMain = () => {
            let files = [];
            let main = @js($property->main_image ? Storage::url($property->main_image) : null);

            if (main) {
                return [{
                    source: main,
                    options: {
                        type: 'local'
                    }
                }]
            }


            return [];
        }
        // Create a FilePond instance
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        let mainImageEl = document.getElementById('main_image');
        let galleryEl = document.getElementById('gallery');
        let optsMain = FilePond.setOptions({
            headers: {
                "X-CSRF-TOKEN": @js(csrf_token())
            },
            files: loadedMain(),
            acceptedFileTypes: ['image/*'],
            server: {
                headers: {
                    "X-CSRF-TOKEN": @js(csrf_token())
                },
                revert: async (uniqueFileId, load, error) => {
                    // Should remove the earlier created temp file here
                    // ...
                    let url = @js(route('home.listing.removefile'));
                    let formData = new FormData();
                    formData.append('_method', 'delete');
                    formData.append('uniqueFileId', uniqueFileId);

                    let req = await fetch(url, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": @js(csrf_token())
                        },
                        body: formData
                    });
                    let res = await req.json();
                    if (res.status == 1) {
                        load()
                    }
                },
                process: @js(route('home.listing.uploadfile')),
                load: (source, load, error, progress, abort, headers) => {
                    const myRequest = new Request(source);
                    fetch(myRequest).then(function(response) {
                        response.blob().then(function(blob) {
                            load(blob)
                        });
                    });
                },
            }
        });
        let optsGallery = FilePond.setOptions({
            headers: {
                "X-CSRF-TOKEN": @js(csrf_token())
            },
            acceptedFileTypes: ['image/*'],
            allowMultiple: true,
            allowReorder: true,
            maxFiles: 10,
            files: loadedGallery(),
            server: {
                headers: {
                    "X-CSRF-TOKEN": @js(csrf_token())
                },
                process: @js(route('home.listing.uploadfile')),
                load: (source, load, error, progress, abort, headers) => {
                    const myRequest = new Request(source);
                    fetch(myRequest).then(function(response) {
                        response.blob().then(function(blob) {
                            load(blob)
                        });
                    });
                },
            }
        });
        const mainImage = FilePond.create(mainImageEl, optsMain);
        const gallery = FilePond.create(galleryEl, optsGallery);
    </script>
</x-slot>
