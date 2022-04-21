url = "/getInfo";
load_data();
function load_data(page = 1) {
    $.ajax({
        url: url,
        type: "get",
        dataType: "json",
        data: { page: page },
        success: function (data) {
            $("#content-post").empty();
            $("#paginate").empty();
            console.log(data);
            data.post.forEach((el) => {
                var html = `
                        <div class="col-md-4">
                            <div class="card card-plain card-blog">
                                <div class="card-image">
                                    <a href="/slug/${el.slug}">
                                        <img class="img img-raised" src="asset/img/bg5.jpg" />
                                    </a>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">
                                        <a href="/slug/${el.slug}">${el.slug}</a>
                                    </h4>
                                    <p class="card-description">
                                    ${el.description}
                                        <a href="/slug/${el.slug}">
                                            Đọc Thêm </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    `;
                $("#content-post").append(html);
            });
            var last_page = data.paginate.last_page;
            var paginator = "";
            paginator += `
                    <a href="javascript:void(0);" onclick="paginate(${
                        data.paginate.current_page - 1
                    }, ${last_page})">
                    &laquo; Previous
                    </a>
                `;
            data.paginate.links.forEach((paginate) => {
                if (isNaN(paginate.label)) {
                } else {
                    paginator += `
                    <a href="javascript:void(0);" onclick="paginate(${paginate.label})">
                    ${paginate.label}
                    </a>
                    `;
                }
            });
            paginator += `
                    <a href="javascript:void(0);" onclick="paginate(${
                        data.paginate.current_page + 1
                    }, ${last_page})">
                    Next &raquo;
                    </a>
                `;
            $("#paginate").append(paginator);
        },
    });
}
function paginate(page, last_page) {
    if (page > last_page) {
        load_data(last_page);
    } else if (page < 1) {
        load_data(1);
    } else {
        load_data(page);
    }
}
