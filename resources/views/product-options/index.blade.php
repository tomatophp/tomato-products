<x-tomato-admin-container label="{{__('Products Options')}}">
    <x-slot:buttons>
        <x-tomato-admin-button warning type="link" :modal="true" :href="route('admin.products.index')">
            {{__('Back')}}
        </x-tomato-admin-button>
        <x-tomato-admin-button type="link" :modal="true" :href="route('admin.products.options.create', 'type')">
            {{__('Add Option')}}
        </x-tomato-admin-button>
    </x-slot:buttons>
    <div class="flex flex-col gap-4">
        @php $options = \TomatoPHP\TomatoCategory\Models\Type::where('for', 'product-options')->where('type', 'type')->get(); @endphp
        @if(count($options))
        @foreach($options as $type)
            <div class="text-lg font-bold flex justify-between gap-4">
                <div class="flex flex-col items-center justify-center">
                    {{$type->name}}
                </div>
                <div class="flex justifiy-start gap-4">
                    <x-tomato-admin-button type="link" :modal="true" :href="route('admin.products.options.create', $type->key)">
                        {{__('Add') . ' ' . $type->name}}
                    </x-tomato-admin-button>
                    <x-tomato-admin-button danger type="link" method="DELETE" confirm :href="route('admin.products.options.delete',  $type->id)">
                        {{__('Delete') . ' ' . $type->name}}
                    </x-tomato-admin-button>
                </div>
            </div>
            <x-splade-table :for="(new \TomatoPHP\TomatoCategory\Tables\TypeTable(\TomatoPHP\TomatoCategory\Models\Type::query()->where('for', 'product-options')->where('type', $type->key), false))">
                <x-splade-cell color>
                    <x-tomato-admin-row table type="color" :value="$item->color" />
                </x-splade-cell>
                <x-splade-cell icon>
                    <x-tomato-admin-row table type="icon" :value="$item->icon" />
                </x-splade-cell>
                <x-splade-cell actions use="$type">
                    <div class="flex justify-start">
                        <div class="flex justify-start">
                            <x-tomato-admin-button type="icon" warning modal title="{{trans('tomato-admin::global.crud.edit')}}" href="{{ route('admin.products.options.edit', ['type' => $type->key, 'item'=> $item->id]) }}">
                                <x-heroicon-s-pencil class="h-6 w-6"/>
                            </x-tomato-admin-button>

                            <x-tomato-admin-button type="icon" title="{{trans('tomato-admin::global.crud.delete')}}" href="{{ route('admin.products.options.delete', ['type' => $type->type, 'item' => $item->id]) }}"
                                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                                   class="px-2 text-red-500"
                                                   method="delete"

                            >
                                <x-heroicon-s-trash class="h-6 w-6"/>
                            </x-tomato-admin-button>
                        </div>
                    </div>
                </x-splade-cell>
            </x-splade-table>

        @endforeach
        @else
            <div class="bg-white rounded-lg mt-4">
                <div class="whitespace-nowrap">
                    <p class="text-gray-700 px-6 py-12 font-medium text-sm text-center">
                        {{ __('There are no items to show.') }}
                    </p>
                </div>
            </div>
        @endif
    </div>
</x-tomato-admin-container>
