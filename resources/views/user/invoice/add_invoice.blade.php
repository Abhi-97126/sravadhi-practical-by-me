@extends('layout')
@section('content')
    <div class="content pt-4 px-3 mx-2 my-2 rounded" style="width:100%;float:inline-end;background-color:rgb(239, 247, 255)">
        <a href="{{-- route('invoice.list') --}}" class="btn btn-sm btn-dark align-end mb-3"><i class="fa fa-arrow-left"></i> Back</a>
        <div class="row">
            <div class="col-md-12">
                <form method="post" id="newInvoiceForm">
                  @csrf
                    <div class="tab-content" id="nav-tabContent">
                      <div class="tab-pane fade show active" id="nav-invoice" role="tabpanel" aria-labelledby="nav-invoice-tab">
                        <div class="card mt-4">
                          <div class="card-header">
                            Invoice
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-6">
                                <label for="customerName">Customer Name:</label>
                                <input type="text" name="customerName" id="customerName" placeholder="Enter Customer Name" class="form-control text-capitalize">
                                <p id="error-due_date" class="text-danger text-small" style="display:none"></p>
                              </div>
                              <div class="col-md-6">
                                <label for="customer_email">Customer Email:</label>
                                <input type="text" name="customer_email" id="customer_email" placeholder="Enter Customer Email" class="form-control text-capitalize">
                                <p id="error-customer_email" class="text-danger text-small" style="display:none"></p>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="invoice_date">Invoice Date:</label>
                                    <input type="date" name="invoice_date" id="invoice_date" placeholder="Enter Invoice Date" class="form-control text-capitalize">
                                    <p id="error-invoice_date" class="text-danger text-small" style="display:none"></p>
                                </div>
                                <div class="col-md-6">
                                    <label for="due_date">Due Date:</label>
                                    <input type="date" name="due_date" id="due_date" placeholder="Enter Due Date" class="form-control text-capitalize">
                                    <p id="error-due_date" class="text-danger text-small" style="display:none"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table w-50">
                                        <table class="table table-responsive table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-start" colspan=5>
                                                        Items
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>Select Item</th>
                                                    <th>Price</th>
                                                    <th>Qty.</th>
                                                    <th>Total Price</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="invoiceItemBody">
                                                <tr id="0">
                                                    <td>
                                                        <select name="prodCat[0]" id="prodCat_0" onchange="getSubCat(0)" class="form-control text-capitalize">
                                                            <option value="">Select Product Category</option>
                                                            @foreach ($prods as $id=>$prodname)
                                                                <option value="{{$id}}">{{$prodname}}</option>
                                                            @endforeach
                                                        </select>
                                                        <p id="error-prodCat_0" class="text-danger text-small" style="display:none"></p>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="price[0]" id="price" placeholder="0.00" class="form-control text-capitalize" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="qty[0]" id="qty" value="0" class="form-control text-capitalize">
                                                        <p id="error-qty" class="text-danger text-small" style="display:none"></p>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="t_price[0]" id="t_price" placeholder="0.00" class="form-control text-capitalize" readonly>
                                                    </td>
                                                    <td>
                                                        <a role="button" class="text-danger" onclick="delItemBox(0)">
                                                          <i class="fas fa-times"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <a role="button" class="text-success" id="add_moreItem">
                                                            <i class="fas fa-plus"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                              <div class="col-md-12">
                                <label for="prodDesc">Product Description:</label>
                                <textarea name="prodDesc" id="prodDesc" cols="30" rows="10" placeholder="Enter Product Description" class="form-control"></textarea>
                                <p id="error-prodDesc" class="text-danger text-small" style="display:none"></p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 text-end">
                        <button type="submit" class="btn btn-dark btn-sm mt-4" id="prodBtn">Submit</button>
                      </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script> 
    <script src="{{asset('assets/js/additional-methods.min.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
        });
        // add more category dropdown
        $("#add_moreItem").click(function(){
            var id = $("tbody#invoiceItemBody tr:last-child").attr('id');
            if(id == undefined){
            id = 0;
            }else{
            id = parseInt(id) + 1;
            }
            var output = '<tr id="' + id + '">';
            output += '<td>';
            output += '<select name="prodCat[' + id + ']" id="prodCat_' + id + '" onchange="getSubCat(' + id + ')" class="form-control text-capitalize">';
            output += '<option value="">Select Product Category</option>';
            output += '@foreach ($prods as $id=>$prodname)<option value="{{$id}}">{{$prodname}}</option>@endforeach';
            output += '</select>';
            output += '<p id="error-prodCat_' + id + '" class="text-danger text-small" style="display:none"></p>';
            output += '</td>';
            output += '<td>';
            output += '<input type="number" name="price[' + id + ']" id="price_' + id + '" placeholder="0.00" class="form-control text-capitalize" readonly>';
            output += '</td>';
            output += '<td>';
            output += '<input type="number" name="qty[' + id + ']" id="qty_' + id + '" value="0" class="form-control text-capitalize">';
            output += '<p id="error-qty_' + id + '" class="text-danger text-small" style="display:none"></p>';
            output += '</td>';
            output += '<td>';
            output += '<input type="number" name="t_price[' + id + ']" id="t_price_' + id + '" placeholder="0.00" class="form-control text-capitalize" readonly>';
            output += '</td>';
            output += '<td>';
            output += '<a role="button" class="text-danger" onclick="delItemBox(' + id + ')">';
            output += '<i class="fas fa-times"></i>';
            output += '</a>';
            output += '</td>';
            output += '</tr>';
            $("tbody#invoiceItemBody").append(output);
        })

        // delete category dropdown
        function delItemBox(id){
            $("#invoiceItemBody tr#"+id).remove();
        }

        $("form#newInvoiceForm").submit(function(e) {
            e.preventDefault();
            var form = this; // Store form reference
            var formdata = new FormData(form);
            var submitBtn = $('#prodBtn');
            
            // Disable submit button to prevent multiple submissions
            submitBtn.prop('disabled', true);
            
            $.ajax({
                url: "{{ route('store.invoice') }}",
                data: formdata,
                method: "POST",
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.errors) {
                        // Clear all errors first
                        $('.text-danger').css('display', 'none').text('');
                        
                        // Handle input errors
                        $("form#newInvoiceForm input[id], form#newInvoiceForm select[id]").each(function() {
                            var id = this.id;
                            var fieldName = id.includes('_') ? id.replace(/_/g, '.') : id;
                            
                            if (response.errors[fieldName]) {
                                $("#error-" + id).css('display', 'block').text(response.errors[fieldName][0]);
                            }
                        });
                    } 
                    else if (response.success) {
                        window.location.href = "{{ route('invoice.list') }}";
                    }
                    else if (response.error) {
                        alert(response.error); // Or show in a better way
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            var fieldId = key.replace(/\./g, '_');
                            $("#error-" + fieldId).css('display', 'block').text(value[0]);
                        });
                    } else {
                        console.error('Error:', xhr.responseText);
                    }
                },
                complete: function() {
                    submitBtn.prop('disabled', false);
                }
            });
        });

      $("#basePrice").on('blur',function(){
        var price = $(this).val();
        $(this).val(parseFloat(price).toFixed(2));
      })
      function change(i){
        var price = $("#priceDiff_"+i).val();
        $("#priceDiff_"+i).val(parseFloat(price).toFixed(2));
      }
    </script>
@endsection
