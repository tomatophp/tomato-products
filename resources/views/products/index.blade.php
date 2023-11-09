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

            </x-splade-table>
        </div>
    </div>
</x-tomato-admin-layout>
