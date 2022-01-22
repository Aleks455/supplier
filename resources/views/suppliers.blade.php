<x-layout>
    @if ($suppliers->count())
    <table>
        @foreach ($suppliers as $supplier) 
            <tr>
                <td>
                    {{ $supplier->supplier_name .$supplier->id }}
                </td>
                <td>
                    <form action="{{ route('supplier.destroy', $supplier->id) }}" method="post">
                        @csrf
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