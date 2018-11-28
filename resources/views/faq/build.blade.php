<html xmlns="http://www.w3.org/1999/xhtml">
<head>



    <link href="{!! asset('/plugins/iconmoon/styles.css') !!}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/builder.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('/plugins/forms/css/from-builder.css') !!}">
    <!--[if (gte mso 9)|(IE)]>
    <style type="text/css">
        table {
            border-collapse: collapse;
        }
    </style>
    <![endif]-->

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type="text/javascript" src="{!! asset('tinymce/tinymce.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/editor.js') !!}"></script>

    <script type="text/javascript"
            src="{!! asset('plugins/forms/js/uniform.min.js') !!}"></script>

    <script type="text/javascript" src="{!! asset('plugins/colorpicker/colorpicker.js') !!}"></script>
    <link rel="stylesheet" type="text/css" href="{!! asset('plugins/colorpicker/colorpicker.css') !!}">

    <script type="text/javascript" src="{!! asset('js/builder.js') !!}"></script>


</head>
<body data-gr-c-s-loaded="true">
<topbar>

    <div class="left">
        @if(!isset($faq))
            {!! Form::open(['url' => "faq", 'novalidate' => 'novalidate', 'class' => 'ajax_upload_form form-validate-jquery', 'id'=>'template', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'No', 'files' => true]) !!}
        @else
            {!! Form::model($faq,['method' =>'PUT', 'url' => ["faq",$faq->id],'id'=>'faq', 'role' => 'form', 'data-toggle' => 'form-ajax', 'data-url' => 'Yes', 'files' => true]) !!}
        @endif
        {{--<form action="" method="POST" class="ajax_upload_form form-validate-jquery" novalidate="novalidate">--}}
        {{--<input type="hidden" name="_token" value="YJDBHRIaLlSVtEzk4t1GFTQdDL9bA3klDNhSdzCe">--}}
        <input type="text" name="name" value="{{ (isset($template)) ? $template->name : 'Untitled template' }}" class="required" aria-required="true">
        <input type="hidden" name="source" value="builder" class="required" aria-required="true">
        <textarea class="hide template_content" name="template" ></textarea>
        <button class="btn btn-primary mr-5">Save</button>
        <a href="{!! url('htmlTemplate') !!}" class="btn bg-slate">Cancel</a>
        {{--</form>--}}
        {!! Form::close() !!}
    </div>
    <div class="right">

    </div>

    @if(! isset($faq))
    <script>
        $(document).ready(function () {
            var column = new Array();
            column['1'] = 'single_text_row';
            column['2'] = 'two_image_text_columns';
            column['3'] = 'three_image_text_columns';

            var url_data = '{{ $column }}';

            var datas = url_data.replace('_column', '').split('_');

            insertElement("full_width_banner");

            for (var i = 0; i < datas.length; i++) {
                insertElement(column[datas[i]]);
            }

            insertElement("footer");

        });
    </script>
    @endif


</topbar>

<div title="Remove row" class="remove_block">
    <i class="icon-cross2"></i>
</div>

