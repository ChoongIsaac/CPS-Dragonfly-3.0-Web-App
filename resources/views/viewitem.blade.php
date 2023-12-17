@extends('layouts.master')
@extends('layouts.layout')

@section('content')
@include('sidebar.sidebar')
<div style="padding-top:30px;" class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Item Detail</div>
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-12 col-sm-4 pb-5">
                            <h6>Item Name</h6>
                            <strong>{{$item->item_name}}</strong>
                        </div>

                      

                        <div class="col-12 col-sm-4 pb-5">
                            <h6>Item Code</h6>
                            <strong>{{$item->item_code}}</strong>
                        </div>
                       
                        <div class="col-12 col-sm-4 pb-5">
                            <h6>Command</h6>
                            <strong>{{$item->command}}</strong>
                        </div>
                       
                    </div>

                    <div class="row">

                        <div class="col-12 col-sm-6 pb-5">
                            <h6>Status</h6>
                            @if($item['status']=='Available')
                                    <span class="badge badge-success"> {{$item['status']}}</span>
                                    @elseif($item['status']=='Unresolved')
                                    <span class="badge badge-warning" style='background-color:#F29A02; color:#fff;'> {{$item['status']}}</span>
                                    @elseif($item['status']=='Lost')
                                    <span class="badge badge-danger" style='width:3rem;'> {{$item['status']}}</span>
                                    @else
                                    <span class="badge badge-dark"> {{$item['status']}}</span>
                                    @endif
                        </div>
                    </div>

                   
                </div>
            </div>

            <div class="container row" style='padding-top:1rem;'>

                <div class="clo-sm-1">
                    <button type="button" class="btn btn-secondary"><a class="text text-light text-decoration-none" href="inventory"><i class="fa fa-chevron-left"></i>  Back</a></button>
                </div>

                <div class="col-sm-1 offset-md-7" style='margin-left:66%;'>
                    <button type="button" class="btn btn-primary"><a class="text text-light text-decoration-none" href="{{route('itempdf', $item->id)}}" target="_blank"><i class="fa fa-print"></i> Print </a></button>
                </div>
                
                <div class="col-sm-1" style='margin-left:0.3rem;'>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit_item_modal"><i class="fa fa-pen"></i> Edit</button>
                </div>

                <div class="col-sm-1">
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#checkout_item_modal"><i class="fa fa-cash-register"></i> Check Out</button>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection





<!-- Edit Item Modal -->
<div class="modal fade" id="edit_item_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="/edititem" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$item->id}}" required/>
                <div class="modal-header">
                    <h5 class="modal-title">Edit Item Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Item Name</label>
                            <div class="col-sm-9">
                                <input type="text" id="item_name" name="item_name" class="form-control" value="{{$item->item_name}}" required/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Item Code</label>
                            <div class="col-sm-9">
                            <input type="text" id="item_code" name="item_code" class="form-control" style="text-transform:uppercase" oninput="this.value = this.value.toUpperCase()"  maxlength="24" title="Maximum 24 characters" value="{{$item->item_code}}" required/>
                                
                            </div>
                        </div>

                        <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Command</label>
                            <div class="col-sm-9">
                                <input type="text" id="command" name="command" class="form-control" value="{{$item->command}}" required/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select type="text" id="status" name="status" class="form-control">
                                    <option value="Available" <?php if($item['status']=="Available") echo 'selected="selected"'; ?>>Available</option>
                                    <option value="Unresolved" <?php if($item['status']=="Unresolved") echo 'selected="selected"'; ?>>Unresolved</option>
                                    <option value="Lost" <?php if($item['status']=="Lost") echo 'selected="selected"'; ?>>Lost</option>
                                </select>
                            </div>
                        </div>

                       
                    </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Check Out Item Modal -->
<div class="modal fade" id="checkout_item_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/checkoutitem" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$item->id}}" required/>
                <input type="hidden" name="status" value="Checked Out" required/>
                <div class="modal-header">
                    <h5 class="modal-title">Check Out Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to check out {{$item->item_name}} from your inventory ?
                    </br>
                    </br>
                    </br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" type="submit">Check Out</button>
                </div>
            </form>
        </div>
    </div>
</div>