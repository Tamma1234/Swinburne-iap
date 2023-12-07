@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Clubs', 'value' => "Create Management", 'value2' => ""])

    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Add Management
                    </h3>
                </div>
            </div>

            <!--begin::Form-->
            <form class="kt-form kt-form--label-right" action="{{ route('update.management') }}" method="post">
                @csrf
                <div class="kt-portlet__body">
                    <div class="form-group row">
                        <input type="hidden" value="{{ $id }}" name="club_id">
                        <div class="col-lg-6">
                            <label>Choose Management:</label>
                            <select name="permission" id="" class="form-control">
                                <option value="1">Chairperson</option>
                                <option value="2">Vice President</option>
                                <option value="3">Personal</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label>Add Student:</label>
                            <select class="form-control kt-selectpicker" data-live-search="true" name="user_code">
                                    @foreach($users as $item)
                                        <option data-tokens="ketchup mustard" value="{{ $item->user_code }}">{{ $item->user_code .' - '. $item->user_surname . ' '.
                                            $item->user_middlename .' '. $item->user_givenname }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-9 ml-lg-auto">
                                <button type="submit" class="btn btn-brand">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!--end::Form-->
        </div>

    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/admin/js/pages/crud/forms/widgets/bootstrap-select.js') }}"
            type="text/javascript"></script>
@endsection
