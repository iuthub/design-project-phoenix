@extends('layouts.app')

@section('content')
  <div class="card-deck ">
   <div class="card border-primary  mb-3 col-md-4" style="width: 20rem;">
         <div class="card-body">
            <h5 class="card-title">Number of Weddings </h5>
              <h6 class="card-subtitle mb-2 ml-4 text-muted">from Opening</h6>
                <h3 class="card-text ml-" id="no_weds"></h3>
       </div>
    </div>

    <div class="card border-primary mb-3 col-md-4" style="width: 20rem;">
         <div class="card-body">
            <h5 class="card-title">Number of Upcoming Events  </h5>
              <h6 class="card-subtitle mb-2 ml-4 text-muted">in 30 days</h6>
                <h3 class="card-text ml-" id="no_upcoming_weds"></h3>
       </div>
    </div>
    </div>

    <table class="table table-hover mt-4">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Order Name</th>
          <th scope="col">Date</th>
          <th scope="col">Guest Number</th>
          <th scope="col">Paycheck</th>
          <th scope="col">Status</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($orders as $order)
        <tr>
          <th scope="row">{{$order->orderer_name}}</th>
          <td>{{str_limit($order->order_date, $limit = 10, $end = '')}}</td>
          <td>{{$order->guest_number}}</td>
          <td>{{$order->overall_payment}}</td>
          <td>
            @if ($order->prepayment_status == true)
              <span class="badge badge-success">Payed</span>
              @else
              <span class="badge badge-danger">UnPayed</span>
            @endif           
          </td>
          <td><button type="button" class="btn btn-primary btn-sm">Details</button></td>
        </tr>
        @endforeach
      </tbody>      
    </table>
    {!! $orders->render() !!}

<script>
    $(function() {
        $.ajax({
            type: "GET",
            url: "{{ route('no_weds') }}",
            dataType: "JSON",
            cache: false,  
            success: function(data) {
                $("#no_weds").text(data.overall);
                 $("#no_upcoming_weds").text(data.upcoming);
            }
         });    
    }); 
</script>
@endsection
