<section class="card card-body mb-4 border-0 p-4 shadow-sm" id="price" x-data="{
    fieldsReady: @js($property->prices ?? []),
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
    <div class="row">
        <!-- Addons on both sides -->
        @foreach (currency()->getCurrencies() as $currency)
            <div class="col-md-4">
                <label class="form-label" for="ap-price-{{ $currency['id'] }}">
                    {{ $currency['name'] }} <span class="text-danger">*</span>
                </label>
                <div class="input-group">
                    <span class="input-group-text fs-lg py-1">{{ $currency['symbol'] }}</span>
                    <input type="text" name="price[{{ $currency['id'] }}]" class="form-control currency"
                        placeholder="{{ __('Amount') }}"
                        value="{{ old('price.' . $currency['id'], price_value($property->id, $currency['id'])) }}"
                        id="ap-price-{{ $currency['id'] }}">
                    <span class="input-group-text">.00</span>
                </div>
            </div>
        @endforeach
    </div>
</section>

@push('js_vendor')
    <script>
        let currencies = document.querySelectorAll('.currency');
        currencies.forEach((input) => {
            let cleave = new Cleave(input, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        })
    </script>
@endpush
