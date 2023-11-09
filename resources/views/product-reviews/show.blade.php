<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.view')}} {{__('product-reviews')}} #{{$model->id}}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <x-tomato-admin-row :label="__('Product id')" :value="$model->product_id" type="text" />

          <x-tomato-admin-row :label="__('Account id')" :value="$model->account_id" type="number" />

          <x-tomato-admin-row :label="__('Rate')" :value="$model->rate" type="number" />

          <x-tomato-admin-row :label="__('Review')" :value="$model->review" type="text" />

          <x-tomato-admin-row :label="__('Is activated')" :value="$model->is_activated" type="bool" />


    </div>
    <div class="flex justify-start gap-2 pt-3">
        <x-tomato-admin-button danger :href="route('admin.product-reviews.destroy', $model->id)"
                               confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                               confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                               confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                               cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                               method="delete"  label="{{__('Delete')}}" />
        <x-tomato-admin-button secondary :href="route('admin.products.show', $model->product_id)" label="{{__('Cancel')}}"/>
    </div>
</x-tomato-admin-container>
