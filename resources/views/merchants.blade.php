@extends('layouts.default')

<div class="container-fluid">
@section('content')
	<div class="well well-sm"> 
  <h2> List Of Merchants </h2>
  </div>

<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>Id</th>
      <th>Phone Number</th>
      <th>Category</th>
      <th>Points</th>
      <th>Enabled? </th>
    </tr>
  </thead>
  <tbody>
 
    @foreach( $merchants as $merchant)
        <tr>

        

        <td>{{ $merchant->merchant_id }} </td> 
        <td>{{ $merchant->merchant_phone_number }}</td> 
        <td>{{ $merchant->merchant_category}} </td> 
        <td>{{ $merchant->merchant_points }}</td> 
        <?php
          if ( $merchant->merchant_enable == 0)
            echo '<td class=\"active\">'; 
          else  
            echo '<td class="success">';
        ?>
         <?php if ($merchant->merchant_enable ) echo 'Yes'; else echo 'No' ?>   
         </td>
        </tr>

   @endforeach
    
  </tbody>
</table> 
   
@stop
</div>