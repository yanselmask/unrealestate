<section class="card card-body mb-4 border-0 p-4 shadow-sm" id="price" x-data="{
    fieldsReady: @js($property->price ?? []),
    fields: [],
    addField() {
        this.fields.push({
            code: @js(setting('localization_default_currency')),
            price: ''
        })
    },
    removeField(index) {
        this.fields.splice(index, 1)
    },
    removeDefaultField(index) {
        this.fieldsReady.splice(index, 1)
    }
}">
    <h2 class="h4 mb-4">
        <i class="fi-cash text-primary fs-5 mt-n1 me-2"></i>{{ __('Price') }}
    </h2>
    <label class="form-label" for="ap-price">
        {{ __('Prices') }} <span class="text-danger">*</span>
    </label>
    <div class="row">
        <template x-for="(field,index) in fieldsReady" :key="index">
            <div class="col-4 mb-3">
                <div class="input-group">
                    <span class="input-group-text fs-base" x-text="field.code"></span>
                    <input :name="`price[${field.code}]`" class="form-control" type="text" :value="field.price">
                </div>
                <div class="d-flex mx-auto">
                    <button @click="removeDefaultField(index)" type="button"
                        class="btn btn-xs btn-danger d-flex mx-auto my-2">{{ __('X') }}</button>
                </div>
            </div>
        </template>
        <template x-for="(field,index) in fields" :key="index">
            <div class="row mt-2">
                <div class="col-6">
                    <span x-text="field.code"></span>
                    <label class="form-label" :for="`custom_fields_code_-${index}`">{{ __('Currency Code') }}</label>
                    <select class="form-control" id="`custom_fields_code_-${index}`" x-model="field.code">
                        @foreach (site_currencies() as $cd => $cn)
                            <option value="{{ $cd }}">{{ $cn }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <label class="form-label" :for="`custom_fields_value_price_-${index}`">{{ __('Price') }}</label>
                    <input :name="`price[${field.code}]`" type="text" class="form-control"
                        placeholder="{{ __('Price') }}" :id="`custom_fields_value_price_-${index}`"
                        x-model="field.price">
                </div>
                <div class="d-flex mx-auto">
                    <button @click="removeField(index)" type="button"
                        class="btn btn-xs btn-danger d-flex mx-auto my-2">{{ __('X') }}</button>
                </div>
            </div>
        </template>
    </div>
    <div class="row">
        <div class="col-3">
            <button @click="addField" class="btn btn-xs btn-primary my-3" type="button">{{ __('+') }}</button>
        </div>
    </div>
</section>
