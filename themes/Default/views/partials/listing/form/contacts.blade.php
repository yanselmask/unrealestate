<section class="card card-body mb-4 border-0 p-4 shadow-sm" id="contacts" x-data="{
    fieldReady: @js($property->contact ?? []),
    fields: [],
    addField() {
        this.fields.push({
            key: '',
            value: ''
        })
    },
    removeField(index) {
        this.fields.splice(index, 1);
    },
    removeDefaultField(index) {
        this.fieldReady.splice(index, 1);
    }
}">
    <h2 class="h4 mb-4"><i class="fi-phone text-primary fs-5 mt-n1 me-2"></i>{{ __('Contacts') }}</h2>
    <div class="row">
        <template x-for="(field,index) in fieldReady" :key="index">
            <div class="col-sm-6 mb-3">
                <label class="form-label" x-text="field.key" :for="`field-${index}`"></label>
                <input :name="`contact[${field.key}]`" :value="field.value" class="form-control" type="text"
                    :id="`field-${index}`" :placeholder="field.key">
                <div class="d-flex mx-auto">
                    <button @click="removeDefaultField(index)" type="button"
                        class="btn btn-xs btn-danger d-flex mx-auto my-2">{{ __('X') }}</button>
                </div>
            </div>
        </template>
    </div>
    <div>
        <template x-for="(field,index) in fields" :key="index">
            <div class="row">
                <div class="col-6">
                    <label class="form-label" :for="`custom_fields_-${index}`">{{ __('Key') }}</label>
                    <input :id="`custom_fields_-${index}`" type="text" class="form-control mb-2"
                        placeholder="{{ __('Key') }}" x-model="field.key">
                </div>
                <div class="col-6">
                    <label class="form-label" :for="`custom_fields_value_-${index}`">{{ __('Value') }}</label>
                    <input :name="`contact[${field.key}]`" type="text" class="form-control"
                        placeholder="{{ __('Value') }}" :id="`custom_fields_value_-${index}`" x-model="field.value">
                </div>
                <div class="d-flex mx-auto">
                    <button @click="removeField(index)" type="button"
                        class="btn btn-xs btn-danger d-flex mx-auto my-2">{{ __('X') }}</button>
                </div>
            </div>
        </template>
    </div>
    <div class="col-3">
        <button @click="addField" class="btn btn-xs btn-primary" type="button">{{ __('+') }}</button>
    </div>
</section>
