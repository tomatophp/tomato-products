<x-tomato-admin-container :label="isset($item) ? __('Update Unit') : __('Add Unit')">
<x-splade-form method="POST" action="{{route('admin.products.units.store')}}" :default="$item ?? []">
        <div class="py-4 grid grid-cols-1 gap-4">
            <x-tomato-translation label="{{__('Name')}}" placeholder="{{__('Name')}}" name="name" />
            <x-splade-input label="{{__('Key')}}" placeholder="{{__('Key')}}" name="key" />
            <div class="flex justify-between gap-4">
                <x-splade-input class="w-full" label="{{__('Icon')}}" placeholder="{{__('Icon')}}" name="icon" />
                <x-tomato-admin-color  label="{{__('Color')}}" placeholder="{{__('Color')}}" name="color" />
            </div>
        </div>

    <div class="flex justify-start gap-4">
        <x-tomato-admin-submit spinner :label="__('Save')" />
        <x-tomato-admin-button secondary @click.prevent="modal.close" :label="__('Cancel')" />
    </div>
    </x-splade-form>
</x-tomato-admin-container>
