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
        <x-splade-input  v-if="form.form_lang === 'en'" :label="__('Name [EN]')" name="name.en" @input="form.slug = form.name?.en.replaceAll(' ', '-').toLowerCase()" type="text"  :placeholder="__('Name [EN]')" />
        <x-splade-input  v-if="form.form_lang === 'ar'" :label="__('Name [AR]')" name="name.ar" @input="form.slug = form.name?.ar.replaceAll(' ', '-').toLowerCase()" type="text"  :placeholder="__('Name [AR]')" />
        <x-splade-input  :label="__('Slug')" name="slug" type="text"  :placeholder="__('Slug')" />
        <x-splade-textarea class="col-span-2" autosize v-if="form.form_lang === 'en'" :label="__('About [EN]')" :placeholder="__('About [EN]')" name="about.en" type='text' />
        <x-splade-textarea class="col-span-2" autosize v-if="form.form_lang === 'ar'" :label="__('About [AR]')" :placeholder="__('About [AR]')" name="about.ar" type='text' />
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
