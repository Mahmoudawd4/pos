@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">{{__('messages.users')}} <small></small></h3>

                    <form action="{{ route('dashboard.users.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="{{__('messaes.search')}}" value="{{ request()->search }}">
                                {{-- <input type="text" name="search" class="form-control" placeholder="{{__('messages.search')}}" value=""> --}}

                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>{{__('messages.search')}}</button>
                                @if (auth()->user()->hasPermission('create_users'))
                            <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>{{__('messages.create')}}</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> {{__('messages.create')}}</a>
                                @endif
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($users->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                            <th>{{__('messages.first_name')}}</th>
                                <th>{{__('messages.last_name')}}</th>
                                <th>{{__('messages.email')}}</th>
                                <th>{{__('messages.image')}}</th>
                                <th>{{__('messages.action')}}</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><img src="{{ $user->image_path }}" style="width: 100px;" class="img-thumbnail" alt=""></td>

                                    <td>
                                         @if (auth()->user()->hasPermission('update_users'))
                                            <a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>{{__('messages.edit')}}</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>{{__('messages.edit')}}</a>
                                        @endif
                                        @if(auth()->user()->hasPermission('delete_users'))
                                            <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="post" style="display: inline-block">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> {{__('messages.delete')}}</button>
                                            </form><!-- end of form -->
                                        @else
                                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>{{__('messages.delete')}}</button>
                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>

                        </table><!-- end of table -->

                        {{ $users->appends(request()->query())->links() }}

                    @else

                        <h2>{{__('messages.no_data_found')}}</h2>

                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
