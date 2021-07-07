@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="text-center pl-3 pr-3">
            <h3>
                Notification
            </h3>
        </div>
        <div class="row p-4">
            @if(!empty($notis))
                @foreach($notis as $noti)
                    @if($noti->show == 'show')
                    <div class="col-12 p-4 mb-3" style="box-shadow: 0px 1px 20px rgba(0, 0, 0, 0.15);border-radius: 10px;position: relative;">
                            <div class="row">
                                <div class="col-12 text-left">
                                    <span  style="font-size: 21px;color:#0669B1;">
                                        {{$noti->title}} 
                                    </span>
                                    <br>
                                    <span style="font-weight: 300;">
                                        {{$noti->message}}
                                    </span>
                                    <br>
                                    <small class="text-pink" style="font-weight: 300;">
                                        {{$noti->created_at}}
                                    </small>
                                </div>
                            </div>
                            <button onclick="hide({{$noti->id}})" class="btn btn-sm btn-noti">ลบ</button>
                    </div>
                    @endif
                @endforeach
            @else
                <p>ยังไม่มีการแจ้งเตือน</p>
            @endif
        </div>
    </div>
@endsection

<script>
function hide(id) {
    const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success ml-2',
        cancelButton: 'btn border-radius-10'
    },
    buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
    title: 'ยืนยันการลบข้อความ',
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'ยืนยัน',
    cancelButtonText: 'ยกเลิก',
    reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = '/notification/hide/' + id
        }
    })
}
</script>