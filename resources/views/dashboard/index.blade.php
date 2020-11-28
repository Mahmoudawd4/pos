@extends('layouts.dashboard.app')

@section('content')


<div class="content-wrapper">

    <section class="content-header">
        <h1>
        {{__('messages.dashboard')}}
        </h1>

        <ol class="breadcrumb">
            <li class="active"><i class="fa fa-dashboard"></i><a href="{{ route('dashboard.index') }}"></a>{{__('messages.dashboard')}}</li>
            
        </ol>
    </section>

    <section class="content">
        <h1>thia is dashboard</h1>

    </section>

</div>




@endsection
