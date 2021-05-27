@extends('layouts.app')

@section('content')



<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3>create post
                        <small></small>
                    </h3>
                </div>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb pull-right">
                    <li class="breadcrumb-item"><a href=""><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item"> <a href="{{url('staff')}}">create post</a></li>
                    <li class="breadcrumb-item active">create post</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

<!-- Container-fluid starts-->

<div class="card">


    <div class="card-header">



    </div>
    <div class="card-body">

        <div class="card-body">
            <div class="tab-content">
                <form action="{{url('post/create')}}" method="POST" id="post_id" onsubmit="return validateStaffform(this.id)">
                    @csrf

                    <div class="row">

                        <div class="col-6 col-md-6 offset-md-3">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" value="{{old('title')}}" class="form-control required  @error('title') is-invalid @enderror" id="project_name" name="title" placeholder="Enter Title">
                                @error('title')
                                <div class="alert alert-message" style="color:red">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-6 col-md-6 offset-md-3">
                            <label>Description</label>

                            <div class="form-group">
                                <textarea name="description" id="description" cols="79" rows="4"></textarea>

                            </div>

                        </div>

                    </div>

            </div>
            <div class="col-9">
                <button type="submit" class="pull-right  btn btn-primary">Save</button>
            </div>
            </form>
        </div>

    </div>
</div>


<script>
    function validateStaffform(formid) {

        var isValid = true;
        var form = $("form#" + formid);

        form.find('input.required').each(function() {


            if ($(this).val() === null || $(this).val() === "") {
                $(this).addClass('invalid');
                isValid = false;
            }


        });
        $('input.required').on('focus', function() {

            $(this).removeClass('invalid');

        });

        return isValid;


    }
</script>

@endsection