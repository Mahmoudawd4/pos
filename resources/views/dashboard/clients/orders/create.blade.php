@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{__('messages.add_order')}}</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{__('messages.dashboard')}}</a></li>
                <li><a href="{{ route('dashboard.clients.index') }}">{{__('messages.clients')}}</a></li>
                <li class="active">{{__('messages.add_order')}}</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                <div class="col-md-6">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title" style="margin-bottom: 10px">{{__('messages.categories')}}</h3>

                        </div><!-- end of box header -->

                        <div class="box-body">

                            @foreach ($categories as $category)

                                <div class="panel-group">

                                    <div class="panel panel-info">

                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#{{ str_replace(' ', '-', $category->name) }}">{{ $category->name }}</a>
                                            </h4>
                                        </div>

                                        <div id="{{ str_replace(' ', '-', $category->name) }}" class="panel-collapse collapse">

                                            <div class="panel-body">

                                                @if ($category->products->count() > 0)

                                                    <table class="table table-hover">
                                                        <tr>
                                                            <th>{{__('messages.name')}}</th>
                                                            <th>{{__('messages.stock')}}</th>
                                                            <th>{{__('messages.price')}}</th>
                                                            <th>{{__('messages.add')}}</th>
                                                        </tr>

                                                        @foreach ($category->products as $product)
                                                            <tr>
                                                                <td>{{ $product->name }}</td>
                                                                <td>{{ $product->stock }}</td>
                                                                <td>{{ number_format($product->sale_price, 2) }}</td>
                                                                <td>
                                                                    <a href=""
                                                                       id="product-{{ $product->id }}"
                                                                       data-name="{{ $product->name }}"
                                                                       data-id="{{ $product->id }}"
                                                                       data-price="{{ $product->sale_price }}"
                                                                       class="btn btn-success btn-sm add-product-btn">
                                                                        <i class="fa fa-plus"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </table><!-- end of table -->

                                                @else
                                                    <h5>{{__('messages.no_records')}}</h5>
                                                @endif

                                            </div><!-- end of panel body -->

                                        </div><!-- end of panel collapse -->

                                    </div><!-- end of panel primary -->

                                </div><!-- end of panel group -->

                            @endforeach

                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                </div><!-- end of col -->

                <div class="col-md-6">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title">{{__('messages.orders')}}</h3>

                        </div><!-- end of box header -->

                        <div class="box-body">

                            <form action="{{ route('dashboard.clients.orders.store', $client->id) }}" method="post">

                                {{ csrf_field() }}
                                {{ method_field('post') }}

                                @include('partials._errors')

                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>{{__('messages.product')}}</th>
                                        <th>{{__('messages.quantity')}}</th>
                                        <th>{{__('messages.price')}}</th>
                                    </tr>
                                    </thead>

                                    <tbody class="order-list">


                                    </tbody>

                                </table><!-- end of table -->

                                <h4>{{__('messages.total')}} : <span class="total-price">0</span></h4>

                                <button class="btn btn-primary btn-block disabled" id="add-order-form-btn"><i class="fa fa-plus"></i> {{__('messages.add_order')}}</button>

                            </form>

                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                    @if ($client->orders->count() > 0)

                        <div class="box box-primary">

                            <div class="box-header">

                                <h3 class="box-title" style="margin-bottom: 10px">{{__('messages.previous_orders')}}
                                    <small>{{ $orders->total() }}</small>
                                </h3>

                            </div><!-- end of box header -->

                            <div class="box-body">

                                @foreach ($orders as $order)

                                    <div class="panel-group">

                                        <div class="panel panel-success">

                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" href="#{{ $order->created_at->format('d-m-Y-s') }}">{{ $order->created_at->toFormattedDateString() }}</a>
                                                </h4>
                                            </div>

                                            <div id="{{ $order->created_at->format('d-m-Y-s') }}" class="panel-collapse collapse">

                                                <div class="panel-body">

                                                    <ul class="list-group">
                                                        @foreach ($order->products as $product)
                                                            <li class="list-group-item">{{ $product->name }}</li>
                                                        @endforeach
                                                    </ul>

                                                </div><!-- end of panel body -->

                                            </div><!-- end of panel collapse -->

                                        </div><!-- end of panel primary -->

                                    </div><!-- end of panel group -->

                                @endforeach

                                {{ $orders->links() }}

                            </div><!-- end of box body -->

                        </div><!-- end of box -->

                    @endif

                </div><!-- end of col -->

            </div><!-- end of row -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
