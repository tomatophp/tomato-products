<x-tomato-admin-container :label="isset($item) ? __('Update Tag') : __('Add Tag')">
    <x-splade-form method="POST" action="{{route('admin.products.tags.store')}}" :default="isset($item) ? $item : ['activated' => true, 'name' => ['ar' => '', 'en'=> '']]">
        <div class="py-4 grid grid-cols-1 gap-4">
            <x-splade-select
                name="parent_id"
                :label="__('Parent')"
                :placeholder="__('Parent')"
                remote-root="data"
                remote-url="{{route('admin.categories.api') . '?for=product-tags'}}"
                option-label="name.{{app()->getLocale()}}"
                option-value="id"
                choices
            />
            <x-tomato-translation  label="{{__('Name')}}" @input="form.slug = form.name?.en.replaceAll(' ', '-').toLowerCase()" name="name" :placeholder="__('Name')" />
            <x-splade-input label="{{__('Slug')}}" placeholder="{{__('Slug')}}" name="slug" />
            <div class="flex justify-between gap-4">
                <x-tomato-admin-icon class="w-full" label="{{__('Icon')}}" placeholder="{{__('Icon')}}" name="icon" />
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
