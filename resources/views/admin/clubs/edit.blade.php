@extends('admin.layouts.main')
@section('title', 'Edit')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Clubs', 'value' => "Edit Club", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">

                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Edit Club Form Layout
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" action="{{ route('club.update', ['id' => $club->id]) }}"
                          enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Name Club:</label>
                                        <input type="text" name="club_name" class="form-control" id="exampleInputEmail1"
                                               placeholder="Enter Name Club" value="{{ $club->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label>DESCRIPTION:</label>
                                        <textarea name="description"
                                                  class="form-control">{{ $club->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Create Date:</label>
                                        <input type="date" name="create_date" class="form-control"
                                               id="exampleInputEmail1"
                                               placeholder="Enter Create Date" value="{{ $club->date_thanh_lap }}">
                                    </div>
                                    <div class="form-group">
                                        <label>FACEBOOK:</label>
                                        <input type="text" name="facebook" class="form-control" id="exampleInputEmail1"
                                               placeholder="Enter Facebook" value="{{ $club->link_fb }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="card card-warning">
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputFile">File ảnh</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" id="file" onchange="preview_image(event)"
                                                               class="custom-file-input" name="image_url">
                                                        <label class="custom-file-label" for="exampleInputFile">Chọn
                                                            ảnh</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="custom-file" id="preview">
                                                        <img src="https://drive.google.com/uc?export=view&id={{ $club->image_url }}" onerror="this.src='{{ asset('assets/admin/images/items/no-image.jpg') }}'" width="400px" height="400px" id="output_image"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @error('image_url')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <!-- /.card-body -->
                                    </div>
                                </div>
                            </div>

                            <div class="kt-portlet__foot">
                                    <div class="kt-form__actions">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <a href="{{route('club.index')}}" class="btn btn-secondary">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </form>
                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function preview_image(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('output_image');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

    </script>
@endsection
