@extends('layouts.master')
@extends('layouts.layout')

@section('content')
@include('sidebar.sidebar')
<div style="padding-top:30px;" class="container">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header">{{ __('Check In Items') }}</div>
                <div class="card-body">

                    <form id="additem" action="{{route('addItem.post')}}" method = "POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Item Name</label>
                                <div class="col-sm-9">
                                    <input type="text" id="item_name" name="item_name" class="form-control" value="" required/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Item Code</label>
                                <div class="col-sm-9">
                                    <input type="text" id="item_code" name="item_code" class="form-control" style="text-transform:uppercase" oninput="this.value = this.value.toUpperCase()"  maxlength="24" title="Maximum 24 characters" value="" required/>
                                </div>
                            </div>

                
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Command</label>
                                <div class="col-sm-9">
                                    <input type="text" id="command" name="command" class="form-control" value="" />
                                </div>
                            </div>

                            <div class="form-group row justify-content-end">
                                <div class="col-sm-2">
                                <button type="submit" style="margin-top:1.5rem; margin-left:2rem;" class="btn btn-success"><i class="fa fa-plus"></i> Add Item</button>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
