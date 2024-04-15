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
<script src="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.6.0/print.js" integrity="sha512-/fgTphwXa3lqAhN+I8gG8AvuaTErm1YxpUjbdCvwfTMyv8UZnFyId7ft5736xQ6CyQN4Nzr21lBuWWA9RTCXCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.6.0/print.css" integrity="sha512-tKGnmy6w6vpt8VyMNuWbQtk6D6vwU8VCxUi0kEMXmtgwW+6F70iONzukEUC3gvb+KTJTLzDKAGGWc1R7rmIgxQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection



@section('content')
<div class="w3-container w3-light-grey w3-padding-32 w3-padding-large" id="contact">
    <div class="w3-content" style="max-width:600px">
      <h4 class="w3-center"><b> Fruit Item </b></h4>
       <form method="POST" action="{{ route('invoice.create' ) }}" >
          @csrf
            <h4>Customer Name: <input value="{{ Auth::user()->name }}" name="customer_name" required /></h4>
            
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
    <h2> Invoice History </h2>

    @foreach ( $invoice->groupBy('code') as $k => $row )
        
        <table id="CLAS{{ $k }}">
         <tr>
            <th colspan="2">Customer: {{ $row[0]->customer_name }} </th>
            <th colspan="2">Brad Pit</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <th>No.</th>
            <th>Category</th>
            <th>Fruit</th>
            <th>Unit</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Amount</th>
        </tr>

        @foreach( $row as $k2 => $row2 )
        
        <tr>
           <th>No.{{ $k2 + 1 }}</th>
            <th>{{ @@$row2->categories->name }}</th>
            <th>{{ $row2->prodcuts->name }}</th>
            <th>{{ $row2->prodcuts->unit }}</th>
            <th>{{ $row2->prodcuts->price }}</th>
            <th>{{ $row2->quantity }}</th>
            <th>{{ $row2->amount }}</th>
        </tr>
       @endforeach
          <tfoot>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th>
              <form method="POST" action="{{ route('invoice.delete', ['code'=>  $k ] ) }}" >
                @csrf
                <button>Delete</button>
              </form>
              </th>
              <th><button onClick="printJS(`CLAS{{ $k }}`,'html' )" > Print Bill </button></th>
              <th>{{ $row->sum('quantity') }}</th>
              <th>{{ $row->sum('amount') }}</th>
            </tr>
          </tfoot>
        </table>
    <div style="margin-top: 50px" ><div>
    @endforeach
  </div>
@endsection

@section('custum_js')
<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.1.min.js" > </script> 
<script type="text/javascript">

   const Popup = (className) =>
    {

      const table = document.querySelector(`table.CLAS${className}`)?.innerHTML

        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title>my div</title><style>table { font-family: arial, sans-serif; border-collapse: collapse; width: 100%; }td, th { border: 1px solid #dddddd; text-align: left; padding: 8px; } tr:nth-child(even) { background-color: #dddddd; } .w3-content .blockItem { display: grid; grid-template-columns: 40% 40% 40%; grid-column-gap: 16px; } </style> ');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(table);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>
@endsection