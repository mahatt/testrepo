@extends('layouts.default')

<div class="container-fluid">
@section('content')
	<div class="well well-sm"> 
  <h2> List Of Transactions </h2>
  </div>

<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>Id</th>
      <th>Merchants Phone Number</th>
      <th>Customer Phone Number</th>
      <th>Points</th>
      <th>Amount</th>
      <th>Policy</th>
      <th>Time</th>/
    </tr>
  </thead>
  <tbody>
    @foreach( $transactions as $transaction)
        <tr>
        <td>{{ $transaction->id }} </td> 
        <td>{{ $transaction->merchant_phone_number }}</td> 
        <td>{{ $transaction->customer_phone_number}} </td> 
        <td>{{ $transaction->points }}</td> 
        <td>{{ $transaction->amount }}</td> 
        <td>{{ $transaction->policy }}</td>         
        <td>{{ $transaction->created_at }}</td>
        </tr>

   @endforeach
    
  </tbody>
</table> 
   
@stop
</div>