<table class="hide">
    <tbody>
    <tr class="block full_width_banner">
        <td>
            <table class="" align="center">
                <tbody>
                <tr>
                    <td class="full-width-image">
                        <img src="http://demo.acellemail.com/images/icons/image_placeholder_wide.png" width="600"
                             alt="">
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr class="block single_text_row">
        <td class="one-column">
            <table width="100%">
                <tbody>
                <tr>
                    <td class="inner contents">
                        <p class="h1">Lorem ipsum dolor sit amet</p>
                        <p>Maecenas sed ante pellentesque, posuere leo id, eleifend dolor. Class aptent taciti sociosqu
                            ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent laoreet malesuada
                            cursus. Maecenas scelerisque congue eros eu posuere. Praesent in felis ut velit pretium
                            lobortis rhoncus ut erat.</p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr class="block two_image_text_columns">
        <td class="two-column">

            <table width="100%">
                <tr>
                    <td width="50%" valign="top">

                    <div class="column">
                        <table width="100%">
                            <tbody>
                            <tr>
                                <td class="inner">
                                    <table class="contents">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <img src="http://demo.acellemail.com/images/icons/image_placeholder_medium.png"
                                                     width="280" alt="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text">
                                                <p>Maecenas sed ante pellentesque, posuere leo id, eleifend dolor. Class aptent
                                                    taciti sociosqu ad litora torquent per conubia nostra, per inceptos
                                                    himenaeos.</p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

            </td>
            <td width="50%" valign="top">

            <div class="column">
                <table width="100%">
                    <tbody>
                    <tr>
                        <td class="inner">
                            <table class="contents">
                                <tbody>
                                <tr>
                                    <td>
                                        <img src="http://demo.acellemail.com/images/icons/image_placeholder_medium.png"
                                             width="280" alt="">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text">
                                        <p>Maecenas sed ante pellentesque, posuere leo id, eleifend dolor. Class aptent
                                            taciti sociosqu ad litora torquent per conubia nostra, per inceptos
                                            himenaeos. </p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            </td>
            </tr>
            </table>

        </td>
    </tr>
    <tr class="block three_image_text_columns">
        <td class="three-column">

            <table width="100%">
                <tr>
                    <td width="200" valign="top">

            <div class="column">
                <table width="100%">
                    <tbody>
                    <tr>
                        <td class="inner">
                            <table class="contents">
                                <tbody>
                                <tr>
                                    <td>
                                        <img src="http://demo.acellemail.com/images/icons/image_placeholder_square.png"
                                             width="180" alt="">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text">
                                        <p>Scelerisque congue eros eu posuere. Praesent in felis ut velit pretium
                                            lobortis rhoncus ut erat.</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            </td>
            <td width="200" valign="top">

            <div class="column">
                <table width="100%">
                    <tbody>
                    <tr>
                        <td class="inner">
                            <table class="contents">
                                <tbody>
                                <tr>
                                    <td>
                                        <img src="http://demo.acellemail.com/images/icons/image_placeholder_square.png"
                                             width="180" alt="">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text">
                                        <p>Scelerisque congue eros eu posuere. Praesent in felis ut velit pretium
                                            lobortis rhoncus ut erat.</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            </td>
            <td width="200" valign="top">

            <div class="column">
                <table width="100%">
                    <tbody>
                    <tr>
                        <td class="inner">
                            <table class="contents">
                                <tbody>
                                <tr>
                                    <td>
                                        <img src="http://demo.acellemail.com/images/icons/image_placeholder_square.png"
                                             width="180" alt="">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text">
                                        <p>Scelerisque congue eros eu posuere. Praesent in felis ut velit pretium
                                            lobortis rhoncus ut erat.</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            </td>
            </tr>
            </table>

        </td>
    </tr>
    <tr class="block list_image_left">
        <td class="left-sidebar">

            <table width="100%">
                <tr>
                    <td width="100">


            <div class="column left">
                <table width="100%">
                    <tbody>
                    <tr>
                        <td class="inner">
                            <img src="http://demo.acellemail.com/images/icons/image_placeholder_square.png" width="80"
                                 alt="">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            </td>
            <td width="500">


            <div class="column right">
                <table width="100%">
                    <tbody>
                    <tr>
                        <td class="inner contents">
                            <p>Scelerisque congue eros eu posuere. Praesent in felis ut velit pretium lobortis rhoncus
                                ut erat.</p>Praesent laoreet malesuada cursus. Maecenas scelerisque congue eros eu
                            posuere. Praesent in felis ut velit pretium lobortis rhoncus ut erat. <a href="#">Read&nbsp;on</a>
                            <p></p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            </td>
            </tr>
            </table>


        </td>
    </tr>
    <tr class="block list_image_right">
        <td class="right-sidebar" dir="rtl">

            <table width="100%" dir="rtl">
                <tr>
                    <td width="100">


            <div class="column left" dir="ltr">
                <table width="100%">
                    <tbody>
                    <tr>
                        <td class="inner contents">
                            <img src="http://demo.acellemail.com/images/icons/image_placeholder_square.png" width="80"
                                 alt="">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            </td>
            <td width="500">


            <div class="column right" dir="ltr">
                <table width="100%">
                    <tbody>
                    <tr>
                        <td class="inner contents">
                            <p>Maecenas sed ante pellentesque, posuere leo id, eleifend dolor. Class aptent taciti
                                sociosqu ad litora torquent per conubia nostra. <a href="#">Per&nbsp;inceptos</a></p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            </td>
            </tr>
            </table>


        </td>
    </tr>
    <tr class="block three_heading_columns">
        <td class="three-column">

            <table width="100%">
                <tr>
                    <td width="200" valign="top">


            <div class="column">
                <table width="100%">
                    <tbody>
                    <tr>
                        <td class="inner contents">
                            <p class="h2">Heading</p>
                            <p>Class eleifend aptent taciti sociosqu ad litora torquent conubia</p>
                            <p><a href="#">Read more</a></p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            </td>
            <td width="200" valign="top">


            <div class="column">
                <table width="100%">
                    <tbody>
                    <tr>
                        <td class="inner contents">
                            <p class="h2">Heading</p>
                            <p>Class eleifend aptent taciti sociosqu ad litora torquent conubia</p>
                            <p><a href="#">Read more</a></p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            </td>
            <td width="200" valign="top">


            <div class="column">
                <table width="100%">
                    <tbody>
                    <tr>
                        <td class="inner contents">
                            <p class="h2">Heading</p>
                            <p>Class eleifend aptent taciti sociosqu ad litora torquent conubia</p>
                            <p><a href="#">Read more</a></p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            </td>
            </tr>
            </table>


        </td>
    </tr>
    <tr class="block footer">
        <td class="one-column">
            <table width="100%">
                <tbody>
                <tr>
                    <td class="inner contents">
                        <hr>
                        <p>
                            <em>Copyright © {CONTACT_NAME}, All rights reserved.</em><br>
                            <br>
                            <strong>Our mailing address is:</strong><br>
                            <a href="mailto:{CONTACT_EMAIL}">{CONTACT_EMAIL}</a><br>
                            <br>
                            Want to change how you receive these emails?<br>
                            You can <a href="{UPDATE_PROFILE_URL}">update your preferences</a> or <a
                                    href="{UNSUBSCRIBE_URL}">unsubscribe from this list</a>
                        </p>
                        <hr>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr class="block image_right">
        <td class="right-image" dir="rtl">

            <table width="100%" dir="rtl">
                <tr>
                    <td width="245">


            <div class="column left" dir="ltr">
                <table width="100%">
                    <tbody>
                    <tr>
                        <td class="inner contents">
                            <img src="http://demo.acellemail.com/images/icons/image_placeholder_medium.png" width="220"
                                 alt="">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            </td>
            <td width="350">


            <div class="column right" dir="ltr">
                <table width="100%">
                    <tbody>
                    <tr>
                        <td class="inner contents">
                            <p class="h2">Heading</p>
                            <p>Maecenas sed ante pellentesque, posuere leo id, eleifend dolor. Class aptent taciti
                                sociosqu ad litora torquent per conubia nostra. <a href="#">Per&nbsp;inceptos</a></p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            </td>
            </tr>
            </table>


        </td>
    </tr>
    <tr class="block image_left">
        <td class="left-image">

            <table width="100%">
                <tr>
                    <td width="245">


            <div class="column left">
                <table width="100%">
                    <tbody>
                    <tr>
                        <td class="inner contents">
                            <img src="http://demo.acellemail.com/images/icons/image_placeholder_medium.png" width="220"
                                 alt="">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            </td>
            <td width="350">


            <div class="column right">
                <table width="100%">
                    <tbody>
                    <tr>
                        <td class="inner contents">
                            <p class="h2">Heading</p>
                            <p>Maecenas sed ante pellentesque, posuere leo id, eleifend dolor. Class aptent taciti
                                sociosqu ad litora torquent per conubia nostra. <a href="#">Per&nbsp;inceptos</a></p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            </td>
            </tr>
            </table>


        </td>
    </tr>
    </tbody>
