<x-tomato-admin-container :label="__('Attach Category')">
    <x-splade-form :default="['ids'=> $ids]" class="grid grid-cols-1 gap-4" method="POST" action="{{route('admin.products.category.attach.store')}}">

        <x-splade-select
            name="category_id"
            :label="__('Category')"
            :placeholder="__('Category')"
            remote-root="data"
            remote-url="{{route('admin.categories.api') . '?for=product-categories'}}"
            option-label="name.{{app()->getLocale()}}"
            option-value="id"
            choices
        />

        <div class="flex justify-start gap-4">
            <x-tomato-admin-submit spinner :label="__('Save')" />
            <x-tomato-admin-button secondary @click.prevent="modal.close" :label="__('Cancel')" />
        </div>
    </x-splade-form>
</x-tomato-admin-container>
