@extends('layouts.default')

<div class="container-fluid">
@section('content')
	<div class="well well-sm"> 
  <h2> List Of Customers </h2>
  </div>

<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>Id</th>
      <th>Phone Number</th>
      <th>Pincode</th>
      <th>Points</th>
    </tr>
  </thead>
  <tbody>
    @foreach( $customers as $customer)
        <tr>
        <td>{{ $customer->id }} </td> 
        <td>{{ $customer->customer_phone_number }}</td> 
        <td>{{ $customer->customer_pincode}} </td> 
        <td>{{ $customer->customer_points }}</td> 
        </tr>

   @endforeach
    
  </tbody>
</table> 
   
@stop
</div>