</table>


<toolbox>
    <div class="left-box ui-sortable">
        <div class="block tool-item ui-sortable-handle" template="full_width_banner">
            <i class="icon-file-picture"></i>
            <label>Full-width banner</label>
        </div>
        <div class="block tool-item ui-sortable-handle" template="single_text_row">
            <i class="icon-paragraph-left2"></i>
            <label>Single text row</label>
        </div>
        <div class="block tool-item ui-sortable-handle" template="two_image_text_columns">
            <i class="icon-newspaper2"></i>
            <label>Two columns</label>
        </div>
        <div class="block tool-item ui-sortable-handle" template="three_image_text_columns">
            <i class="icon-stack-picture"></i>
            <label>Three columns</label>
        </div>
        <div class="block tool-item ui-sortable-handle" template="list_image_left">
            <i class="icon-list"></i>
            <label>Image left list</label>
        </div>
        <div class="block tool-item ui-sortable-handle" template="list_image_right">
            <i class="icon-list" style="
                    -ms-transform: rotate(180deg); /* IE 9 */
                    -webkit-transform: rotate(180deg); /* Chrome, Safari, Opera */
                    transform: rotate(180deg);"></i>
            <label>Image right list</label>
        </div>
        <div class="block tool-item ui-sortable-handle" template="three_heading_columns">
            <i class="icon-stack-text"></i>
            <label>Three text columns</label>
        </div>
        <div class="block tool-item ui-sortable-handle" template="footer">
            <i class="icon-ipad"></i>
            <label>Footer</label>
        </div>
        <div class="block tool-item ui-sortable-handle" template="image_right">
            <i class="icon-newspaper" style="
                    -ms-transform: rotate(180deg); /* IE 9 */
                    -webkit-transform: rotate(180deg); /* Chrome, Safari, Opera */
                    transform: rotate(180deg);"></i>
            <label>Image right</label>
        </div>
        <div class="block tool-item ui-sortable-handle" template="image_left">
            <i class="icon-newspaper"></i>
            <label>Image left</label>
        </div>
    </div>
</toolbox>

