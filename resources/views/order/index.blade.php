<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Order List</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
   <style>
      @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");

      body {
         background-color: #e6e5e5;
      }
   </style>
</head>

<body>
   <section class="pb-5">
      <div class="container pt-5">
         <div class="d-flex">
            <h4>Orders</h4>

            <div class="d-flex ms-auto">
               <form action="{{ route('order.index') }}" method="get">
                  <div class="form-group">
                     <input type="date" class="form-control" name="from_date" value="{{ Request('from_date') }}">
                  </div>
                  <div class="form-group">
                     <input type="date" class="form-control" name="to_date" value="{{ Request('to_date') }}">
                  </div>
                  <button type="submit" class="btn btn-primary float-end"><i class="bi bi-search"></i></button>
               </form>
            </div>

         </div>
         <hr>


         <div class="row">
            <div class="col-md-12">
               {{-- <div class="card">
                     <div class="card-header">
                        Order List
                     </div>
                     <div class="card-body">
                     </div>
                  </div> --}}
               <table class="table table-bordered table-striped">
                  <thead>

                     <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address-1</th>
                        <th>Address-2</th>
                        <th>Date</th>
                     </tr>

                  </thead>
                  <tbody>
                     @foreach ($orders as $key => $order)
                        <tr>
                           <td>{{ ++$key }}</td>
                           <td>{{ $order->name }}</td>
                           <td>{{ $order->email }}</td>
                           <td>{{ $order->phone }}</td>
                           <td>{{ $order->address_1 }}</td>
                           <td>{{ $order->address_2 }}</td>
                           <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>

                        </tr>
                     @endforeach
                  </tbody>
               </table>
               <div class="d-flex justify-content-center">
                  {{ $orders->links() }}
               </div>
            </div>
         </div>
      </div>
   </section>



   <script src="https://code.jquery.com/jquery-3.7.1.min.js"
      integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>


</body>

</html>
