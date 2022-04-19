$(window).on("load", function () {
    $.ajax({
        url: "/getInfo",
        type: "get",
        dataType: "json",
        success: function (data) {
            $("#content-post").empty();
            // console.log(data.data);
            data.data.forEach((el) => {
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
            // data.links.forEach((paginate) => {
            //     var paginate = `
            //     ${paginate.label}
            //     `;
            //     $("#paginate").append(paginate);
            // });
            // console.log(data.links);
        },
    });
});
