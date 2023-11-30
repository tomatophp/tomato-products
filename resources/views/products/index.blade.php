<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Product') }}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button :modal="true" :href="route('admin.products.create')" type="link">
            {{trans('tomato-admin::global.crud.create-new')}} {{__('Product')}}
        </x-tomato-admin-button>
    </x-slot:buttons>

    <div class="pb-12">
        <div class="mx-auto">
            <x-splade-table :for="$table" striped custom-body custom-body-view="tomato-products::products.list">
                <x-slot:actions>
                    <x-tomato-admin-table-action secondary icon="bx bx-package" href="{{route('admin.products.options.index')}}" label="{{__('Product Options')}}" />
                    <x-tomato-admin-table-action secondary icon="bx bx-category" href="{{route('admin.products.category.index')}}" label="{{__('Product Categories')}}" />
                    <x-tomato-admin-table-action secondary icon="bx bx-tag" href="{{route('admin.products.tags.index')}}" label="{{__('Product Tags')}}" />
                    <x-tomato-admin-table-action secondary icon="bx bxl-apple" href="{{route('admin.products.brands.index')}}" label="{{__('Product Brands')}}" />
                    <x-tomato-admin-table-action secondary icon="bx bx-font-size" href="{{route('admin.products.units.index')}}" label="{{__('Product Units')}}" />
                </x-slot:actions>
            </x-splade-table>
        </div>
    </div>
</x-tomato-admin-layout>
