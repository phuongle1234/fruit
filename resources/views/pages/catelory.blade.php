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
      <h4 class="w3-center"><b>Mater Data Catelory</b></h4>

        <table>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <form method="POST" action="{{ route('catelory.create') }}" >
                @csrf
                <td>No.{{ count($item) +1 }}</td>
                <td><input name="name" required /></td>
                <td><button >Add</button></td>
                <td></td>
            </form>
        </tr>
        
        @foreach( $item as $k => $row )
        <tr>
            <form method="POST" action="{{ route('catelory.update', ['id'=>  $row->id ] ) }}" >
            @csrf
                <td>No.{{ $k + 1 }}</td>
                <td><input name="name" value="{{ $row->name }}" required /></td>
                <td><button >Update</button></td>
            </form>

            <form method="POST" action="{{ route('catelory.delete', ['id' =>  $row->id ]) }}" >  
            @csrf
                <td>
                    <button >Delete</button>
                </td>
            </form>

            <!-- <td>{{ $row->id }}</td>
            <td>{{ $row->name }}</td>
            <td></td> -->
        </tr>
       @endforeach
        

        </table>
    </div>
  </div>
@endsection