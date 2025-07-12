@extends('dashboard::layouts.master')
@section('title', 'Feeds')

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                                {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">eCommerce</a></li> --}}
                                <li class="breadcrumb-item active">Feeds</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Feeds</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                {{-- <div class="col-sm-5">
                                    <a href="{{ route('feed.create') }}" class="btn btn-danger mb-2"><i
                                            class="mdi mdi-plus-circle me-2"></i> Add Feed</a>
                                </div> --}}
                                {{-- <div class="col-sm-7">
                                    <div class="text-sm-end">
                                        <button type="button" class="btn btn-success mb-2 me-1"><i
                                                class="mdi mdi-cog-outline"></i></button>
                                        <button type="button" class="btn btn-light mb-2 me-1">Import</button>
                                        <button type="button" class="btn btn-light mb-2">Export</button>
                                    </div>
                                </div><!-- end col--> --}}
                            </div>

                            <div class="table-responsive">
                                <table class="table table-centered w-100 dt-responsive nowrap" id="basic-datatable">
                                    <thead class="table-light">
                                        <tr>
                                            <th> Sl </th>
                                            <th>Name</th>
                                            <th>Url</th>
                                            <th>Status</th>
                                            <th>Added Date</th>
                                            {{-- <th style="width: 85px;">Action</th> --}}
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($dataList as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->url }}</td>
                                                <td>
                                                    @if ($item->status==1)
                                                        <span>--</span>
                                                    @else
                                                        <span class="badge rounded-pill bg-danger p-2">Invalid</span>
                                                    @endif
                                                </td>
                                                <td>{{ $item->created_at }}</td>
                                                {{-- <td class="table-action">
                                                    <a href="{{ route('feed.edit', $item->id) }}" class="action-icon"> <i
                                                            class="mdi mdi-square-edit-outline"></i></a>
                                                    <form action="{{ route('feed.destroy', $item->id) }}" method="POST"
                                                        id="deletesection_{{ $item->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="javascript:void(0);" class="action-icon"
                                                            onclick="deleteData({{ $item->id }})"> <i
                                                                class="mdi mdi-delete"></i></a>
                                                    </form>
                                                </td> --}}
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection


@section('script')
    
@endsection
