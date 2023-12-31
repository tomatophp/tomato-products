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
            <x-tomato-admin-rich class="col-span-2" v-if="form.form_lang === 'ar'" :label="__('Description [AR]')" name="description.ar" :placeholder="__('Description [AR]')" />
            <x-tomato-admin-rich class="col-span-2" v-if="form.form_lang === 'en'" :label="__('Description [EN]')" name="description.en" :placeholder="__('Description [EN]')" />
            <x-tomato-admin-rich class="col-span-2" v-if="form.form_lang === 'ar'" :label="__('Details [AR]')" name="details.ar" :placeholder="__('Details [AR]')" />
            <x-tomato-admin-rich class="col-span-2" v-if="form.form_lang === 'en'" :label="__('Details [EN]')" name="details.en" :placeholder="__('Details [EN]')" />
            <x-splade-textarea class="col-span-2" v-if="form.form_lang === 'ar'" :label="__('Keywords [AR]')" name="keywords.ar" :placeholder="__('Keywords [AR]')" />
            <x-splade-textarea class="col-span-2" v-if="form.form_lang === 'en'" :label="__('Keywords [EN]')" name="keywords.en" :placeholder="__('Keywords [EN]')" />

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
            <x-tomato-admin-button type="button" @click.prevent="form.form_lang === 'ar' ? form.form_lang = 'en' : form.form_lang = 'ar'">
                @{{ form.form_lang }}
            </x-tomato-admin-button>
            <x-tomato-admin-button secondary @click.prevent="modal.close" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
