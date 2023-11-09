<x-tomato-admin-container :label="isset($item) ? __('Update Category') : __('Add Category')">
    <x-splade-form method="POST" action="{{route('admin.products.category.store')}}" :default="isset($item) ? $item : ['activated' => true, 'name' => ['ar' => '', 'en'=> '']]">
        <div class="py-4 grid grid-cols-1 gap-4">
            <x-splade-select
                name="parent_id"
                :label="__('Parent')"
                :placeholder="__('Parent')"
                remote-root="data"
                remote-url="{{route('admin.categories.api') . '?for=product-categories'}}"
                option-label="name.{{app()->getLocale()}}"
                option-value="id"
                choices
            />
            <x-splade-input label="{{__('Name [AR]')}}" placeholder="{{__('Name [AR]')}}"  @input="form.slug = form.name?.ar.replaceAll(' ', '-').toLowerCase()" name="name.ar" />
            <x-splade-input label="{{__('Name [EN]')}}" placeholder="{{__('Name [EN]')}}"  @input="form.slug = form.name?.en.replaceAll(' ', '-').toLowerCase()" name="name.en" />
            <x-splade-input label="{{__('Slug')}}" placeholder="{{__('Slug')}}" name="slug" />
            <div class="flex justify-between gap-4">
                <x-splade-input class="w-full" label="{{__('Icon')}}" placeholder="{{__('Icon')}}" name="icon" />
                <x-tomato-admin-color  label="{{__('Color')}}" placeholder="{{__('Color')}}" name="color" />
            </div>
            <div class="flex justify-between gap-4">
                <x-splade-checkbox class="w-full" label="{{__('Activated')}}"  name="activated" />
                <x-splade-checkbox class="w-full" label="{{__('Show In Menu')}}" name="menu" />
            </div>
        </div>

        <div class="flex justify-start gap-4">
            <x-tomato-admin-submit spinner :label="__('Save')" />
            <x-tomato-admin-button secondary @click.prevent="modal.close" :label="__('Cancel')" />
        </div>
    </x-splade-form>
</x-tomato-admin-container>
