@extends('dashboard::layouts.master')
@section('title', 'Home Page')

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
                        <h4 class="page-title">Home</h4>
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

                            <form action="{{ route('cms.submit_home') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <h5 class="mb-4 text-uppercase bg-light p-2"><i class="mdi mdi-file me-1"></i>
                                    Banner Section</h5>
                                    <input type="hidden" class="form-control" name="title[]" value="{{ $sectionList[0]->section_title }}">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="feed1" class="form-label">Feed <sup>*</sup></label>
                                            <select class="form-control" name="feed_id[]" required>
                                                <option value="">Select Feed</option>
                                                @foreach ($feedList as $feed)
                                                    <option value="{{ $feed['id'] }}" {{ $section1->feed_id==$feed['id']?'selected':'' }}>{{ $feed['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="item1" class="form-label">Item Display <sup>*</sup></label>
                                            <input type="number" class="form-control" name="items[]" placeholder="Display" value="{{ $section1->items }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="title_length_1" class="form-label">Title (Length) <sup>*</sup></label>
                                            <input type="number" class="form-control" name="title_length[]" placeholder="Display" value="{{ $section1->title_length }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="desc1" class="form-label">Desc (Length) <sup>*</sup></label>
                                            <input type="number" class="form-control" name="desc_length[]" placeholder="Display" value="{{ $section1->desc_length }}" required>
                                        </div>
                                    </div>
                                </div> <!-- end row -->

                                <h5 class="mb-4 text-uppercase bg-light p-2"><i class="mdi mdi-file me-1"></i>
                                    Section 2</h5>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title2" class="form-label">Title <sup>*</sup></label>
                                            <input type="text" class="form-control" name="title[]" placeholder="Title" value="{{ $sectionList[1]->section_title }}" required>
                                        </div>
                                    </div>
                                </div> <!-- end row -->

                                <p>Block A :</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="feed2" class="form-label">Feed <sup>*</sup></label>
                                            <select class="form-control" name="feed_id[]" required>
                                                <option value="">Select Feed</option>
                                                @foreach ($feedList as $feed)
                                                    <option value="{{ $feed['id'] }}" {{ $section2[0]->feed_id==$feed['id']?'selected':'' }}>{{ $feed['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="item2" class="form-label">Item Display <sup>*</sup></label>
                                            <input type="number" class="form-control" name="items[]" placeholder="Display" value="{{ $section2[0]->items }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="title_length_2" class="form-label">Title (Length) <sup>*</sup></label>
                                            <input type="number" class="form-control" name="title_length[]" placeholder="Display" value="{{ $section2[0]->title_length }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="desc_length_2" class="form-label">Desc (Length) <sup>*</sup></label>
                                            <input type="number" class="form-control" name="desc_length[]" placeholder="Display" value="{{ $section2[0]->desc_length }}" required>
                                        </div>
                                    </div>
                                </div> <!-- end row -->

                                <p>Block B :</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="feed2" class="form-label">Feed <sup>*</sup></label>
                                            <select class="form-control" name="feed_id[]" required>
                                                <option value="">Select Feed</option>
                                                @foreach ($feedList as $feed)
                                                    <option value="{{ $feed['id'] }}" {{ $section2[1]->feed_id==$feed['id']?'selected':'' }}>{{ $feed['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="item2" class="form-label">Item Display <sup>*</sup></label>
                                            <input type="number" class="form-control" name="items[]" placeholder="Display" value="{{ $section2[1]->items }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="title_length_2" class="form-label">Title (Length) <sup>*</sup></label>
                                            <input type="number" class="form-control" name="title_length[]" placeholder="Display" value="{{ $section2[1]->title_length }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="desc_length_2" class="form-label">Desc (Length) <sup>*</sup></label>
                                            <input type="number" class="form-control" name="desc_length[]" placeholder="Display" value="{{ $section2[1]->desc_length }}" required>
                                        </div>
                                    </div>
                                </div> <!-- end row -->

                                <h5 class="mb-4 text-uppercase bg-light p-2"><i class="mdi mdi-file me-1"></i>
                                    Section 3</h5>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title3" class="form-label">Title <sup>*</sup></label>
                                            <input type="text" class="form-control" name="title[]" placeholder="Title" value="{{ $sectionList[2]->section_title }}" required>
                                        </div>
                                    </div>
                                </div> <!-- end row -->
                                
                                <p>Block A :</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="feed3" class="form-label">Feed <sup>*</sup></label>
                                            <select class="form-control" name="feed_id[]" required>
                                                <option value="">Select Feed</option>
                                                @foreach ($feedList as $feed)
                                                    <option value="{{ $feed['id'] }}" {{ $section3['feed_id']==$feed['id']?'selected':'' }}>{{ $feed['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="item3" class="form-label">Item Display <sup>*</sup></label>
                                            <input type="number" class="form-control" name="items[]" placeholder="Display" value="{{ $section3['items'] }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="title_length_3" class="form-label">Title (Length) <sup>*</sup></label>
                                            <input type="number" class="form-control" name="title_length[]" placeholder="Display" value="{{ $section3['title_length'] }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="desc_length_3" class="form-label">Desc (Length) <sup>*</sup></label>
                                            <input type="number" class="form-control" name="desc_length[]" placeholder="Display" value="{{ $section3['desc_length'] }}" required>
                                        </div>
                                    </div>
                                </div> <!-- end row -->


                                <h5 class="mb-4 text-uppercase bg-light p-2"><i class="mdi mdi-file me-1"></i>
                                    Section 4</h5>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title4" class="form-label">Title <sup>*</sup></label>
                                            <input type="text" class="form-control" name="title[]" placeholder="Title" value="{{ $sectionList[3]->section_title }}" required>
                                        </div>
                                    </div>
                                </div> <!-- end row -->

                                <p>Block A :</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="feed4" class="form-label">Feed <sup>*</sup></label>
                                            <select class="form-control" name="feed_id[]" required>
                                                <option value="">Select Feed</option>
                                                @foreach ($feedList as $feed)
                                                    <option value="{{ $feed['id'] }}" {{ $section4['feed_id']==$feed['id']?'selected':'' }}>{{ $feed['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="item4" class="form-label">Item Display <sup>*</sup></label>
                                            <input type="number" class="form-control" name="items[]" placeholder="Display" value="{{ $section4['items'] }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="title_length_4" class="form-label">Title (Length) <sup>*</sup></label>
                                            <input type="number" class="form-control" name="title_length[]" placeholder="Display" value="{{ $section4['title_length'] }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="desc_length_4" class="form-label">Desc (Length) <sup>*</sup></label>
                                            <input type="number" class="form-control" name="desc_length[]" placeholder="Display" value="{{ $section4['desc_length'] }}" required>
                                        </div>
                                    </div>
                                </div> <!-- end row -->

                                <h5 class="mb-4 text-uppercase bg-light p-2"><i class="mdi mdi-file me-1"></i>
                                    Section 5</h5>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title5" class="form-label">Title <sup>*</sup></label>
                                            <input type="text" class="form-control" name="title[]" placeholder="Title" value="{{ $sectionList[4]->section_title }}" required>
                                        </div>
                                    </div>
                                </div> <!-- end row -->

                                <p>Block A :</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="feed5" class="form-label">Feed <sup>*</sup></label>
                                            <select class="form-control" name="feed_id[]" required>
                                                <option value="">Select Feed</option>
                                                @foreach ($feedList as $feed)
                                                    <option value="{{ $feed['id'] }}" {{ $section5['feed_id']==$feed['id']?'selected':'' }}>{{ $feed['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="item5" class="form-label">Item Display <sup>*</sup></label>
                                            <input type="number" class="form-control" name="items[]" placeholder="Display" value="{{ $section5['items'] }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="title_length_5" class="form-label">Title (Length) <sup>*</sup></label>
                                            <input type="number" class="form-control" name="title_length[]" placeholder="Display" value="{{ $section5['title_length'] }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="desc_length_5" class="form-label">Desc (Length) <sup>*</sup></label>
                                            <input type="number" class="form-control" name="desc_length[]" placeholder="Display" value="{{ $section5['desc_length'] }}" required>
                                        </div>
                                    </div>
                                </div> <!-- end row -->

                                <h5 class="mb-4 text-uppercase bg-light p-2"><i class="mdi mdi-file me-1"></i>
                                    Section 6</h5>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title6" class="form-label">Title <sup>*</sup></label>
                                            <input type="text" class="form-control" name="title[]" placeholder="Title" value="{{ $sectionList[5]->section_title }}" required>
                                        </div>
                                    </div>
                                </div> <!-- end row -->

                                <p>Block A :</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="feed6" class="form-label">Feed <sup>*</sup></label>
                                            <select class="form-control" name="feed_id[]" required>
                                                <option value="">Select Feed</option>
                                                @foreach ($feedList as $feed)
                                                    <option value="{{ $feed['id'] }}" {{ $section6['feed_id']==$feed['id']?'selected':'' }}>{{ $feed['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="item6" class="form-label">Item Display <sup>*</sup></label>
                                            <input type="number" class="form-control" name="items[]" placeholder="Display" value="{{ $section6['items'] }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="title_length_6" class="form-label">Title (Length) <sup>*</sup></label>
                                            <input type="number" class="form-control" name="title_length[]" placeholder="Display" value="{{ $section6['title_length'] }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="desc_length_6" class="form-label">Desc (Length) <sup>*</sup></label>
                                            <input type="number" class="form-control" name="desc_length[]" placeholder="Display" value="{{ $section6['desc_length'] }}" required>
                                        </div>
                                    </div>
                                </div> <!-- end row -->


                                 <h5 class="mb-4 text-uppercase bg-light p-2"><i class="mdi mdi-file me-1"></i>
                                    Section 7</h5>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title7" class="form-label">Title <sup>*</sup></label>
                                            <input type="text" class="form-control" name="title[]" placeholder="Title" value="{{ $sectionList[6]->section_title }}" required>
                                        </div>
                                    </div>
                                </div> <!-- end row -->

                                <p>Block A :</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="feed7" class="form-label">Feed <sup>*</sup></label>
                                            <select class="form-control" name="feed_id[]" required>
                                                <option value="">Select Feed</option>
                                                @foreach ($feedList as $feed)
                                                    <option value="{{ $feed['id'] }}" {{ $section7['feed_id']==$feed['id']?'selected':'' }}>{{ $feed['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="item7" class="form-label">Item Display <sup>*</sup></label>
                                            <input type="number" class="form-control" name="items[]" placeholder="Display" value="{{ $section7['items'] }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="title_length_7" class="form-label">Title (Length) <sup>*</sup></label>
                                            <input type="number" class="form-control" name="title_length[]" placeholder="Display" value="{{ $section7['title_length'] }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="desc_length_7" class="form-label">Desc (Length) <sup>*</sup></label>
                                            <input type="number" class="form-control" name="desc_length[]" placeholder="Display" value="{{ $section7['desc_length'] }}" required>
                                        </div>
                                    </div>
                                </div> <!-- end row -->

                            
                                

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
