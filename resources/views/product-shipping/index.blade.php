<x-tomato-admin-container label="{{__('Update Product Shipping Info')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.products.update', $model->id)}}" method="post" :default="array_merge($model->toArray(), [
        'unit' => $model->meta('unit'),
        'weight' => $model->meta('weight'),
    ])">
        <x-splade-checkbox :label="__('Is shipped')" name="is_shipped"  />
        <x-splade-select :label="__('Unit')"
                         :placeholder="__('Unit')"
                         name="unit"
                         remote-url="/admin/types/api?for=products&type=units"
                         remote-root="data"
                         option-label="name.{{app()->getLocale()}}"
                         option-value="key"
                         choices/>
        <x-splade-input :label="__('Weight')" :placeholder="__('Weight')" type='number' name="weight" />
        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary @click.prevent="modal.close" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
