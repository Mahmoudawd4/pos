@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{ __('messages.clients') }}</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{__('messages.dashboard')}}</a></li>
                <li class="active">{{ __('messages.clients') }}</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">{{ __('messages.clients') }} <small>{{ $clients->total() }}</small></h3>

                    <form action="{{ route('dashboard.clients.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="{{__('messages.search')}}" value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> {{__('messages.search')}}</button>
                                @if (auth()->user()->hasPermission('create_clients'))
                                    <a href="{{ route('dashboard.clients.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('messages.add')}}</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>{{ __('messages.add')}}</a>
                                @endif
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($clients->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('messages.name')}}</th>
                                <th>{{__('messages.phone')}}</th>
                                <th>{{__('messages.address')}}</th>
                                <th>{{__('messages.add_order')}}</th>
                                <th>{{__('messages.action')}}</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($clients as $index=>$client)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $client->name }}</td>
                                {{-- <td>{{ is_array($client->phone) ? implode($client->phone, '-') : $client->phone }}</td> --}}
                                {{-- <td>@foreach ($client->phone  as $ph)
                                    {{ $ph}}
                                @endforeach</td> --}}
                                {{-- <td>{{implode($client->phone ,'-')}}</td> --}}

                                <td>{{ $client->phone[0]}}</td>
                                    <td>{{ $client->address }}</td>
                                    <td>
                                        @if (auth()->user()->hasPermission('create_orders'))
                                            <a href="{{ route('dashboard.clients.orders.create', $client->id) }}" class="btn btn-primary btn-sm">{{__('messages.add_order')}}</a>
                                        @else
                                            <a href="#" class="btn btn-primary btn-sm disabled">{{__('messages.add_order')}}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if (auth()->user()->hasPermission('update_clients'))
                                            <a href="{{ route('dashboard.clients.edit', $client->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> {{__('messages.edit')}}</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> {{__('messages.edit')}}</a>
                                        @endif
                                        @if (auth()->user()->hasPermission('delete_clients'))
                                            <form action="{{ route('dashboard.clients.destroy', $client->id) }}" method="post" style="display: inline-block">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> {{__('messages.delete')}}</button>
                                            </form><!-- end of form -->
                                        @else
                                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>{{ __('messages.delete')}}</button>
                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>

                        </table><!-- end of table -->

                        {{ $clients->appends(request()->query())->links() }}

                    @else

                        <h2>{{__('messages.no_data_found')}}</h2>

                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
