<div class="col-sm-12 col-md-12">
    <form action="{{route('search.bill')}}" method="post">
        @csrf
        <div id="example1_filter" class="dataTables_filter">
            <label>Mã sản phẩm:
                    <input type="search" class="form-control form-control-sm" placeholder=""
                aria-controls="example1" name="id">
            </label>
            <label>Tên khách hàng:
                    <input type="text" class="form-control form-control-sm" placeholder=""
                aria-controls="example1" name="full_name">
            </label>
            <label>Giá sản phẩm :
                    <input type="text" class="form-control form-control-sm" placeholder=""
                aria-controls="example1" name="price">
            </label>
            <label>Ngày đặt:
                    <input type="search" class="form-control form-control-sm" placeholder=""
                aria-controls="example1" name="date_order">
            </label>
            <label>Ngày kết thúc:
                <input type="search" class="form-control form-control-sm" placeholder=""
            aria-controls="example1" name="updated_at">
        </label>
            <button class="btn-search" style="color: blue;
            border: 1px solid;
            border-radius: 2px" type="submit">
            <i class="fa fa-search"></i>
            </button>
        </div>
  </form>                           
</div>