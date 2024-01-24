<x-tomato-admin-container :label="isset($item) ? __('Update Category') : __('Add Category')">
    <x-splade-form class="grid grid-cols-1 gap-4" method="POST" action="{{route('admin.products.category.store')}}" :default="isset($item) ? $item : ['activated' => true, 'name' => ['ar' => '', 'en'=> '']]">
        <x-splade-file filepond preview name="image" label="{{__('Image')}}" />

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

        <div class="flex justify-start gap-4">
            <x-tomato-admin-submit spinner :label="__('Save')" />
            @isset($item)
            <x-tomato-admin-button danger :href="route('admin.products.category.delete', $item->id)"
                                   confirm="{{trans('tomato-admin::global.crud.delete-confirm')}}"
                                   confirm-text="{{trans('tomato-admin::global.crud.delete-confirm-text')}}"
                                   confirm-button="{{trans('tomato-admin::global.crud.delete-confirm-button')}}"
                                   cancel-button="{{trans('tomato-admin::global.crud.delete-confirm-cancel-button')}}"
                                   method="delete"  label="{{__('Delete')}}" />
            @endif
            <x-tomato-admin-button secondary @click.prevent="modal.close" :label="__('Cancel')" />
        </div>
    </x-splade-form>
</x-tomato-admin-container>
