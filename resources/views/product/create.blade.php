<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Bootstrap demo</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
   <style>
      body {
         background-color: #e6e5e5;
      }
      label.error {
         color: red;
         font-style: italic;
         font-weight: 700;
      }
   </style>
</head>

<body>
   <section class="pb-5">
      <div class="container pt-5">
         <div class="d-flex">
            <h4>Product Create</h4>
            <a href="{{ route('product.index') }}" class="btn btn-outline-success ms-auto">View Products</a>
         </div>

         <hr>

         <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data" id="ProductForm">
            @csrf
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <div class="mb-3">
                        <label for="" class="form-label">Product Name</label> <span style="color: red">*</span>
                        <input type="text" name="product_name" class="form-control" id=""
                           placeholder="Name">
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <div class="mb-3">
                        <label for="" class="form-label">Product SKU</label> <span style="color: red">*</span>
                        <input type="text" name="product_sku" class="form-control" id=""
                           placeholder="Product SKU">
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <table class="table table-striped">
                     <thead>
                        <tr>
                           <th>Color <span style="color: red">*</span></th>
                           <th>Size <span style="color: red">*</span></th>
                           <th>Price <span style="color: red">*</span></th>
                           <th>Action</th>
                        </tr>

                     </thead>
                     <tbody id="moreContent">
                        <tr>
                           <td>
                              <input type="text" name="color[]" class="form-control" id=""
                                 placeholder="Product Color">
                           </td>
                           <td>
                              <input type="text" name="size[]" class="form-control" id=""
                                 placeholder="Product Size">
                           </td>
                           <td>
                              <input type="text" name="price[]" class="form-control" id=""
                                 placeholder="Product Price">
                           </td>
                           <td>
                              <button type="button" class="btn btn-primary btn-sm" id="addMoreButton">Add More</button>
                           </td>
                        </tr>

                     </tbody>
                  </table>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <div class="mb-3">
                        <label for="" class="form-label">Product Unit</label>
                        <select name="product_unit" id="" class="form-control" onchange="getChange()">
                           <option value="">select</option>
                           <option value="kg">kg</option>
                           <option value="litter">Litter</option>
                           <option value="pieces">Pieces</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <div class="mb-3">
                        <label for="" class="form-label">Product Unit Value</label>
                        <input type="text" name="product_unit_value" id="unitValue" class="form-control" disabled>
                     </div>
                  </div>
               </div>

            </div>

            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <div class="mb-3">
                        <label for="" class="form-label">Product Selling Price</label>
                        <input type="text" name="selling_price" id="" class="form-control"
                           placeholder="Selling price">
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <div class="mb-3">
                        <label for="" class="form-label">Product Purschase Price</label>
                        <input type="text" name="purchase_price" id="" class="form-control"
                           placeholder="Purchase price">
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <div class="mb-3">
                        <label for="" class="form-label">Discount (%)</label>
                        <input type="text" name="discount" id="" class="form-control"
                           placeholder="Discount">
                     </div>
                  </div>

               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <div class="mb-3">
                        <label for="" class="form-label">Tax (%)</label> <span style="color: red">*</span>
                        <input type="text" name="tax" id="" class="form-control" placeholder="Tax">
                     </div>
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <div class="mb-3">
                        <label for="" class="form-label">Product Image</label> <span style="color: red">*</span>
                        <input type="file" name="product_image" class="form-control dropify" data-height="100">
                     </div>
                  </div>
               </div>
            </div>
           <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <button class="btn btn-success">Submit</button>
               </div>
            </div>
           </div>
         </form>
      </div>
   </section>



   <script src="https://code.jquery.com/jquery-3.7.1.min.js"
      integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
   <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
   <script>
      $('.dropify').dropify();
   </script>

<script>
   $("#ProductForm").validate({
      rules: {
         product_name: 'required',
         product_sku: 'required',
         'color[]': 'required',
         'size[]': 'required',
         'price[]': 'required',
         tax: 'required',
         product_image: 'required',
      },
      messages: {
         product_name: 'Please enter your product name',
         product_sku: 'Please enter your product SKU',
         'color[]': 'Please enter your product color',
         'size[]': 'Please enter your product size',
         'price[]': 'Please enter your product price',
         tax: 'Please enter your product tax',
         product_image: 'Drag or drop your product image',
      },
      
   });
</script>

   <script>
      var i = 1000;
      $('#addMoreButton').click(function() {
         var html = '<tr id="btn' + i + '">\n\
                           <td>\n\
                              <input type="text" name="color[]" class="form-control" id="" placeholder="Product Color">\n\
                           </td>\n\
                           <td>\n\
                              <input type="text" name="size[]" class="form-control" id="" placeholder="Product Size">\n\
                           </td>\n\
                           <td>\n\
                              <input type="text" name="price[]" class="form-control" id="" placeholder="Product Price">\n\
                           </td>\n\
                           <td>\n\
                              <button type="button" class="btn btn-danger btn-sm deleteBtn" id="' + i + '" >Delete</button>\n\
                           </td>\n\
                        </tr>';
         i++;
         $('#moreContent').append(html);
      });

      $('body').delegate('.deleteBtn', 'click', function() {
         var id = $(this).attr('id');
         $('#btn' + id + '').remove();
      });
   </script>
   <script>
      function getChange() {
         $('#unitValue').prop('disabled', false);
      }
   </script>
</body>

</html>
