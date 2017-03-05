@extends('layouts.default')

<div class="container-fluid">
@section('content')
	<div class="well well-sm"> 
  <h2> List Of Messages </h2>
  </div>

<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>Id</th>
      <th>Phone Number</th>
      <th>Message Title</th>
      <th>Message Text</th>
    </tr>
  </thead>
  <tbody>
 
    @foreach( $messages as $message)
        <tr>

        

        <td>{{ $message->id }} </td> 
        <td>{{ $message->merchant_phone_number }}</td> 
        <td>{{ $message->message_title}} </td> 
        <td>{{ $message->message_text}} </td>         
        <td>{{ $message->created_at }}</td> 

        </tr>

   @endforeach
    
  </tbody>
</table> 
   
@stop
</div>