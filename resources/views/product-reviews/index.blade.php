<x-splade-table :for="$query" striped v-if="data.tab === '{{$name}}'">
<x-splade-cell rate>
        <x-tomato-admin-row table type="number" :value="$item->rate" />
    </x-splade-cell>
    <x-splade-cell is_activated>
        <x-tomato-admin-row table type="bool" :value="$item->is_activated" />
    </x-splade-cell>
    <x-splade-cell actions>
        <div class="flex justify-start">
            <x-tomato-admin-button success type="icon" title="{{trans('tomato-admin::global.crud.view')}}" modal :href="route('admin.product-reviews.show', $item->id)">
                <x-heroicon-s-eye class="h-6 w-6"/>
            </x-tomato-admin-button>
            <x-tomato-admin-button warning type="icon" title="{{trans('tomato-admin::global.crud.edit')}}" modal :href="route('admin.product-reviews.edit', $item->id)">
                <x-heroicon-s-pencil class="h-6 w-6"/>
            </x-tomato-admin-button>
            <x-tomato-admin-button danger type="icon" title="{{trans('tomato-admin::global.crud.delete')}}" :href="route('admin.product-reviews.destroy', $item->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"
            >
                <x-heroicon-s-trash class="h-6 w-6"/>
            </x-tomato-admin-button>
        </div>
    </x-splade-cell>
</x-splade-table>
