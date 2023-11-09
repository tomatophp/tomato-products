<x-tomato-admin-container label="{{__('Update Product Alerts')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.products.update', $model->id)}}" method="post" :default="$model->toArray()">
        <x-splade-checkbox :label="__('Has Stock Alert')" name="has_stock_alert"  />
        <div v-if="form.has_stock_alert" class="col-span-2 grid grid-cols-2 gap-4">
            <x-splade-input v-if="form.has_stock_alert" :label="__('Max Stock Alert')" :placeholder="__('Max Stock Alert')" type='number' name="max_stock_alert" />
            <x-splade-input v-if="form.has_stock_alert" :label="__('Min Stock Alert')" :placeholder="__('Min Stock Alert')" type='number' name="min_stock_alert" />
        </div>
        <x-splade-checkbox :label="__('Has Max Cart By Order')" name="has_max_cart"  />
        <div v-if="form.has_max_cart" class="col-span-2 grid grid-cols-2 gap-4">
            <x-splade-input  :label="__('Max Cart By Order')" :placeholder="__('Max Cart By Order')" type='number' name="max_cart" />
            <x-splade-input  :label="__('Min Cart By Order')" :placeholder="__('Min Cart By Order')" type='number' name="min_cart" />
        </div>


        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary @click.prevent="modal.close" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
