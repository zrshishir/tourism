@extends('auth.auth')



@section('content')


    <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-9">
            <section class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('common.unsubscribe')}}</h3>
                </div>

                <div class="box-body">

                    <div class="text-center">
                        Your email <i>{!! $email->email !!}</i> have been successfully {{trans('common.unsubscribe')}}d.
                    </div>

                </div>

            </section>
        </div>

    </div>


@endsection