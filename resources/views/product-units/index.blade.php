<x-tomato-admin-container label="{{__('Products Units')}}">
    <x-slot:buttons>
        <x-tomato-admin-button warning type="link" :modal="true" :href="route('admin.products.index')">
            {{__('Back')}}
        </x-tomato-admin-button>
        <x-tomato-admin-button type="link" :modal="true" :href="route('admin.products.units.create')">
            {{__('Add Unit')}}
        </x-tomato-admin-button>
    </x-slot:buttons>
    <div class="flex flex-col gap-4">
        @php $options = \TomatoPHP\TomatoCategory\Models\Type::where('for', 'products')->where('type', 'units')->get(); @endphp
        @if(count($options))
            <x-splade-table :for="(new \TomatoPHP\TomatoCategory\Tables\TypeTable(\TomatoPHP\TomatoCategory\Models\Type::query()->where('for', 'products')->where('type', 'units')))">
                <x-splade-cell color>
                    <x-tomato-admin-row table type="color" :value="$item->color" />
                </x-splade-cell>
                <x-splade-cell icon>
                    <x-tomato-admin-row table type="icon" :value="$item->icon" />
                </x-splade-cell>
                <x-splade-cell actions>
                    <div class="flex justify-start">
                        <div class="flex justify-start">
                            <x-tomato-admin-button type="icon" warning modal title="{{trans('tomato-admin::global.crud.edit')}}" href="{{ route('admin.products.units.edit',$item->id) }}">
                                <x-heroicon-s-pencil class="h-6 w-6"/>
                            </x-tomato-admin-button>

                            <x-tomato-admin-button type="icon" title="{{trans('tomato-admin::global.crud.delete')}}" href="{{ route('admin.products.units.delete', $item->id) }}"
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
