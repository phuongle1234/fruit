@inject( 'PEnum', 'App\Http\Enum\ProductEnum' )
@inject( 'cate', 'App\Models\Category' )
@extends('layout.admin')

@section('title', 'Fruit-Catelory')

@section('custom_css')
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
@endsection


@section('content')
<div class="w3-container w3-light-grey w3-padding-32 w3-padding-large" id="contact">
    <div class="w3-content" style="max-width:600px">
      <h4 class="w3-center"><b>Mater Data Prodcut</b></h4>

        <table>
        <tr>
            <th>No.</th>
            <th>catelory</th>
            <th>Name</th>
            <th>Unit</th>
            <th>Price</th>
            <th></th>
            <td></td>
        </tr>
        <form method="POST" action="{{ route('prodcut.create') }}" >
        <tr>
            
                @csrf
                <th>No.{{ count($item) +1 }}</th>
                
                <th>
                    <select name="category_id"  >
                      @foreach( $cate->get() as $k => $r )
                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                      @endforeach
                    </select>
                </th>
                <th><input name="name" required /></th>
                <th>
                    <select name="unit"  >
                      @foreach( $PEnum::UNIT as $e )
                        <option value="{{ $e }}">{{ $e }}</option>
                      @endforeach
                    </select>
                </th>
                <th><input name="price" type="number" required /></th>
                <th><button >Add</button></th>
                <th></th>
        </tr>
        </form>
        <tbody>
          @foreach ( $item as $k => $row )
          
              <tr>
          <form method="POST" action="{{ route('prodcut.update', ['id' => $row->id]) }}" >
                @csrf
                <th>No.{{ $k + 1 }}</th>
                
                <th>
                    <select name="category_id"  >
                      @foreach( $cate->withTrashed()->get() as $k => $r )
                        <option value="{{ $r->id }}" {{ $row->category_id == $r->id ? 'selected' : '' }} >{{ $r->name }}</option>
                      @endforeach
                    </select>
                </th>
                <th><input name="name" value="{{ $row->name }}" required /></th>
                <th>
                    <select name="unit"  >
                      @foreach( $PEnum::UNIT as $e )
                        <option value="{{ $e }}" {{ $row->unit == $e ? 'selected' : '' }} >{{ $e }}</option>
                      @endforeach
                    </select>
                </th>
                <th><input name="price" type="number"  value="{{ $row->price }}" required /></th>
                <th><button >Update</button></th>
          </form>
                <th>
                 <form method="POST" action="{{ route('prodcut.delete', ['id' => $row->id]) }}" >
                   @csrf <button >Delete</button>
                  </form>
                </th>
        </tr>

          @endforeach
        </tbody>
        </table>
    </div>
  </div>
@endsection