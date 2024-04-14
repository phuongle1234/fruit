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

.w3-content .blockItem {
    display: grid;
    grid-template-columns: 40% 40% 40%;
    grid-column-gap: 16px;
}
</style>
@endsection


@section('content')
<div class="w3-container w3-light-grey w3-padding-32 w3-padding-large" id="contact">
    <div class="w3-content" style="max-width:600px">
      <h4 class="w3-center"><b> Fruit Item </b></h4>
       <form method="POST" action="{{ route('invoice.create' ) }}" >
                @csrf
            <h4>Customer Name: <input value="{{ Auth::user()->name }}" required /></h4>
            
            <div class="blockItem" >
              @foreach ( $item as $k => $row )
                
                  <div class="card">
                    <h1>{{ $row->categories->name }} </h1>
                    <p class="price">${{ $row->price }} / {{ $row->unit }}</p>
                    <p>{{ $row->name }}</p>
                    <p><input value="{{ $row->id }}" name="{{ $row->id }}[id]"  type="hidden" > </p>
                    <p><input value="" name="{{ $row->id }}[quantity]"  placeholder="Quantity"  type="number" > </p>
                  </div>
              
              @endforeach
            </div>
            <div class="w3-center"> <button>Submit</button></div>
        </form> 
    </div>
  </div>
@endsection

@section('custum_js')
<script>


</script>
@endsection