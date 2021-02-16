@extends('layouts.student_layout')
@section('content')
    <div class="container-fluid px-lg-4">
        <div class="row">
            <div class="col-md-12 mt-lg-4 mt-4">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Print PDF</h1>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">


                    {{--Print Form--}}

                    <div class="col-sm">
                        <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                            <div class="card-body">
                                <form method="POST" action="/print_file_cmd" enctype="multipart/form-data">
                                    @csrf
                                    {{-------------------File Upload Starts-----------------}}
                                    <div class="form-group row">
                                        <label for="first_name"
                                               class="col-md-4 col-form-label text-md-right display-3 font-weight-bold">{{ __('Upload File : ') }}</label>

                                        <div class="col-md-6">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input  @error('uploaded_file') is-invalid @enderror" id="uploaded_file" name="uploaded_file" >
                                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                                <div class="invalid-feedback font-weight-bold">{{ $errors->first('uploaded_file') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-------------------File Upload Ends-----------------}}


                                    {{-------------------Button Starts-----------------}}
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-danger">
                                                {{ __('Print') }}
                                            </button>
                                        </div>
                                    </div>
                                    {{-------------------Button Ends-----------------}}
                                </form>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>

    </div>


@endsection



{{--------------- File name show in Input Box JavaScript Starts -----------------}}
@section('filename_bootstrap_js')
    <script type="text/javascript">

        $('.custom-file input').change(function (e) {
            var files = [];
            for (var i = 0; i < $(this)[0].files.length; i++) {
                files.push($(this)[0].files[i].name);
            }
            $(this).next('.custom-file-label').html(files.join(', '));
        });

    </script>
@endsection
{{--------------- File name show in Input Box JavaScript Ends-----------------}}
