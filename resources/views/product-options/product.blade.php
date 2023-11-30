<x-tomato-admin-container label="{{__('Update Product Options')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.products.update', $model->id)}}" method="post" :default="$model->toArray()">
        <x-splade-checkbox :label="__('Has options')" name="has_options"  />
        <div v-if="form.has_options" class="col-span-2 flex flex-col gap-4">
            <x-splade-defer
                url="{{route('admin.products.options.mix')}}"
                method="post"
                request="{ options: form.options }"
                watch-value="form.options"
            >
                @foreach($types as $key=>$type)
                    <x-splade-select :label="$type->name"
                                     :placeholder="$type->name"
                                     name="options.{{$type->key}}"
                                     :options="\TomatoPHP\TomatoCategory\Models\Type::where('for', 'product-options')->where('type', $type->key)->get()"
                                     option-label="name"
                                     option-value="key"
                                     @change="data.items['{{$type->key}}'] = $event.detail.value"
                                     multiple
                                     choices/>
                @endforeach
                <div class="w-full flex flex-col gap-4">
                    <div v-for="(item, key) in response">
                        <x-splade-toggle>
                            <button :class="{'bg-primary-200  rounded-t-lg ' : toggled , 'bg-gray-100  rounded-lg ' : !toggled}" class="flex justify-between gap-4 p-4 w-full" @click.prevent="toggle">
                                <div class="flex justify-start gap-2">
                                    <div class="flex flex-col justify-center items-center">
                                        <i class="bx bxs-plus-square"></i>
                                    </div>
                                    <div>
                                                <span class="text-lg" v-if="Array.isArray(item)" v-for="(option, index) in item">
                                                    @{{ option }}<span v-if="index != item.length-1">/</span>
                                                </span>
                                        <span  class="text-lg" v-else>
                                                    @{{ item }}
                                                </span>
                                    </div>
                                </div>
                                <div class="flex flex-col justify-center items-center">
                                    <div class="flex justify-start gap-2">
                                        <span class="font-bold">{{__('Total QTY: ')}}</span>
                                        <span>@{{ form.qty[item.toString()+',qty'] ?? 0 }}</span>
                                    </div>
                                </div>
                            </button>
                            <div class="border border-primary-200 grid grid-cols-4 gap-4 p-4 rounded-b-lg" v-show="toggled">
                                <x-splade-input label="{{__('Price')}}" v-model="form.qty[item.toString()+',price']" class="col-span-4" :placeholder="__('Price')" type="number" />
                                <x-splade-input label="{{__('Discount')}}" v-model="form.qty[item.toString()+',discount']" class="col-span-2" :placeholder="__('Discount')" type="number" />
                                <x-splade-input label="{{__('Discount To')}}" date time v-model="form.qty[item.toString()+',discount_to']" class="col-span-2" :placeholder="__('Discount To')" type="number" />
                                <x-splade-input label="{{__('Vat')}}" v-model="form.qty[item.toString()+',vat']" :placeholder="__('Vat')" type="number" />
                                <x-splade-input label="{{__('Stock QTY')}}" v-model="form.qty[item.toString()+',qty']" :placeholder="__('QTY')" type="number" />
                                <x-splade-input label="{{__('Max Alert')}}" v-model="form.qty[item.toString()+',max_alert']" :placeholder="__('Max Alert')" type="number" />
                                <x-splade-input label="{{__('Min Alert')}}" v-model="form.qty[item.toString()+',min_alert']" :placeholder="__('Min Alert')" type="number" />
                            </div>
                        </x-splade-toggle>
                    </div>
                </div>
            </x-splade-defer>
        </div>
        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary @click.prevent="modal.close" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
