<x-layout>
    @if ($suppliers->count())
    <table>
        @foreach ($suppliers as $supplier) 
            <tr>
                <td>
                    {{ $supplier->supplier_name }}
                </td>
                <td>
                    <button style="color: blue"> 
                        <a style="text-decoration: none" href="{{ route('supplier.edit',  $supplier->id) }}">Edit</a>
                    </button>
                </td>
                <td>
                    <form action="{{ route('supplier.destroy') }}" method="post">
                        @csrf
                        <input name="id" type="hidden" value="{{ $supplier->id }}" />
                        <button type="submit" style="color: red"> 
                            Delete
                        </button>
                    </form>
                </td>

            </tr>
        @endforeach
    </table>
    @endif
</x-layout>