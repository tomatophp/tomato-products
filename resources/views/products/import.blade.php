<x-tomato-admin-container label="{{__('Import Product')}}">
    <x-splade-form class="flex flex-col space-y-4" action="{{route('admin.products.import.store')}}" method="post">
        <a class="text-primary-500 underline" href="https://docs.google.com/spreadsheets/d/1gTYBzNuFypMB5LzjVkJMl0rZmbqb7CtqgSKKPmMfXac/edit?usp=sharing" target="_blank">
            {{__('Please Check This XLSX file before create new one')}}
        </a>
        <x-splade-file filepond name="file" label="{{__('Please add your XLSX file')}}" />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit label="{{__('Save')}}" :spinner="true" />
            <x-tomato-admin-button type="button" secondary @click.prevent="modal.close" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
