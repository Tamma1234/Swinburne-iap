@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Company',
      'value' => "Create Company", 'value2' => ""])
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Create Company
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" id ="jobCompanyStore"
                          enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Company Name:</label>
                                        <input type="text" class="form-control" name="name" placeholder="Vi du: Swinbunre">
                                    </div>
                                    <div class="form-group">
                                        <label>Link Website:</label>
                                        <input type="text" class="form-control" name="website" placeholder="Vi du: Swinbunre">
                                    </div>
                                    <div class="form-group">
                                        <label>Address:</label>
                                        <textarea class="form-control" name="address" placeholder="Ví dụ: Ha Noi"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelectd">Bussiness Level</label>
                                        <select class="form-control" id="exampleSelectd" name="level">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelectd">Engagement Level</label>
                                        <div class="form-group" style="margin-bottom: 0px">
                                            <div class="kt-checkbox">
                                                <label class="kt-checkbox" style="width: 150px">
                                                    <input type="checkbox"> MOU
                                                    <span></span>
                                                </label>
                                                <label class="kt-checkbox" style="width: 170px">
                                                    <input type="checkbox"> Mentor/ Guest Speaker
                                                    <span></span>
                                                </label>
                                                <label class="kt-checkbox" style="width: 130px">
                                                    <input type="checkbox"> Study Tour
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="kt-checkbox">
                                                <label class="kt-checkbox" style="width: 150px">
                                                    <input type="checkbox" > Project
                                                    <span></span>
                                                </label>
                                                <label class="kt-checkbox" style="width: 170px">
                                                    <input type="checkbox"> Internship
                                                    <span></span>
                                                </label>
                                                <label class="kt-checkbox" style="width: 170px">
                                                    <input type="checkbox"> Student Employment
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelectd">Choose Field of activity</label>
                                        <select class="form-control" id="exampleSelectd" name="level">
                                            <option value="">All</option>
                                            <option value="1">CNNT</option>
                                            <option value="2">Bussiness</option>
                                            <option value="3">Media</option>
                                            <option value="4">Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Note:</label>
                                        <input type="text" min="0" class="form-control" name="note" placeholder="Ví dụ: Công ty đang cần tuyền 5 ứng viên">
                                    </div>
                                    <div class="form-group">
                                        <label>Activity History:</label>
                                        <input type="text" min="0" class="form-control" name="activity_history" placeholder="Ví dụ: Thành lập 2010">
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Name:</label>
                                        <input type="text" min="0" class="form-control" name="contact_name" placeholder="Ví dụ: MR.Tuyen">
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Phone:</label>
                                        <input type="number" class="form-control" name="contact_phone" placeholder="ví dụ: 0986888888">
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Email:</label>
                                        <input type="text" class="form-control" name="contact_email" placeholder="ví dụ:sonnt115@gmail.com">
                                    </div>
                                    <div class="form-group">
                                        <label>Communication Status</label>:</label>
                                        <input type="text" class="form-control" name="communication_status" placeholder="ví dụ:Leader">
                                    </div>

                                    <div class="form-group">
                                        <label>Engagement Status:</label>
                                        <input type="text" class="form-control" name="engagement_status" placeholder="">
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
                                                               class="custom-file-input" name="logo_url">
                                                        <label class="custom-file-label" for="exampleInputFile">Chọn
                                                            ảnh</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="custom-file" id="preview">
                                                        <img src="" onerror="this.src='{{ asset('assets/admin/images/items/no-image.jpg') }}'" width="400px" height="400px" id="output_image"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @error('image_url')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="form-group">
                                            <label>Descripton:</label>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="summernote" id="kt_summernote_2" name="des_vi"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Descripton English:</label>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="summernote" id="kt_summernote_3" name="des_en"></div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="{{route('jobs.index')}}" type="reset"
                                           class="btn btn-secondary">Cancel</a>
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

        function previewGallery(input) {
            const preview = document.getElementById('preview-view');

            const {
                files
            } = input;
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    const img = document.createElement('img');
                    const text = document.createElement('span');
                    const nodeText = document.createTextNode('X');
                    img.src = e.target.result;
                    div.appendChild(img);
                    text.appendChild(nodeText);
                    div.appendChild(text);
                    div.appendChild(img);
                    preview.appendChild(div);
                    // console.log(array.length);
                    $('span').click(function() {
                        jQuery(this).closest('div').remove();
                    });
                }
                reader.readAsDataURL(file);
            })
        }

        function preview_image(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('output_image');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        $(document).ready(function () {
            $(".kt-checkbox-inline").hide();
            $('#free_size').on("click", function () {
                $(".kt-checkbox-inline").hide();
                let checkboxes = document.getElementsByName('size[]');
                for (let i = 0; i < checkboxes.length; i++){
                    checkboxes[i].checked = false;
                }
            });

            $('#many_size').on("click", function () {
                $(".kt-checkbox-inline").show();
            });
        })

        $(document).ready(function() {
            // Initialize Summernote
            $('.summernote').summernote();

            // Handle form submission
            $('#jobCompanyStore').on('submit', function(e) {
                e.preventDefault();

                // Create FormData object
                var formData = new FormData(this);

                // Get Summernote content and append to formData
                formData.append('des_vi', $('#kt_summernote_2').summernote('code'));
                formData.append('des_en', $('#kt_summernote_3').summernote('code'));

                // Send data via AJAX
                $.ajax({
                    url: "{{ route('jobs.company.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,  // Do not process data (necessary for FormData)
                    contentType: false,  // Do not set content type (necessary for FormData)
                    success: function(response) {
                        // Notify success and redirect
                        alert('Company information updated successfully');
                        window.location.href = '{{ route('jobs.company') }}'; // Redirect to job index page
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // Handle validation errors
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, errorMessages) {
                                // Find the input or textarea with the name attribute matching the key
                                var element = $('[name="' + key + '"]');

                                // Append the error message to the parent form-group
                                element.closest('.form-group').append('<div class="alert alert-solid-danger alert-bold">' + errorMessages[0] + '</div>');
                            });
                        } else {
                            // General error message
                            alert('Error occurred while updating company information');
                        }
                    }
                });
            });
        });
    </script>
@endsection
