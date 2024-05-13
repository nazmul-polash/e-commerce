<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Product</title>
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
            <h4>Checkout</h4>
         </div>
         <hr>

         <form action="{{ route('order.place') }}" method="post">
         <div class="row">
               @csrf

               <div class="col-md-8">
                  <div class="card">
                     <div class="card-header">
                        Basic Details
                     </div>
                     <div class="card-body">

                        <div class="row">
                           <div class="col-md-6 pb-2">
                              <div class="form-group">
                                 <label for="">Name</label>
                                 <input type="text" name="name" class="form-control" placeholder="enter name">
                              </div>
                           </div>
                           <div class="col-md-6 pb-2">
                              <div class="form-group">
                                 <label for="">Email</label>
                                 <input type="email" name="email" class="form-control" placeholder="enter email">
                              </div>
                           </div>
                           <div class="col-md-6 pb-2">
                              <div class="form-group">
                                 <label for="">Phone</label>
                                 <input type="text" name="phone" class="form-control" placeholder="enter phone">
                              </div>
                           </div>
                           <div class="col-md-6 pb-2">
                              <div class="form-group">
                                 <label for="">Address-1</label>
                                 <input type="text" name="address_1" class="form-control"
                                    placeholder="enter address-1">
                              </div>
                           </div>
                           <div class="col-md-6 pb-2">
                              <div class="form-group">
                                 <label for="">Address-2</label>
                                 <input type="text" name="address_2" class="form-control"
                                    placeholder="enter address-2">
                              </div>
                           </div>
                           <div class="col-md-6 pb-2">
                              <div class="form-group">
                                 <label for="">Pin Code</label>
                                 <input type="text" name="pincode" class="form-control"
                                    placeholder="enter address-2">
                              </div>
                           </div>

                        </div>

                     </div>
                  </div>
               </div>

               <div class="col-md-4">
                  <div class="card">
                     <div class="card-header">
                        Order Details
                     </div>
                     <div class="card-body">
                        <div class="row pt-2">
                           <div class="col-md-12">
                              <div>
                                 <table class="table-sm ">
                                    <thead>
                                       @foreach($carts as $key => $cart)
                                          <tr>
                                          <td style="width: 70%">{{ $cart->product->product_name }}</td>
                                          <td style="width: 20%">{{ $cart->product_qty }}</td>
                                          <td style="width: 20%">{{ $cart->total_price }}$</td>
                                       </tr>
                                       @endforeach
                                    </thead>
                                 </table>
                              </div>
                              <div class="pt-5">

                                 <button type="submit" class="btn btn-primary float-end">Order Place</button>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </section>



   <script src="https://code.jquery.com/jquery-3.7.1.min.js"
      integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
  

</body>

</html>
