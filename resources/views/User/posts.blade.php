@extends('layouts.appUser')

@section('content')
    <div class="main main-raised">
        <div class="container">
            <div class="section">
                <h3 class="title text-center">You may also be interested in</h3>
                <br />
                <div class="row" id="content-post">

                </div>
                <div class="row" id="paginate" style="text-align: center">
                </div>
            </div>
        </div>

        <div class="team-5 section-image" style="background-image: url('asset/img/bg10.jpg')">

            <div class="container">
                <div class="row">

                    <div class="col-md-6">
                        <div class="card card-profile card-plain">
                            <div class="col-md-5">
                                <div class="card-image">
                                    <a href="#pablo">
                                        <img class="img" src="asset/img/faces/card-profile1-square.jpg" />
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card-content">
                                    <h4 class="card-title">Alec Thompson</h4>
                                    <h6 class="category text-muted">Author of the Month</h6>

                                    <p class="card-description">
                                        Don't be scared of the truth because we need to restart the human foundation in
                                        truth...
                                    </p>

                                    <div class="footer">
                                        <a href="#pablo" class="btn btn-just-icon btn-simple btn-white"><i
                                                class="fa fa-twitter"></i></a>
                                        <a href="#pablo" class="btn btn-just-icon btn-simple btn-white"><i
                                                class="fa fa-facebook-square"></i></a>
                                        <a href="#pablo" class="btn btn-just-icon btn-simple btn-white"><i
                                                class="fa fa-google"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
    <script src="{{ asset('asset') }}/js/posts.js"></script>
    {{-- <script type="text/javascript">
        $(window).on("load", function() {
            $.ajax({
                url: "/User/getInfo",
                type: "get",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                },
            });
        });
    </script> --}}
@stop()
