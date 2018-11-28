@extends('app')

@section('main-content')

    <div class="box box-default" style="margin-top: 0px">
        <!-- Tabs within a box -->
        <div class="box-header with-border">
            <h3 class="box-title pull-left">
                {{ $pageName }}
            </h3>
            
        </div>
        <div class="box-body">
            {!! Form::open(['url' => "payment_paystack",'id'=>'payment','class'=>'', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No', 'files' => true]) !!}

                @include('payment._form',['submit_button' => 'Submit'])

            {!! Form::close() !!}
        </div>
    </div>

@endsection        