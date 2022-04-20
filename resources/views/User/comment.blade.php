@extends('User.detailPost')
@section('comment')
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
@stop()
