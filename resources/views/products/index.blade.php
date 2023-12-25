<x-tomato-admin-layout>
    <x-slot:header>
        {{ __('Product') }}
    </x-slot:header>
    <x-slot:buttons>
        <x-tomato-admin-button :modal="true" :href="route('admin.products.create')" type="link">
            {{trans('tomato-admin::global.crud.create-new')}} {{__('Product')}}
        </x-tomato-admin-button>
        <x-tomato-admin-button warning :modal="true" :href="route('admin.products.import')" type="link">
            <x-tomato-admin-tooltip :text="__('Import Products')">
                <i class="bx bx-import"></i>
            </x-tomato-admin-tooltip>
        </x-tomato-admin-button>
    </x-slot:buttons>

    <div class="pb-12">
        <div class="mx-auto">
            <x-splade-table :for="$table" striped custom-body custom-body-view="tomato-products::products.list">
                <x-slot:header>
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-3">
                        @foreach($categories as $category)
                            <div class="relative border border-gray-200 dark:bg-gray-800 dark:border-gray-700 p-4 rounded-lg bg-white @if(isset(request()->get('filter')['category_id']) && request()->get('filter')['category_id'] == $category->id) ring-2 ring-primary-500 @endif">
                                <x-splade-link :href="route('admin.products.category.edit', $category->id)" modal class="absolute top-3 rtl:right-3 ltr:left-3 text-warning-500">
                                    <i class="bx bx-edit"></i>
                                </x-splade-link>

                                <div @click.prevent="table.updateQuery('filter[category_id]', @js($category->id))" class="flex flex-col items-center justify-center cursor-pointer">
                                    @if($category->getMedia('image')->first())
                                        <div class="bg-cover w-16 h-16 bg-center rounded-full border-gray-200 dark:border-gray-700" style="background-image: url('{{$category->getMedia('image')->first()?->getUrl()}}')">

                                        </div>
                                    @elseif($category->icon)
                                        <div class="w-16 h-16 flex flex-col items-center justify-center">
                                            <i class="{{$category->icon}} bx-lg" style="color: {{$category->color}}"></i>
                                        </div>
                                    @else
                                        <div class="w-16 h-16 flex flex-col items-center justify-center">
                                            <i class="bx bxs-category bx-lg text-primary-500"></i>
                                        </div>
                                    @endif

                                    <h1 class="font-bold text-2xl">{{$category->name}}</h1>
                                    <h1 class="text-gray-400 text-sm">{{\TomatoPHP\TomatoProducts\Models\Product::where('category_id', $category->id)->count()}} {{__('Product')}}</h1>
                                </div>
                            </div>
                        @endforeach
                        <x-splade-link modal :href="route('admin.products.category.create')" class="border border-gray-200 dark:border-gray-700 px-4 py-8 rounded-lg bg-primary-500 text-white flex flex-col items-center justify-center">
                            <i class="bx bx-plus-circle bx-lg"></i>
                            <h1 class="font-bold text-xl">{{__('Create Category')}}</h1>
                        </x-splade-link>
                    </div>
                </x-slot:header>
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
