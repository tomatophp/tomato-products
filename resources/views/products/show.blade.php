<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('products')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <x-tomato-admin-row :label="__('Name')" :value="$model->name" type="text" />
          <x-tomato-admin-row :label="__('Slug')" :value="$model->slug" type="text" />
          <x-tomato-admin-row :label="__('Sku')" :value="$model->sku" type="text" />
          <x-tomato-admin-row :label="__('Barcode')" :value="$model->barcode" type="text" />
          <x-tomato-admin-row :label="__('Type')" :value="$model->type" type="text" />
          <x-tomato-admin-row :label="__('About')" :value="$model->about" type="text" />
          <x-tomato-admin-row :label="__('Price')" :value="$model->price" type="number" />
          <x-tomato-admin-row :label="__('Discount')" :value="$model->discount" type="number" />
          <x-tomato-admin-row :label="__('Discount to')" :value="$model->discount_to" type="text" />
          <x-tomato-admin-row :label="__('Vat')" :value="$model->vat" type="number" />
          <x-tomato-admin-row :label="__('Description')" :value="$model->description" type="rich" />
          <x-tomato-admin-row :label="__('Details')" :value="$model->details" type="rich" />
          <x-tomato-admin-row :label="__('Main Category')" :value="$model->category->name" type="text" />
          <x-tomato-admin-row :label="__('Is shipped')" :value="$model->is_shipped" type="bool" />
          <x-tomato-admin-row :label="__('Is activated')" :value="$model->is_activated" type="bool" />
          <x-tomato-admin-row :label="__('Is trend')" :value="$model->is_trend" type="bool" />
          <x-tomato-admin-row :label="__('Is in stock')" :value="$model->is_in_stock" type="bool" />
          <x-tomato-admin-row :label="__('Has options')" :value="$model->has_options" type="bool" />
          <x-tomato-admin-row :label="__('Has multi price')" :value="$model->has_multi_price" type="bool" />
          <x-tomato-admin-row :label="__('Has unlimited stock')" :value="$model->has_unlimited_stock" type="bool" />
          <x-tomato-admin-row :label="__('Has max cart')" :value="$model->has_max_cart" type="bool" />
          <x-tomato-admin-row :label="__('Min cart')" :value="$model->min_cart" type="number" />
          <x-tomato-admin-row :label="__('Max cart')" :value="$model->max_cart" type="number" />
          <x-tomato-admin-row :label="__('Has Stock alert')" :value="$model->has_stock_alert" type="bool" />
          <x-tomato-admin-row :label="__('Min Stock alert')" :value="$model->min_stock_alert" type="number" />
          <x-tomato-admin-row :label="__('Max Stock alert')" :value="$model->max_stock_alert" type="number" />

    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button warning label="{{__('Edit')}}" :href="route('admin.products.edit', $model->id)"/>
        <x-tomato-admin-button danger :href="route('admin.products.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.products.index')" label="{{__('Cancel')}}"/>
    </div>

    <x-tomato-admin-relations-group :relations="['productReviews' => __('Product Reviews')]">
        <x-tomato-admin-relations
            name="productReviews"
            :model="$model"
            :table="\Modules\TomatoProducts\Tables\ProductReviewTable::class"
            view="tomato-products::product-reviews.index"
        ></x-tomato-admin-relations>
    </x-tomato-admin-relations-group>
</x-tomato-admin-container>
