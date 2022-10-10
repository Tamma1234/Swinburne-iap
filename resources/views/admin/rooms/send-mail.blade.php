<h3>Thông tin đặt phòng </h3>
<div>
    <div class="">
        <div class="aHl"></div>
        <div id=":g3" tabindex="-1"></div>
        <div id=":fs" class="ii gt">
            <div id=":fr" class="a3s aiL msg-8525905254478487520"><u></u>
                <div>
                    <h3>
                        Xin chào Anh/Chị phòng Hành chính
                    </h3>
                    <p>Em muốn đặt phòng để họp nhóm, mong Anh/Chị kiểm tra và duyệt phòng cho em ạ!</p>
                    <p>Thông tin phòng:</p>
                    <div class="m_-8525905254478487520table-responsive">
                        <table border="1" style="width:50%;margin-left:200px">
                            <tbody>
                            <tr>
                                <th>Room Name</th>
                                <td>{{$room_name}}</td>
                            </tr>
                            <tr>
                                <th>Area Name</th>
                                <td>{{$area_name}}</td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td>{{$date}}</td>
                            </tr>
                            <tr>
                                <th>Time</th>
                                <td><span>{{$start_time .'-'. $end_time}}</span></td>
                            </tr>
                            @if($group_name != "")
                            <tr>
                                <th>Group Name</th>
                                <td>
                                    {{ $group_name }}
                                </td>
                            </tr>
                            @endif
                            @if($psubject_name != "")
                            <tr>
                                <th>Subject Name</th>
                                <td><span>{{$psubject_name}}</span></td>
                            </tr>
                            @endif
                            <tr>
                                <th>Description</th>
                                <td><span>{{$description}}</span></td>
                            </tr>
                            <tr>
                                <th>Orderer</th>
                                <td><span>{{ $user_login }}</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                        <p class="m_-8525905254478487520confirm-block" style="text-align:center">
                            <a href="{{ route('rooms.active', ['id' => $id]) }}"
                               style="background: red;padding:10px;text-decoration:none;color:white" target="_blank">Detail</a>
                        </p>
                    <div class="yj6qo"></div>
                    <div class="adL">
                    </div>
                </div>
                <div class="adL">
                </div>
            </div>
        </div>
        <div id=":g7" class="ii gt" style="display:none">
            <div id=":g8" class="a3s aiL "></div>
        </div>
        <div class="hi"></div>
    </div>
</div>
