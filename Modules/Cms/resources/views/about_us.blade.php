@extends('dashboard::layouts.master')
@section('title', 'About Us')

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        {{-- <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                            <li class="breadcrumb-item active">Profile 2</li>
                        </ol>
                    </div> --}}
                        <h4 class="page-title">About Us</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('cms.submit_about_us') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <h5 class="mb-4 text-uppercase bg-light p-2"><i class="mdi mdi-file me-1"></i>
                                    Section 1</h5>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="title1" class="form-label">Title <sup>*</sup></label>
                                            <input type="text" class="form-control" name="title1" placeholder="Title"
                                                value="{{ $dataList->title1 }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" class="form-control" name="image1">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="{{ asset('uploads/cmsImage/' . $dataList->image1) }}" alt="image"
                                            class="img-fluid avatar-md" style="height: 40px;">
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="desc1" class="form-label">Desc <sup>*</sup></label>
                                            <textarea class="form-control editor" name="desc1" rows="4" placeholder="Write something..." required>{{ $dataList->desc1 }}</textarea>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                            {{-- <h5 class="mb-4 text-uppercase bg-light p-2"><i class="mdi mdi-file me-1"></i>
                                    Section 2</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="cta_title" class="form-label">Title <sup>*</sup></label>
                                            <input type="text" class="form-control" name="cta_title" placeholder="Title"
                                                value="{{ $dataList->cta_title }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="cta_button_text" class="form-label">Button Text <sup>*</sup></label>
                                            <input type="text" class="form-control" name="cta_button_text" placeholder="Button Text"
                                                value="{{ $dataList->cta_button_text }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="cta_button_url" class="form-label">Button Url <sup>*</sup></label>
                                            <div class="input-group">
                                                <span class="input-group-text">{{ url('') }}/</span>
                                                <input type="text" class="form-control" id="cta_button_url"
                                                    name="cta_button_url" value="{{ $dataList->cta_button_url }}" placeholder="Button Url" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="cta_bg_image" class="form-label">BG Image</label>
                                            <input type="file" class="form-control" name="cta_bg_image">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="{{ asset('uploads/cmsImage/' . $dataList->cta_bg_image) }}" alt="image"
                                            class="img-fluid avatar-md" style="height: 40px;">
                                    </div>
                                </div>  --}}

                                


                            {{-- <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-file me-1"></i> Section 3</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="title2" class="form-label">Title <sup>*</sup></label>
                                            <input type="text" class="form-control" name="title2" placeholder="Title"
                                                value="{{ $dataList->title2 }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" class="form-control" name="image2">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="{{ asset('uploads/cmsImage/' . $dataList->image2) }}" alt="image"
                                            class="img-fluid avatar-md" style="height: 40px;">
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="desc2" class="form-label">Desc <sup>*</sup></label>
                                            <textarea class="form-control editor" name="desc2" rows="4" placeholder="Write something..." required>{{ $dataList->desc2 }}</textarea>
                                        </div>
                                    </div> <!-- end col -->
                                </div>  --}}

                                

                                <div class="text-end">
                                    <button type="submit" class="btn btn-success mt-2"><i
                                            class="mdi mdi-content-save"></i> Save</button>
                                </div>
                            </form>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row-->

        </div>
        <!-- container -->

    </div>
@endsection
