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
            var current_page = data.paginate.current_page;
            var last_page = data.paginate.current_page;
            data.paginate.links.forEach((paginate) => {
                if (isNaN(paginate.label)) {
                } else {
                    var paginate = `
                    <a onclick="paginate(${paginate.label}, ${current_page}, ${last_page})">
                    ${paginate.label}
                    </a>
                    `;
                }

                $("#paginate").append(paginate);
            });
        },
    });
}
function paginate(page, current_page, last_page) {
    console.log(page);
    if (page == "&laquo; Previous") {
        if (current_page > 1) page = current_page - 1;
        load_data(page);
    } else if (page == "Next &raquo;") {
        if (current_page < last_page) page = current_page + 1;
        load_data(page);
    } else {
        load_data(page);
    }
}
