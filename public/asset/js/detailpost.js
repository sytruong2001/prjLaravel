// setup token
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
});
// khai báo biến cmtItem để lưu trữ comment hiện tại
let cmtItem = [];
loadInfo();
function loadInfo(id = null, limit = 3, lenght = 0) {
    $.ajax({
        url: "/getDetailPost",
        type: "get",
        data: {
            slug: window.location.pathname,
            id: id,
            limit: limit,
            lenght: lenght,
        },
        dataType: "json",
        success: function (data) {
            console.log(data.info);
            // kiểm tra có comment mới hay không
            if (cmtItem.length > data.info.comment.length) {
            } else {
                $("#countCMT").empty();
                $("#title-post").empty();
                $("#content-post").empty();
                $("#card-author").empty();
                $("#content-comment").empty();
                $("#btn-more").empty();
                $("#comment-post").empty();

                // đếm số bình luận + trả lời bình luận
                var countCMT = `${data.cmt.length + data.rep.length} bình luận`;
                $("#countCMT").append(countCMT);
                // hiển thị title - description
                var htmlTitle = `
            <div class="col-md-8 col-md-offset-2">
                        <h3 class="title">${data.info.title}</h3>

                        <blockquote>
                            <p>
                            ${data.info.description}
                            </p>

                        </blockquote>
                    </div>
            `;
                $("#title-post").append(htmlTitle);

                // phần content
                var htmlContent = `
            ${data.info.content}

            `;
                $("#content-post").append(htmlContent);

                // tên tác giả
                var htmlAuthor = `
                <h4 class="card-title">${data.info.user.name}</h4>

            `;
                $("#card-author").append(htmlAuthor);

                // nội dung bình luận
                var max = 0;
                data.cmt.forEach((comment) => {
                    var htmlComment = "";
                    max = comment.id;

                    htmlComment += `
                    <div class="media-area">
                        <h3 class="title text-center"></h3>

                        <div class="media">
                            <a class="pull-left" href="#pablo">
                                <div class="avatar">
                                    <img class="media-object" alt="Tim Picture"
                                        src="asset/img/faces/card-profile1-square.jpg">
                                </div>
                            </a>
                            <div class="media-body">`;
                    if (comment.ParentId === null) {
                        htmlComment += `
                            <h4 class="media-heading">${comment.name}
                            <small>&middot;${comment.created_at}</small>
                            </h4>

                            <p>${comment.content}</p>`;
                    }

                    htmlComment += `<div class="media-footer">
                                    <a id="reply" class="btn btn-primary btn-simple pull-right"
                                        data-id="${comment.id}" rel="tooltip" title="Reply to Comment">
                                        <i class="material-icons">reply</i> Phản hồi
                                    </a>
                                </div>`;
                    // nội dung trả lời bình luận
                    data.rep.forEach((reply) => {
                        if (reply.ParentId === comment.id) {
                            htmlComment += `
                        <div class="media" id="reply-form-${comment.id}" style="display:none">
                            <a class="pull-left" href="#pablo">
                                <div class="avatar">
                                    <img class="media-object" alt="Tim Picture"
                                        src="asset/img/faces/card-profile1-square.jpg">
                                </div>
                            </a>
                            <div class="media-body">`;
                            htmlComment += `
                                    <h4 class="media-heading">${reply.name}
                                    <small>&middot;${reply.created_at}</small>
                                    </h4>

                                    <p>${reply.content}</p>`;

                            htmlComment += `

                            </div>
                            </div>`;
                        }
                    });
                    // form trả lời bình luận
                    htmlComment += `
                                <div class="media media-post" id="reply-form-${comment.id}"
                                    style="display:none">
                                    <a class="pull-left author" href="#pablo">
                                        <div class="avatar">
                                            <img class="media-object" alt="64x64"
                                                src="asset/img/faces/card-profile6-square.jpg">
                                        </div>
                                    </a>
                                    <div class="media-body">`;
                    // kiểm tra có session hay không nếu có thì cho bình luận nếu không thì yêu cầu đăng nhập
                    if (data.session) {
                        htmlComment += `<h4 class="media-heading">${data.session.name}</h4>
                            <form id="frm${comment.id}" enctype="multipart/form-data">
                                <input type="hidden" name="parentId" value="${comment.id}">
                                <input type="hidden" name="PostId" value="${data.info.id}">
                                <textarea class="form-control" id="content" name="content" placeholder="Hãy để lại bình luận của bạn ở đây..." rows="6"></textarea>
                                <div class="media-footer">
                                    <button type="submit" value="${comment.id}"
                                        class="btn btn-primary btn-round btn-wd pull-right">Post
                                        Comment</button>
                                </div>
                            </form>`;
                    } else {
                        htmlComment += `<h4 class="media-heading">User</h4>
                            <form>
                                <textarea class="form-control" id="content" name="content" placeholder="Hãy để lại bình luận của bạn ở đây..."
                                    rows="6"></textarea>
                                <div class="media-footer">
                                    <a href="/login" type="submit" class="btn btn-primary btn-round btn-wd pull-right">Đăng nhập
                                    </a>
                                </div>
                            </form>`;
                    }

                    htmlComment += `</div>
                            </div>

                            </div>
                        </div>

                    </div>
                `;

                    $("#content-comment").append(htmlComment);
                });
                // khai báo biến btn để lấy id của button khi ấn submit để phân biệt form comment vs form reply
                var btn = "";
                var idComment = 0;
                var limit = data.cmt.length + 3;
                console.log(data.cmt.length);
                data.info.comment.forEach((el) => {
                    idComment = el.id;
                });
                // kiểm tra idComment lớn nhất trong db với mã idComment(max) hiện tại đang hiển thị có bằng nhau hay không
                // nếu bằng thì hiển thị "chưa có bình luận mới"
                // nếu lớn hơn nghĩa là vẫn còn bình luận chưa hiển thị nên sẽ hiển thị "xem thêm bình luận"
                if (idComment === max) {
                    btn += `
                        Chưa có bình luận mới
                    `;
                }
                if (idComment > max) {
                    btn += `
                        <a id="showMore" onClick="show_more(${max},${limit})">Xem thêm bình luận</a>
                    `;
                }
                $("#btn-more").html(btn);

                // comment post
                var htmlCommentPost = `
                    <div class="media media-post">
                        <a class="pull-left author" href="#pablo">
                            <div class="avatar">
                                <img class="media-object" alt="64x64" src="asset/img/faces/card-profile6-square.jpg">
                            </div>
                        </a>
                        <div class="media-body">`;
                // kiểm tra có session hay không nếu có thì cho bình luận nếu không thì yêu cầu đăng nhập
                if (data.session) {
                    htmlCommentPost += `<h4 class="media-heading">
                            ${data.session.name}
                            </h4>
                            <form id="frm" enctype="multipart/form-data">
                                <input type="hidden" name="parentId" value="">
                                <input type="hidden" name="PostId" value="${data.info.id}">
                                <textarea class="form-control" id="content" name="content" placeholder="Hãy để lại bình luận của bạn ở đây..."
                                    rows="6"></textarea>
                                <div class="media-footer">
                                    <button type="submit" value="" class="btn btn-primary btn-round btn-wd pull-right">Post
                                        Comment</button>
                                </div>
                            </form>`;
                } else {
                    htmlCommentPost += `<h4 class="media-heading">
                            User
                            </h4>
                            <form>
                                <textarea class="form-control" id="content" name="content" placeholder="Hãy để lại bình luận của bạn ở đây..."
                                    rows="6"></textarea>
                                <div class="media-footer">
                                    <a href="/login" type="submit" class="btn btn-primary btn-round btn-wd pull-right">Đăng nhập
                                    </a>
                                </div>
                            </form>`;
                }

                htmlCommentPost += `</div>
                    </div>
                    `;
                $("#comment-post").append(htmlCommentPost);

                // show reply form, mỗi khi thẻ a được click thì sẽ thực hiện thay đổi trạng thái hiển thị reply form

                $("a").on("click", function () {
                    $(
                        "div[id=reply-form-" + $(this).attr("data-id") + "]"
                    ).toggle();
                });

                // submit comment form, đưa dữ liệu đến controller để xử lý và lưu trữ
                $("button").on("click", function (e) {
                    e.preventDefault();
                    var idBtn = $(this).val();
                    // debugger;
                    $.ajax({
                        url: "/User/comment/" + max,
                        method: "post",
                        dataType: "json",
                        async: false,
                        data: $("#frm" + idBtn).serialize(),
                        success: function (response) {
                            if (response.code == 200) {
                                $("#frm" + idBtn)[0].reset();
                                loadInfo(
                                    response.id - 1,
                                    response.limit,
                                    response.lenghtId
                                );
                            }
                        },
                        error: function () {
                            console.log("error");
                        },
                    });
                });
            }
        },
    });
}

function show_more(id, limit) {
    $("#showMore").on("click", function () {
        $("#showMore").html("Loading.......");
        loadInfo(id, limit, 0);
    });
}
