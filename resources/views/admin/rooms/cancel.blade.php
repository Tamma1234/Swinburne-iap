@extends('admin.layouts.main')
@section('title', 'Create')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Group', 'value' => "List Group", 'value2' => ""])

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Cancel Booking
                </h3>
            </div>
            {{--            <div class="col-md-6 col-4 align-self-center" style="margin-left: 100px">--}}
            {{--                <div class="input-group date">--}}
            {{--                    <input type="text" class="form-control" readonly value="{{ $format }}" id="kt_datepicker_2">--}}
            {{--                    <input type="hidden" class="form-control date-format" readonly--}}
            {{--                           value="{{ Request::url()}}?date={{ $format }}" id="kt_datepicker_3">--}}
            {{--                    <div class="input-group-append">--}}
            {{--						<span class="input-group-text">--}}
            {{--							<i class="la la-calendar-check-o"></i>--}}
            {{--						</span>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
        <div class="kt-portlet__body" id="table-room">
            <!--begin::Section-->
            <div class="kt-section">
                <div class="kt-section__content">
                    <form action="{{ route('rooms.store.cancel', ['id' => $id]) }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <div class="form-group form-group-last">
                            <label for="exampleTextarea">Cancellation content</label>
                            <textarea class="form-control" id="exampleTextarea" name="des_cancel_room" rows="3"></textarea>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--end::Section-->
        </div>
    </div>
@endsection

