@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Items',
      'value' => "Edit Item", 'value2' => ""])
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Edit Items Form Layout
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" action="{{route('items.update', ['id' => $item->id])}}"
                          enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Name Item:</label>
                                        <input type="text" class="form-control" name="name_item"
                                               value="{{ $item->name_item }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Description:</label>
                                        <textarea class="form-control"
                                                  name="description">{{ $item->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelectd">Choose Categories</label>
                                        <select class="form-control" id="exampleSelectd" name="cate_id">
                                            @foreach($cates as $cate)
                                                <option
                                                    {{ $cate->id == $item->cate_id ? 'selected' : '' }} value="{{ $cate->id }}">{{ $cate->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Gold:</label>
                                        <input type="number" min="0" class="form-control" name="gold"
                                               value="{{ $item->gold }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Quantity:</label>
                                        <input type="number" min="0" class="form-control" name="quantity"
                                               value="{{ $item->quantity }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Choose Size:</label>
                                        <div class="col-9 mt-2">
                                            <div class="kt-radio-inline">
                                                <label class="kt-radio kt-radio--bold kt-radio--brand col-md-4">
                                                    <input type="radio" name="status" id="free_size" value="0" {{ $item->status == 0 ? "checked" : "" }}> Freesize
                                                    <span></span>
                                                </label>
                                                <label class="kt-radio kt-radio--bold kt-radio--brand">
                                                    <input type="radio" name="status" id="many_size" value="1" {{ $item->status == 1 ? "checked" : "" }}>
                                                    Many Sizes
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-9">
                                            <div class="kt-checkbox-inline">
                                                @foreach($sizes as $size)
                                                    <label class="kt-checkbox">
                                                        <input type="checkbox" name="size[]" {{ $item->size->contains('id', $size->id) ? 'checked' : '' }}
                                                               value="{{ $size->id }}"> {{ $size->name }}
                                                        <span></span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
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
                                                               class="custom-file-input" name="images">
                                                        <label class="custom-file-label" for="exampleInputFile">Chọn
                                                            ảnh</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="custom-file" id="preview">
                                                        <img src="https://drive.google.com/uc?export=view&id={{ $item->images }}"
                                                             onerror="this.src='{{ asset('assets/admin/images/items/no-image.jpg') }}'"
                                                             width="400px" height="400px" id="output_image"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @error('image_url')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="form-group">
                                            <label for="exampleInputFile">Thư viện ảnh</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" multiple id="galary"
                                                           onchange="previewGallery(this)"
                                                           class="custom-file-input" name="gallery[]">
                                                    <label class="custom-file-label" for="exampleInputFile">Chọn
                                                        ảnh</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" style="height: 200px">
                                            <div class="galary" id="preview-view">
                                                @foreach($item->showGallery as $gallery)
                                                    <div>
                                                        <span>X</span>
                                                        <img src="{{ asset("item_gallery/$gallery->file_name") }}" width="100px" height="100px" alt="">
                                                    </div>
                                                @endforeach
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
                                        <a href="{{route('items.list')}}" type="reset"
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
                reader.onload = function (e) {
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
                    $('span').click(function () {
                        jQuery(this).closest('div').remove();
                    });
                }
                reader.readAsDataURL(file);
            })
        }

        function preview_image(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('output_image');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        $(document).ready(function () {

            if ($("#free_size").is(":checked")) {
                $(".kt-checkbox-inline").hide();
            } else {
                $(".kt-checkbox-inline").show();
            }
            $("#free_size").on("click", function () {
                $(".kt-checkbox-inline").hide();
            });
            $("#many_size").on("click", function () {
                $(".kt-checkbox-inline").show();
            });
        })
    </script>

@endsection
