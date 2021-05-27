@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3>posts
                        <small></small>
                    </h3>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

<!-- Container-fluid starts-->

<div class="card">


    <div class="card-header">

        <div class="col-12">
            <a href="{{url('post/create')}}" class="btn btn-primary pull-right ">create post</a>
        </div>

    </div>
    @foreach($posts as $post)
    <div class="card-body">

        <div id="app" style="margin-left: 25%;">
            <div class="header">
                <div class="left-info">
                    <div class="thumbnail">
                        <img src="{{asset('/')}}assets/images/blank.jpg" alt>
                    </div>
                    <div class="name-info">
                        <div class="name">
                            <a href="">Bruce Wayne</a>
                        </div>
                        <div class="time">
                            Followers
                            <i class="global-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="right-info"></div>
            </div>

            <div class="content">{{$post->title}}</div>
            <div class="description">
                <div class="video-wrapper" style="padding: 15px;">
                    {{$post->description}}
                </div>
            </div>

            <div class="feedback-info">
                <div class="feedback-emojis">
                    <i class="icons laugh-icon"></i>
                    <i class="icons angry-icon"></i>
                    <i class="icons wow-icon"></i>
                    <!-- Tony Stark, Logan and 9487 others -->
                </div>
                <div class="threads-and-share">
                    <!-- <div class="threads"> 15 comments</div> -->
                </div>
            </div>
            <div class="feedback-action handlelike">
                <div class="fb-wrapper">

                    @if($post->follow_status == 0)
                    <a href="javascript:;" data-id="{{$post->id}}" class="like_value" style="color:grey">
                        Like
                    </a>

                    @else

                    <a href="javascript:;" data-id="{{$post->id}} " class="unlike_value" style="color:red">
                        Unlike
                    </a>

                    @endif

                </div>

                <div class="fb-wrapper mycomment" onclick="handlecomment(<?php echo $post->id ?>);">
                    <i class="fb-icon response far fa-comment-alt"></i>Comment
                </div>
                <div class="fb-wrapper">
                    <i class="fb-icon share"></i>Follow
                </div>
            </div>

            <div class="comments">
                <div class="my-comment-wrapper">
                    <div class="my-avatar">
                        <img src="{{asset('/')}}assets/images/blank.jpg" alt>
                    </div>
                    <div class="my-comment">
                        <div class="my-comment-placeholder">
                            <form action="{{route('post/comment')}}" onsubmit="handlepage()" name="commentform" method="POST">

                                @csrf
                                <input type="hidden" name="post_id" value="{{$post->id}}">

                                <input type="text" id="comment_{{$post->id}}" class="comment" name="comment" placeholder="Write a comment...">

                                <div class="">
                                    <button type="submit" class="pull-right btn btn-primary" style="display: none;">post</button>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
                @foreach($post->total_comments as $t_comment)
                <div class="wrapper">
                    <div class="people-comment-wrapper">
                        <div class="people-avatar">
                            <img src="{{asset('/')}}assets/images/blank.jpg" alt>
                        </div>
                        <div class="people-comment">
                            <div class="people-comment-container">
                                <div class="people-name">
                                    <a href="{{asset('/')}}assets/images/blank.jpg"></a>
                                </div>
                                <div class="people-saying">{{$t_comment->comment}}</div>
                            </div>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>

        </div>

    </div>
    @endforeach
</div>


<script>
    function handlecomment(id) {

        $("#comment_" + id).focus();

    }


    $(".like_value").on("click", function() {

        var datid = $(this).attr("data-id");


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post("/like_post", {
                contentType: 'application/json',
                datid: datid,

            },
            function(data, status) {

                location.reload();
            });

    });


    $(".unlike_value").on("click", function() {



        var datid = $(this).attr("data-id");


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post("/unlike_post", {
                contentType: 'application/json',
                datid: datid,

            },
            function(data, status) {

                location.reload();

            });

    });
</script>


@endsection