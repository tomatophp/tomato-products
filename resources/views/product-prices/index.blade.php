<x-tomato-admin-container label="{{__('Update Product Multi Prices')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.products.update', $model->id)}}" method="post" :default="array_merge($model->toArray(), [
        'prices' => $model->meta('prices') ?? []
    ])">
        <x-splade-checkbox :label="__('Has multi price')" name="has_multi_price"  />
        <div v-if="form.has_multi_price" class="col-span-2" >
            <x-tomato-admin-repeater name="prices" :options="['type', 'qty','price', 'discount', 'discount_to', 'vat']" class="grid grid-cols-1 gap-4">
                <div class="grid gird-cols-4 gap-4">
                    <x-splade-select choices class="col-span-4" v-model="repeater.main[key].type">
                        <option value="web">{{__('Website')}}</option>
                        <option value="mobile">{{__('Mobile')}}</option>
                        <option value="pos">{{__('POS')}}</option>
                        <option value="items">{{__('Items')}}</option>
                    </x-splade-select>
                    <x-splade-input class="col-span-4" v-if="repeater.main[key].type === 'items'" v-model="repeater.main[key].qty" type="number" label="{{__('QTY')}}" placeholder="{{__('QTY')}}" />
                    <x-splade-input v-model="repeater.main[key].price" type="number" label="{{__('Price')}}" placeholder="{{__('Price')}}" />
                    <x-splade-input v-model="repeater.main[key].discount" type="number" label="{{__('Discount')}}" placeholder="{{__('Discount')}}" />
                    <x-splade-input date time v-model="repeater.main[key].discount_to" label="{{__('Discount To')}}" placeholder="{{__('Discount To')}}" />
                    <x-splade-input v-model="repeater.main[key].vat" type="number" label="{{__('Vat')}}" placeholder="{{__('Vat')}}" />
                </div>
            </x-tomato-admin-repeater>
        </div>
        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary @click.prevent="modal.close" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
