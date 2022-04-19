<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div style="text-align: center">
                        <div>
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                <span style="color: rgb(8, 12, 112)">
                                    @if ($user)
                                        @foreach ($user as $item)
                                            {{ $item->name }}
                                        @endforeach
                                    @endif
                                </span>
                            </h2>

                        </div>
                        <div class="load"></div>
                        <div style="display:block; height: 350px; overflow:auto" id="chatbox">
                        </div>
                        <div>
                            <div class="input-chat">
                                <form id="frm" enctype="multipart/form-data">
                                    @csrf
                                    @foreach ($user as $item)
                                        <input type="hidden" name="id" id="id" value="{{ $item->id }}">
                                    @endforeach
                                    <input type="text" id="msg-content" placeholder="Nhập văn bản" name="msg-content"
                                        autofocus>
                                    <button type="button" class="ml-3" onclick="save()">
                                        Gửi
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        init_reload();

        let chatItems = [];
        // hàm thời gian thực cho hàm hiển thị tin nhắn
        function init_reload() {
            setInterval(function() {
                myFunction();

            }, 1000);
        }
        // load toàn bộ trang web sẽ chạy hàm hiển thị tin nhắn
        window.onload = function() {
            myFunction();
        };

        // hàm thực hiện chức năng hiển thị tin nhắn khi có tin nhắn mới
        function myFunction() {
            // lấy id từ trên địa chỉ url của trang web
            var id = window.location.pathname.split('/')[3];

            // dùng ajax để lấy dữ liệu nội dung cuộc thoại
            $.ajax({
                url: "/chat/getInfo/" + id,
                type: "get",
                async: false,
                dataType: "json",
                success: function(data) {
                    var html1 = '';
                    // so sánh độ dài của mảng chatItems với độ dài mảng nội dung cuộc thoại lấy được
                    // nếu độ dài bằng nhau nghĩa là chưa có tin nhắn mới nên không thực hiện thao tác gì
                    if (chatItems.length == data.data.length) {
                        // nếu độ dài khác nghĩa là có tin nhắn mới hoặc có tin bị xóa
                        // lúc này sẽ xóa toàn bộ cuộc thoại ban đầu và thay thế vào bằng cuộc thoại mới
                    } else {
                        $('#chatbox').empty();

                        data.data.forEach(el => {
                            // console.log(el);
                            // nếu id của người dùng bằng với id của người viết tin nhắn
                            // lấy được từ base sẽ hiển thị trong phần if còn không sẽ hiển thị
                            // trong phần else
                            if (data.idUser1 == el.idUser) {
                                const html = `
                        <div class="message-1">
                            <div class="ct-msg-1" style="text-align: right; font-size: 20px;">
                                <b>${el.content}</b><br />
                                <span style="font-size: 10px; ">${el.created_at}</span><br />
                            </div>
                        </div>
                        `
                                $('#chatbox').append(html);

                            } else {
                                const html = `
                        <div class="message-2">
                            <div class="ct-msg-2" style="text-align: left; font-size: 20px;">
                                <b>${el.content}</b><br />
                        <span style="font-size: 10px; ">${el.created_at}</span><br />
                            </div>
                        </div>
                        `
                                $('#chatbox').append(html);
                            }
                        });
                        // cuộn xuống nội dung mới nhất của cuộc thoại
                        $("#chatbox").animate({
                            scrollTop: 20000000
                        }, "slow");
                        // gán cho chatItems với giá trị mới nhất
                        chatItems = data.data
                        // console.log(chatItems);
                    }
                }
            });
        }

        // hàm xử lý dữ liệu khi nhập tin nhắn và ấn gửi
        function save() {
            // $('#frm').submit(function(e) {
            // e.preventDefault();
            var url = '/chat/store';
            var formData = $('#frm').serialize();
            var btnLoad = document.querySelector('.load');
            var content = $('#frm #msg-content').val();

            console.log(content);
            if (content.length >= 1) {
                // bật loading
                btnLoad.style.display = 'block';
                debugger
                $.ajax({
                    url: url,
                    method: 'post',
                    dataType: 'json',
                    data: formData,
                    success: function(response) {
                        // xóa thông tin nhập trong form từ lần trước submit
                        $("#frm")[0].reset();
                        // tắt loading
                        console.log(formData);
                        btnLoad.style.display = 'none';
                    },
                });
            }
            // });
        }
    </script>
</x-app-layout>
