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
            <h4>Product Create</h4>
            <a href="{{ route('product.create') }}" class="btn btn-outline-success ms-auto">Add Product</a>
         </div>
         <hr>

         <div class="row">
            <div class="col-md-8">
               <div class="card">
                  <div class="card-header">
                     Product Section
                  </div>
                  <div class="card-body">
                     <div class="row">
                        <form action="{{ route('product.search.show') }}" method="post" id="searchForm">
                           @csrf
                           <div class="col-md-12 p-3">
                              <input type="search" name="name" class="form-control" id="tags"
                                 placeholder="Search by code or name" aria-label="Search">
                           </div>
                        </form>


                        @foreach ($products as $product)
                           <div class="col-md-3 pb-3" onclick="openModal('{{ $product->id }}')">
                              <div class="card text-center p-0" style="height: 200px;">
                                 <img height="150" src="{{ asset('uploads/product/' . $product->product_image) }}"
                                    class="card-img-top">
                                 <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-body-secondary">{{ $product->product_name }}</h>
                                       <p class="card-text">{{ $product->selling_price }}$
                                          @if (!is_null($product->discount))
                                             <del class="text-danger">{{ $product->purchase_price }}&</del>
                                          @endif
                                       </p>

                                 </div>
                              </div>
                           </div>
                        @endforeach


                        <div class="d-flex justify-content-center">
                           {{ $products->links() }}
                        </div>


                     </div>
                  </div>
               </div>
            </div>

            <div class="col-md-4">
               <div class="card">
                  <div class="card-header">
                     Billing Section
                  </div>
                  <div class="card-body">
                     <table class="table table-sm  w-100">
                        <thead class="table-light">
                           <tr>
                              <th>ITEM</th>
                              <th>QTY</th>
                              <th>PRICE</th>
                              <th>DELETE</th>
                           </tr>
                        </thead>
                        <tbody>
                           @php $subTotal = 0; @endphp
                           @foreach ($carts as $key => $cart)
                              <tr>
                                 <td>
                                    <div class="d-flex">
                                       <img src="{{ asset('uploads/product/' . $cart->product->product_image) }}"
                                          alt="" width="30">
                                       <h6>{{ $cart->product->product_name }}</h6>
                                    </div>
                                 </td>
                                 <td>
                                    <div>
                                       <input type="number" name="place_qty" id="qty_id" min="1"
                                          value="{{ $cart->product_qty }}" class="" style="width: 40px"
                                          onclick="qtyPriceChance('{{ $cart->id }}',this)">
                                    </div>
                                    {{-- <input type="number" name="qty" id="qty_id" min="1"
                                       value="{{ $cart->product_qty }}" class="" onchange="priceChange()"
                                       style="width: 40px"> --}}
                                 </td>
                                 <td>
                                    <div>
                                       <span id="Tprice{{ $cart->id }}">{{ $cart->total_price }}</span><span>$</span>
                                    </div>
                                 </td>
                                 <td>
                                    <button type="button" class="btn btn-danger btn-sm"><i
                                          class="bi bi-trash"></i></button>
                                 </td>
                              </tr>
                              @php 
                              $subTotal += $cart->product->selling_price * $cart->product_qty;
                              @endphp
                           @endforeach

                           </thead>
                     </table>


                     <table id="subTotal">
                        <tr>
                           <td style="width: 25%">Sub Total:</td>
                           <td style="float:right"><span class="subtotal">{{ $subTotal }}</span>$</td>
                        </tr>
                        <tr>
                           <td style="width: 40%">Product Discount:</td>
                           <td style="float:right">0$</td>
                        </tr>
                        <tr>
                           <td style="width: 25%">Tax:</td>
                           <td style="float:right">0$</td>
                        </tr>
                        <tr>
                           <td style="width: 25%">Total:</td>
                           <td style="float:right"><span class="subtotal">{{ $subTotal }}</span>$</td>
                        </tr>
                     </table>

                     <div class="row pt-5">
                        <div class="col-md-12">
                           <a href="{{ route('checkout.index') }}" class="btn btn-success w-100">Place Order</a>
                        </div>
                     </div>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>


   <!-- Modal -->
   <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form action="javascript:cartStore();" method="post" id="cartCreate" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="pro_id" id="proID">
                  <div class="row">
                     <div class="col-md-6" id="imageContainer"></div>
                     <div class="col-md-6">
                        <h3>Product Name</h3>
                        <div class="pt-3">
                           <div class="qty" id="qtyBtn">
                              <button type="button" class="btn btn-default" id="minus"><i
                                    class="bi bi-dash"></i></button>
                              <input type="number" id="mainInput" name="pro_qty" value="1"
                                 style="width: 100px">
                              <button type="button" class="btn btn-default" id="plus"><i
                                    class="bi bi-plus"></i></button>
                           </div>
                        </div>
                        <div class="pt-3">
                           <input type="hidden" id="qtnValue">
                           <input type="hidden" name="total_price" id="totalPrice">
                           <h6>Price: <span id="cartPrice"></span>$</h6>
                        </div>
                        <div class="pt-4">

                           <button type="submit" class="btn btn-primary w-100 ">AddTo Cart</button>
                        </div>

                     </div>
                  </div>
               </form>


            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary">Understood</button>
            </div>
         </div>
      </div>
   </div>


   <script src="https://code.jquery.com/jquery-3.7.1.min.js"
      integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>

   <!-- billing setion price change -->
   <script>
      function qtyPriceChance(id, inputElement) {
         var qty = $(inputElement).val();
         $.ajax({
            type: 'get',
            url: '{{ route('change.qty.price') }}',
            data: {
               'id': id,
               'qty': qty,
            },
            success: function(response) {
               if(response.success){
                  $('#Tprice'+response.id+'').text(response.totalPrice);
                  $('.subtotal').text(response.subT);
               }

            }
         })
      }
   </script>

   <!-- billing setion price change -->
   {{-- <script>
      function priceChange() {
         var thisClick = $(this);
         
         var data = $('#qty_id').val();
         var price = 100;
         if (data >= 1) {
            var total = data * price;
            $('#price').text(total);
         } else {}
      }
   </script> --}}

   <!-- qty increment dicrement -->
   <script>
      $('#plus').click(function() {
         $('#minus').prop('disabled', false)
         var input = $(this).closest('.qty').find('#mainInput');
         input.val(+input.val() + 1)
      })
      $('#minus').click(function() {
         var input = $(this).closest('.qty').find('#mainInput');
         if (input.val() > 1) {
            input.val(+input.val() - 1)
         }
         if (input.val() == 1) {
            $('#minus').prop('disabled', true)
         }
      })
   </script>

   <!-- add to cart modal open -->
   <script>
      function openModal(id) {
         $.ajax({
            type: 'get',
            url: '{{ route('addto.cart') }}',
            data: {
               id: id
            },
            success: function(response) {
               if (response.success) {
                  $('#staticBackdrop').modal('show');
                  var imageUrl = '{{ asset('uploads/product') }}' + '/' + response.product.product_image;
                  var img = $('<img />', {
                     src: imageUrl,
                     alt: 'Image',
                     class: 'w-100',
                     height: '200'
                  });

                  // Append the image to a container in your HTML
                  $('#imageContainer').empty().append(img);
                  $('#cartPrice').text(response.product.selling_price);
                  $('#qtnValue').val(response.product.selling_price);
                  $('#proID').val(response.product.id);
               }
            }
         })
      }
   </script>

   <!-- modal qty plus-minus with price change -->
   <script>
      $('#qtyBtn').on('click', function() {
         var thisClick = $(this);
         var price = $('#qtnValue').val();
         var qty = $('#mainInput').val();
         if (qty >= 1) {
            var total = price * qty;
            $('#cartPrice').text(total);
            $('#totalPrice').val(total);
         } else {}
      })
   </script>

   <!-- cart store ajax -->
   <script>
      function cartStore() {
         var form = $('#cartCreate');
         var formData = new FormData(form[0]);
         $.ajax({
            type: 'post',
            url: '{{ route('cart.store') }}',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
               window.location.reload();
            }
         })
      }
   </script>

   <!-- autocomplete js -->
   <script>
      var availableTags = [];
      $.ajax({
         type: 'get',
         url: '{{ route('product.search') }}',
         success: function(response) {
            getDataByAjax(response)
         }
      });

      function getDataByAjax(availableTags) {
         $("#tags").autocomplete({
            source: availableTags
         });
      }
   </script>


</body>

</html>
