@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{  __('messages.clients')  }}</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{__('messages.dashboard')}}</a></li>
                <li><a href="{{ route('dashboard.clients.index') }}"> {{  __('messages.clients')  }}</a></li>
                <li class="active">{{__('messages.edit')}}</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">{{__('messages.edit')}}</h3>
                </div><!-- end of box header -->
                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.clients.update', $client->id) }}" method="post">

                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div class="form-group">
                            <label>{{__('messages.name')}}</label>
                            <input type="text" name="name" class="form-control" value="{{ $client->name }}">
                        </div>

                        @for ($i = 0; $i < 2; $i++)
                            <div class="form-group">
                                <label>{{__('messages.phone')}}</label>
                                <input type="text" name="phone[]" class="form-control" value="{{ $client->phone[$i] ?? '' }}">
                            </div>
                        @endfor

                        <div class="form-group">
                            <label>{{__('messages.address')}}</label>
                            <textarea name="address" class="form-control">{{ $client->address }}</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> {{__('messages.edit')}}</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
