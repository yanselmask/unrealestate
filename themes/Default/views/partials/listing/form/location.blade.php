 <section class="card card-body mb-4 border-0 p-4 shadow-sm" id="location">
     <h2 class="h4 mb-4">
         <i class="fi-map-pin text-primary fs-5 mt-n1 me-2"></i>{{ __('Location') }}
     </h2>
     <div class="row">
         <div class="mb-3">
             <label class="form-label" for="address_box">{{ __('Street address') }} <span
                     class="text-danger">*</span></label>
             <input name="address" class="form-control" type="text" id="address_box"
                 value="{{ old('address', $property->address) }}" required>
         </div>
     </div>
     <div class="row">
         <div class="col-sm-6 mb-3">
             <label class="form-label" for="ap-country">{{ __('Country / region') }} <span
                     class="text-danger">*</span></label>
             <input name="country" id="ap-country" type="text" class="form-control"
                 value="{{ old('country', $property->country) }}">
         </div>
         <div class="col-sm-6 mb-3">
             <label class="form-label" for="ap-city">{{ __('City') }} <span class="text-danger">*</span></label>
             <input name="city" id="ap-city" type="text" class="form-control"
                 value="{{ old('city', $property->city) }}">
         </div>
     </div>
     <div class="row">
         <div class="col-sm-8 mb-3">
             <label class="form-label" for="ap-state">{{ __('State') }} <span class="text-danger">*</span></label>
             <input name="state" id="ap-state" type="text" class="form-control"
                 value="{{ old('state', $property->state) }}">
         </div>
         <div class="col-sm-4 mb-3">
             <label class="form-label" for="ap-zip">{{ __('Zip code') }} <span class="text-danger">*</span></label>
             <input name="zip_code" class="form-control" type="text" id="ap-zip"
                 placeholder="{{ __('Enter Zip code') }}" value="{{ old('zip_code', $property->zip_code) }}" required>
         </div>
     </div>
     {{-- @include('partials.listing.form.map') --}}
 </section>
