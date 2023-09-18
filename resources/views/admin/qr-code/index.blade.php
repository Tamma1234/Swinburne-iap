@extends('admin.layouts.main')
@section('title', 'Create')
@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Users', 'value' => "List User", 'value2' => ""])
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title text-center">
                    Event: <span class="text-primary">{{ $event->name_event }}</span>
                    <input type="hidden" id="event_id" value="{{ $event->id }}">
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div id="qr-reader" style="margin-left: 10px"></div>
                <div class="alert alert-danger" id="error_type" style="display: none;margin-left: 10px"></div>
            </div>
            <div class="col-md-7">
                <div class="kt-section__content" >
                    <table class="table table-bordered">
                        <thead class="thead-light">
                        <tr>
                            <th>STT</th>
                            <th>User Code</th>
                            <th>Full Name</th>
                            <th>Name Event</th>
                            <th>Relatives & Friends</th>
                            <th>Gold</th>
                            <th>Active</th>
                            <th>Type Person</th>
                        </tr>
                        </thead>
                        <tbody id="qr-reader-results">
                        <?php $i = 1; ?>
                        @foreach($student_event as $item)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->user_code }}</td>
                                <td>{{ $item->full_name }}</td>
                                <td>{{ $item->events ? $item->events->name_event : "" }}</td>
                                <th><input type="number" style="width: 50px" onchange="changeRelatives({{$item->id}})"
                                           id="relatives{{$item->id}}" value="{{ $item->relatives }}"></th>
                                <td>{{ $item->gold }}</td>
                                <td>@if($item->is_active == 1)
                                        <button type="button"
                                                class="btn btn-success btn-elevate btn-pill btn-elevate-air btn-sm">
                                            Attendance
                                        </button>
                                    @else
                                        <button type="button"
                                                class="btn btn-warning btn-elevate btn-pill btn-elevate-air btn-sm">
                                            Warning
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    <button type="button"
                                             class="btn btn-warning btn-elevate btn-pill btn-elevate-air btn-sm">
                                        {{ $item->type_person }}
                                    </button></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
            </div>
        </div>
        @endsection

        @section('script')
            <script src="{{ asset("assets/admin/js/html5-qrcode.min.js") }}"></script>
            <script>

                function changeRelatives(id) {
                    var relatives = $('#relatives' + id).val();
                    var _token = $("input[name='_token']").val();
                    $.ajax({
                        url: "{{ route('post.friend') }}",
                        method: 'POST',
                        data: {_token: _token, relatives: relatives, id: id},
                        success: function (data) {
                            // location.reload();
                        }
                    });
                }

                $(document).ready(function(){
                    function docReady(fn) {
                        // see if DOM is already available
                        if (document.readyState === "complete"
                            || document.readyState === "interactive") {
                            // call on next available tick
                            setTimeout(fn, 1);
                        } else {
                            document.addEventListener("DOMContentLoaded", fn);
                        }
                    }

                    docReady(function () {
                        var lastResult, countResults = 0;

                        function onScanSuccess(decodedText, decodedResult) {
                            if (decodedText !== lastResult) {
                                ++countResults;
                                lastResult = decodedText;
                                // Handle on success condition with the decoded message.
                                let result = `${decodedText}`, decodedResult;
                                var event_id = $('#event_id').val();
                                $.ajax({
                                    url: '{{ route('post.qr-code') }}',
                                    type: 'get',
                                    data: {result: result, event_id:event_id},
                                }).done(function (response) {
                                    if (!$.isEmptyObject(response.error_type)) {
                                        $("#error_type").html('');
                                        $("#error_type").css('display', 'block');
                                        $("#error_type").append(response.error_type);
                                    } else {
                                        $('#qr-reader-results').empty();
                                        $('#qr-reader-results').html(response);
                                    }
                                })
                            }
                        }

                        var html5QrcodeScanner = new Html5QrcodeScanner(
                            "qr-reader", {fps: 10, qrbox: 250});
                        html5QrcodeScanner.render(onScanSuccess);
                    });
                });
            </script>
@endsection

