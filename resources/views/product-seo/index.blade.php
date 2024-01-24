<x-tomato-admin-container label="{{__('Update Product SEO')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.products.update', $model->id)}}" method="post" :default="[
        'form_lang' => app()->getLocale(),
        'description' => [
            'ar' => $model->getTranslation('description','ar') ?? '',
            'en' => $model->getTranslation('description','en') ?? '',
        ],
        'details' => [
            'ar' => $model->getTranslation('details','ar') ?? '',
            'en' => $model->getTranslation('details','en') ?? '',
        ],
        'keywords' => [
            'ar' => $model->getTranslation('keywords','ar') ?? '',
            'en' => $model->getTranslation('keywords','en') ?? '',
        ],
        'category_id' => $model->category_id,
        'categories' => $model->categories,
        'tags' => $model->tags,
        'brand' => $model->brand,
    ]">
        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-2">
                <x-tomato-translation type="rich" label="{{__('Description')}}" name="description" :placeholder="__('Description')" />
                <x-tomato-translation type="rich" label="{{__('Details')}}" name="details" :placeholder="__('Details')" />
                <x-tomato-translation textarea label="{{__('Keywords')}}" name="keywords" :placeholder="__('Keywords')" />
            </div>

            <x-splade-select :label="__('Main Category')"
                             :placeholder="__('Main Category')"
                             name="category_id"
                             remote-url="/admin/categories/api?for=product-categories"
                             remote-root="data"
                             option-label="name.{{app()->getLocale()}}"
                             option-value="id"
                             choices/>
            <x-splade-select :label="__('Categories')"
                             :placeholder="__('Categories')"
                             name="categories"
                             :options="\TomatoPHP\TomatoCategory\Models\Category::where('for', 'product-categories')->get()"
                             option-label="name"
                             option-value="id"
                             multiple
                             choices/>
            <x-splade-select :label="__('Tags')"
                             :placeholder="__('Tags')"
                             name="tags"
                             :options="\TomatoPHP\TomatoCategory\Models\Category::where('for', 'product-tags')->get()"
                             option-label="name"
                             option-value="id"
                             multiple
                             choices/>
            <x-splade-select :label="__('Brand')"
                             :placeholder="__('Brand')"
                             name="brand"
                             remote-url="/admin/types/api?for=products&type=brands"
                             remote-root="data"
                             option-label="name.{{app()->getLocale()}}"
                             option-value="id"
                             choices/>
        </div>


        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary @click.prevent="modal.close" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
