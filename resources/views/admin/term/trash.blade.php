@extends('admin.layouts.main')
@section('title', 'Trash')

@section('content')
    @include('admin.templates.content-header', ['name' => 'Swinburne', 'key' => 'Permissions',
      'value' => "Deleted Permission", 'value2' => ""])
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Table Term Trash Options
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin::Section-->
            <div class="kt-section">
                <div class="kt-section__content">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="example">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Term Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Fee Term</th>
                            <th>GC Term</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="tbody">
                        @foreach($terms as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->term_name}}</td>
                                <td>{{$item->startday}}</td>
                                <td>{{ $item->endday }}</td>
                                <td> @if ($item->phat_sinh_phi_ky ==  1)
                                        Đã phát sinh
                                    @else
                                        Phát sinh
                                    @endif
                                </td>
                                <td> @if ($item->phat_sinh_phi_gc ==  1)
                                        Đã phát sinh
                                    @else
                                        Phát sinh
                                    @endif
                                </td>
                                <td class="text-nowrap">
                                    <a href="{{ route('term.restore', ['id' => $item->id]) }}"  data-toggle="kt-tooltip" title="Restore"
                                       data-original-title="Edit"><i class="flaticon-refresh"></i>
                                    </a>
                                    <a href="{{ route('term.delete.completely', ['id' => $item->id]) }}" data-toggle="kt-tooltip" title="Delete it completely"
                                       data-original-title="Close"> <i class="flaticon-delete"></i> </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!--end::Section-->
        </div>
    </div>
@endsection
@section('script')
    <script>
      function restore() {
          alert("hello");
      }
    </script>
@endsection
