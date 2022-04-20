@extends('layouts.appUser')

@section('content')
    <div class="main main-raised">
        <div class="container">
            <div class="section section-text">
                <div class="row" id="title-post">

                </div>
            </div>
            <div class="row" id="content-post">

            </div>
            <div class="section section-blog-info">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="card card-profile card-plain">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="card-avatar">
                                        <a href="#pablo">
                                            <img class="img" src="asset/img/faces/card-profile1-square.jpg">
                                        </a>
                                        <div class="ripple-container"></div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div id="card-author"></div>
                                    <p class=" description">I've been trying to figure out the bed design for the
                                        master bedroom at our Hidden Hills compound...I like good music from Youtube.
                                    </p>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-default pull-right btn-round">Follow</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            {{-- comment space --}}

            {{-- @yield('comment') --}}
            <div class="section section-comments">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="media-footer">
                            <h3>Bình luận
                                <a class="btn btn-primary btn-simple pull-right" id="countCMT" style="font-size: 15px;">
                                </a>
                            </h3>
                        </div>
                    </div>
                    <div id="content-comment" class="col-md-8 col-md-offset-2">
                    </div>
                    <div id="btn-more" class="col-md-8 col-md-offset-2" style="text-align: center">
                    </div>
                    <div class="col-md-8 col-md-offset-2">
                        <div class="media media-post" id="comment-post">
                        </div> <!-- end media-post -->
                    </div>
                </div>
            </div>
            {{-- end comment space --}}
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
    <script src="{{ asset('asset') }}/js/detailpost.js"></script>

@stop()
