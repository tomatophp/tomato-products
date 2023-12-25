<x-tomato-admin-container label="{{__('Attach Products To Inventory Reqeuest')}}">
    <x-splade-form :default="['ids'=> $ids]" class="flex flex-col gap-4" action="{{route('admin.inventories.create')}}" method="get">
        <h1>{{__('The Following Products will be attached to new inventory request')}}</h1>
        <div>
            @foreach($products as $product)
                <div>{{$product->name}} [SKU: {{$product->sku}}]</div>
                <br>
            @endforeach
        </div>
        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit label="{{__('Confirm')}}" :spinner="true" />
            <x-tomato-admin-button secondary @click.prevent="modal.close" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
