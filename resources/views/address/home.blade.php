@extends('app')

@section('htmlheader_title')
    Home
@endsection
            <!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>

@section('main-content')

    <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-9">
            <section class="box box-default">
                
                <div class="box-header with-border">
                    <h3 class="box-title">{{$pageName}}</h3>
                </div>

                <div class="box-body">

                    {!! Form::open(['url' => "/address", 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No']) !!}

                    @include('address._form',['submit_button' => 'Submit'])

                    {!! Form::close() !!}

                </div>
            </section>
        </div>

    </div>

     <script>
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor1');
        });
    </script>

@endsection