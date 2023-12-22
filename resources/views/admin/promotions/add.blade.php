@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Promotions',
      'value' => "Create", 'value2' => ""])
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Create Promotion Form Layout
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" action="{{route('promotion.store')}}"
                          enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Name:</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label class="">Start Date</label>
                                        <div class="input-group date">
                                            <input type="text" class="form-control" readonly value="dd/mm/yy" name="start_date"
                                                   id="kt_datetimepicker_3"/>
                                            <div class="input-group-append">
														<span class="input-group-text">
															<i class="la la-calendar glyphicon-th"></i>
														</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Percent:</label>
                                        <input type="number" class="form-control" name="percent" value="0">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="exampleSelectd">Choose Items</label>
                                        <select class="form-control" id="exampleSelectd" name="item_id">
                                            @foreach($items as $item)
                                                <option value="{{ $item->id }}">{{ $item->name_item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.card-header -->

                                    <div class="form-group">
                                        <label class="">End Date</label>
                                        <div class="input-group date">
                                            <input type="text" class="form-control" readonly value="dd/mm/yy" name="end_date"
                                                   id="kt_datetimepicker_2"/>
                                            <div class="input-group-append">
														<span class="input-group-text">
															<i class="la la-calendar glyphicon-th"></i>
														</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
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
