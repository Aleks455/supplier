<x-layout>

    <form action="{{ route('supplier.update') }}" method="POST">
        @csrf
        <input type="text" name="supplier_name" value="{{ $supplier->supplier_name }}">
        <input name="id" type="hidden" value="{{ $supplier->id }}" />
        <input type="submit" value="Submit">
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</x-layout>