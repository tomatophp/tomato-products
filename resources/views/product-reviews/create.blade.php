<x-tomato-admin-container label="{{trans('tomato-admin::global.crud.create')}} {{__('ProductReview')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.product-reviews.store')}}" method="post">
        <x-splade-select :label="__('Product id')" :placeholder="__('Product id')" name="product_id" remote-url="/admin/products/api" remote-root="data" option-label="name" option-value="id" choices/>
          <x-splade-input :label="__('Account id')" name="account_id" type="number"  :placeholder="__('Account id')" />
          <x-splade-input :label="__('Rate')" name="rate" type="number"  :placeholder="__('Rate')" />
          <x-splade-textarea :label="__('Review')" name="review" :placeholder="__('Review')" autosize />
          <x-splade-checkbox :label="__('Is activated')" name="is_activated"  />


        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.product-reviews.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
