<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.edit')}} {{__('Product')}} #{{$model->id}}">

    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.products.update', $model->id)}}" method="post" :default="array_merge($model->toArray(), ['form_lang'=>app()->getLocale()])">
        <div class="grid grid-cols-2 gap-4">

        <x-splade-select class="col-span-2" :label="__('Type')"
                         :placeholder="__('Type')"
                         name="type"
                         choices>
            <option value="product">{{__('Product')}}</option>
            <option value="digital">{{__('Digital')}}</option>
        </x-splade-select>
        <x-tomato-translation  label="{{__('Name')}}" @input="form.slug = form.name?.en.replaceAll(' ', '-').toLowerCase()" name="name" :placeholder="__('Name')" />
        <x-splade-input  :label="__('Slug')" name="slug" type="text"  :placeholder="__('Slug')" />
        <div class="col-span-2">
            <x-tomato-translation textarea label="{{__('About')}}" name="about" :placeholder="__('About')" />
        </div>
        <x-splade-input :label="__('Sku')" name="sku" type="text"  :placeholder="__('Sku')" />
        <x-splade-input :label="__('Barcode')" name="barcode" type="text"  :placeholder="__('Barcode')" />
        <x-splade-input :label="__('Price')" :placeholder="__('Price')" type='number' name="price" />
        <x-splade-input :label="__('Discount')" :placeholder="__('Discount')" type='number' name="discount" />
        <x-splade-input date time :label="__('Discount To')" :placeholder="__('Discount To')" name="discount_to" />
        <x-splade-input :label="__('Vat')" :placeholder="__('Vat')" type='number' name="vat" />
        <x-splade-checkbox :label="__('Is Activated')"  name="is_activated" />

        </div>
        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary @click.prevent="modal.close" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
