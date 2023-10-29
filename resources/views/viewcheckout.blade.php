@extends('layouts.master')
@extends('layouts.layout')

@section('content')
@include('sidebar.sidebar')
<div style="padding-top:30px;" class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Checked Out Item</div>
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-12 col-sm-6 pb-5">
                            <h6>Item Name</h6>
                            <strong>{{$item->item_name}}</strong>
                        </div>

                        <div class="col-12 col-sm-6 pb-5">
                            <h6>Quantity</h6>
                            <strong>{{$item->quantity}}</strong>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6 pb-5">
                            <h6>Item Code</h6>
                            <strong>{{$item->rfid_id}}</strong>
                        </div>
                        <div class="col-12 col-sm-6 pb-5">
                            <h6>Location</h6>
                            <strong>{{$item->location}}</strong>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6 pb-5">
                            <h6>Customer</h6>
                            <strong>{{$item->customer}}</strong>
                        </div>
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

                    <div class="row">
                    <div class="col-12 col-sm-6 pb-5">
                            <h6>Check In Date</h6>
                            <strong>{{date('d-m-Y h:i A', strtotime($item->checkInDate))}}</strong>
                        </div>
                        <div class="col-12 col-sm-6 pb-5">
                            <h6>Check Out Date</h6>
                            <strong>{{date('d-m-Y h:i A', strtotime($item->checkOutDate))}}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container row" style='padding-top:1rem;'>

                <div class="clo-sm-1">
                    <button type="button" class="btn btn-secondary"><a class="text text-light text-decoration-none" href="checkout"><i class="fa fa-chevron-left"></i>  Back</a></button>
                </div>
                
                <div class="col-sm-1 offset-md-8">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#recheckin_item_modal"><i class="fa fa-undo"></i> Re-Check In</button>
                </div>

                <div class="col-sm-1" style='margin-left:5%;'>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_item_modal"><i class="fa fa-trash"></i> Delete Item</button>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection



<!-- Re-Check In Item Modal -->
<div class="modal fade" id="recheckin_item_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/recheckinitem" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$item->id}}" required/>
                <input type="hidden" name="status" value="Available" required/>
                <div class="modal-header">
                    <h5 class="modal-title">Check Out Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to re-check in this item to your inventory?
                    </br>
                    </br>
                    </br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-success" type="submit">Re-Check In</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Delete Item Modal -->
<div class="modal fade" id="delete_item_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/deleteitem" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$item->id}}" required/>
                <div class="modal-header">
                    <h5 class="modal-title">Permanently Delete Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to permanently delete this item?
                    </br>
                    </br>
                    </br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" type="submit">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>