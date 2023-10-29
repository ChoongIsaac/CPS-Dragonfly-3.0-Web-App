@extends('layouts.master')
@extends('layouts.layout')

@section('content')
@include('sidebar.sidebar')
<div style="padding-top:30px;" class="container">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header">{{ __('Scan Result') }}</div>
                <div class="card-body">

                    @if($items->where('status','=', 'Unresolved')->count())

                    <div class="alert alert-success" role="alert">Results: {{$items->where('status','=', 'Available')->count()}} items are available in your inventory</div>
                    <div class="alert alert-danger" role="alert">Warning: {{$items->where('status','=', 'Unresolved')->count()}} items could not be found!</div>

                    <table id="example" class="table table-hover table-sm nowrap" style="width:100%">
                        <thead class="thead-dark" style='text-align: center'>
                            <tr>
                                <th>No</th>
                                <th>@sortablelink('item_name', 'Item Name', ['filter' => 'active, visible'], ['class' => 'text text-light text-decoration-none'])</th>
                                <th>@sortablelink('quantity', 'Quantity', ['filter' => 'active, visible'], ['class' => 'text text-light text-decoration-none'])</th>
                                <th>@sortablelink('customer', 'Customer', ['filter' => 'active, visible'], ['class' => 'text text-light text-decoration-none'])</th>
                                <th>@sortablelink('location', 'Location', ['filter' => 'active, visible'], ['class' => 'text text-light text-decoration-none'])</th>
                                <th>@sortablelink('status', 'Status', ['filter' => 'active, visible'], ['class' => 'text text-light text-decoration-none'])</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody style='text-align: center'>
                            
                            @php ($i = 1)
                            @foreach($items->where('status','=', 'Unresolved') as $key => $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$item['item_name']}}</td>
                                <td>{{$item['quantity']}}</td>
                                <td>{{$item['customer']}}</td>
                                <td>{{$item['location']}}</td>
                                <td>
                                    @if($item['status']=='Available')
                                    <span class="badge badge-success"> {{$item['status']}}</span>
                                    @elseif($item['status']=='Unresolved')
                                    <span class="badge badge-warning" style='background-color:#F29A02; color:#fff;'> {{$item['status']}}</span>
                                    @elseif($item['status']=='Lost')
                                    <span class="badge badge-danger" style='width:3rem;'> {{$item['status']}}</span>
                                    @else
                                    <span class="badge badge-dark"> {{$item['status']}}</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-success btn-sm" href="{{route('setfound', $item->id)}}"> Found </a>
                                    <a class="btn btn-danger btn-sm" href="{{route('setlost', $item->id)}}"> Lost</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {!! $items->appends(\Request::except('page'))->render() !!}

                    <style>
                        .w-5{
                            display:none;
                        }
                    </style>

                    @else

                        <div class="alert alert-success" role="alert">Great Job! All {{$items->where('status','=', 'Available')->count()}} items are available in your inventory</div>

                    @endif

                    </br>

                </div>

                <div class="card-footer">

                    <table id="example" class="table table-hover nowrap" style="width:100%">
                        <thead class="thead-dark" style='text-align: center'>
                            <tr>
                                <th style=width:25%;>Total Inventory Items</th>
                                <th style=width:25%;>Available Items</th>
                                <th style=width:25%;>Unresolved Items</th>
                                <th style=width:25%;>Lost Items</th>
                            </tr>
                        </thead>
                        <tbody style='text-align: center'>
                            <tr>
                                <td class="table-secondary">{{$items->count()}}</td>
                                <td class="table-success">{{$items->where('status','=', 'Available')->count()}}</td>
                                <td class="table-warning">{{$items->where('status','=', 'Unresolved')->count()}}</td>
                                <td class="table-danger">{{$items->where('status','=', 'Lost')->count()}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="container row" style='padding-top:1rem;'>

                <div class="clo-sm-1">
                    <button type="button" class="btn btn-secondary"><a class="text text-light text-decoration-none" href="scaninventory"><i class="fa fa-chevron-left"></i>  Back</a></button>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection