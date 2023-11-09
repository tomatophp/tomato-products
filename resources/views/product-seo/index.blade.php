<x-tomato-admin-container label="{{__('Update Product SEO')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.products.update', $model->id)}}" method="post" :default="array_merge($model->toArray(),[
        'form_lang' => app()->getLocale()
    ])">
        <div class="grid grid-cols-2 gap-4">
            <x-tomato-admin-rich class="col-span-2" v-if="form.form_lang === 'ar'" :label="__('Description [AR]')" name="description.ar" :placeholder="__('Description [AR]')" />
            <x-tomato-admin-rich class="col-span-2" v-if="form.form_lang === 'en'" :label="__('Description [EN]')" name="description.en" :placeholder="__('Description [EN]')" />
            <x-tomato-admin-rich class="col-span-2" v-if="form.form_lang === 'ar'" :label="__('Details [AR]')" name="details.ar" :placeholder="__('Details [AR]')" />
            <x-tomato-admin-rich class="col-span-2" v-if="form.form_lang === 'en'" :label="__('Details [EN]')" name="details.en" :placeholder="__('Details [EN]')" />
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
            <x-tomato-admin-button warning type="link" :href="route('admin.products.category.index')" label="{{__('Add Categories')}}"/>
            <x-tomato-admin-button warning type="link" :href="route('admin.products.tags.index')" label="{{__('Add Tags')}}"/>
            <x-tomato-admin-button warning type="link" :href="route('admin.products.brands.index')" label="{{__('Add Brands')}}"/>
            <x-tomato-admin-button secondary @click.prevent="modal.close" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