<editor>
    <div style="float: right">
        <button class="btn bg-slate close-editor"><i class="icon-cross2"></i></button>
    </div>

    <div class="tab">
        <ul>
            <li class="active">
                <a href="#builder"><i class="icon-pencil5"></i> Builder</a>
            </li>
            <li>
                <a href="#design"><i class="icon-toggle"></i> Row style</a>
            </li>
        </ul>

        <div class="tab-container">
            <div class="tab-pane active" id="builder">

                <textarea class="builder-editor pull-right" id="mce_0"
                          aria-hidden="true"></textarea>
                <br>
                <div class="tags_list">
                    <label class="text-semibold text-teal">Required tags:</label>
                    <br>

                </div>

                <br>

                <div class="tags_list">
                    <label class="text-semibold text-teal">Available tags:</label>
                    <br>
                    <a data-popup="tooltip" title="Click to insert tag" href="javascript:;"
                       class="btn btn-default text-semibold btn-xs insert_tag_button"
                       data-tag-name="{SUBSCRIBER_EMAIL}">
                        {SUBSCRIBER_EMAIL}
                    </a>


                </div>
            </div>
            <div class="tab-pane" id="design">
                <div class="form-group">
                    <label>Row background</label>
                    <span class="color" id="background-color"></span>
                </div>
                <div class="form-group">
                    <label>Text color</label>
                    <span class="color" id="text-color"></span>
                </div>
                <div class="form-group">
                    <label>Padding</label>
                    <table>
                        <tbody>
                        <tr>
                            <td><input type="text" name="padding-top" placeholder="top"></td>
                            <td><input type="text" name="padding-right" placeholder="right"></td>
                            <td><input type="text" name="padding-bottom" placeholder="bottom"></td>
                            <td><input type="text" name="padding-left" placeholder="left"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <label>Margin</label>
                    <table>
                        <tbody>
                        <tr>
                            <td><input type="text" name="margin-top" placeholder="top"></td>
                            <td><input type="text" name="margin-right" placeholder="right"></td>
                            <td><input type="text" name="margin-bottom" placeholder="bottom"></td>
                            <td><input type="text" name="margin-left" placeholder="left"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</editor>

<leftbar>
    <div class="container">
        <h1>Elements</h1>
        <div class="toolbox-container">
            <div class="left-box ui-sortable">
                <div class="block tool-item ui-sortable-handle" template="full_width_banner">
                    <i class="icon-file-picture"></i>
                    <label>Full-width banner</label>
                </div>
                <div class="block tool-item ui-sortable-handle" template="single_text_row">
                    <i class="icon-paragraph-left2"></i>
                    <label>Single text row</label>
                </div>
                <div class="block tool-item ui-sortable-handle" template="two_image_text_columns">
                    <i class="icon-newspaper2"></i>
                    <label>Two columns</label>
                </div>
                <div class="block tool-item ui-sortable-handle" template="three_image_text_columns">
                    <i class="icon-stack-picture"></i>
                    <label>Three columns</label>
                </div>
                <div class="block tool-item ui-sortable-handle" template="list_image_left">
                    <i class="icon-list"></i>
                    <label>Image left list</label>
                </div>
                <div class="block tool-item ui-sortable-handle" template="list_image_right">
                    <i class="icon-list" style="
                    -ms-transform: rotate(180deg); /* IE 9 */
                    -webkit-transform: rotate(180deg); /* Chrome, Safari, Opera */
                    transform: rotate(180deg);"></i>
                    <label>Image right list</label>
                </div>
                <div class="block tool-item ui-sortable-handle" template="three_heading_columns">
                    <i class="icon-stack-text"></i>
                    <label>Three text columns</label>
                </div>
                <div class="block tool-item ui-sortable-handle" template="footer">
                    <i class="icon-ipad"></i>
                    <label>Footer</label>
                </div>
                <div class="block tool-item ui-sortable-handle" template="image_right">
                    <i class="icon-newspaper" style="
                    -ms-transform: rotate(180deg); /* IE 9 */
                    -webkit-transform: rotate(180deg); /* Chrome, Safari, Opera */
                    transform: rotate(180deg);"></i>
                    <label>Image right</label>
                </div>
                <div class="block tool-item ui-sortable-handle" template="image_left">
                    <i class="icon-newspaper"></i>
                    <label>Image left</label>
                </div>
            </div>
        </div>
    </div>
</leftbar>

@if(isset($faq))
    {!! $faq->faq !!}
@else
<content>

    <center class="wrapper">
        <div class="webkit">

            <table width="600" align="center">
                <tr>
                    <td>


            <table class="outer right-box ui-sortable" align="center">
                <tbody>

                </tbody>
            </table>

            </td>
            </tr>
            </table>


        </div>
    </center>
</content>
@endif

</body>
</html>
