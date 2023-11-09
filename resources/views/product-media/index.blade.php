<x-tomato-admin-container label="{{__('Update Product Media')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.products.update', $model->id)}}" method="post" :default="$model->toArray()">
        <x-splade-file class="col-span-2" multiple filepond name="images[]" :label="__('Images')"/>
        <x-splade-file class="col-span-2" preview filepond name="featured_image" :label="__('Featured Image')"/>
        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button secondary @click.prevent="modal.close" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
