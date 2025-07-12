@extends('dashboard::layouts.master')

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
                                <li class="breadcrumb-item active">Roles</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Roles</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-sm-5">
                                    <a href="{{ route('role.create') }}" class="btn btn-danger mb-2"><i
                                            class="mdi mdi-plus-circle me-2"></i> Add Roles</a>
                                </div>
                                <div class="col-sm-7">
                                    <div class="text-sm-end">
                                        <button type="button" class="btn btn-success mb-2 me-1"><i
                                                class="mdi mdi-cog-outline"></i></button>
                                        <button type="button" class="btn btn-light mb-2 me-1">Import</button>
                                        <button type="button" class="btn btn-light mb-2">Export</button>
                                    </div>
                                </div><!-- end col-->
                            </div>

                            <div class="table-responsive">
                                <table class="table table-centered w-100 dt-responsive nowrap" id="basic-datatable">
                                    <thead class="table-light">
                                        <tr>
                                            <th> Sl </th>
                                            <th>Product</th>
                                            <th>Category</th>
                                            <th>Added Date</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Status</th>
                                            <th style="width: 85px;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <img src="assets/images/products/product-1.jpg" alt="contact-img"
                                                    title="contact-img" class="rounded me-3" height="48" />
                                                <p class="m-0 d-inline-block align-middle font-16">
                                                    <a href="apps-ecommerce-products-details.html" class="text-body">Amazing
                                                        Modern Chair</a>
                                                    <br />
                                                    <span class="text-warning mdi mdi-star"></span>
                                                    <span class="text-warning mdi mdi-star"></span>
                                                    <span class="text-warning mdi mdi-star"></span>
                                                    <span class="text-warning mdi mdi-star"></span>
                                                    <span class="text-warning mdi mdi-star"></span>
                                                </p>
                                            </td>
                                            <td>
                                                Aeron Chairs
                                            </td>
                                            <td>
                                                09/12/2018
                                            </td>
                                            <td>
                                                $148.66
                                            </td>

                                            <td>
                                                254
                                            </td>
                                            <td>
                                                <span class="badge bg-success">Active</span>
                                            </td>

                                            <td class="table-action">
                                                <a href="javascript:void(0);" class="action-icon"> <i
                                                        class="mdi mdi-eye"></i></a>
                                                <a href="javascript:void(0);" class="action-icon"> <i
                                                        class="mdi mdi-square-edit-outline"></i></a>
                                                <a href="javascript:void(0);" class="action-icon"> <i
                                                        class="mdi mdi-delete"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>
                                                <img src="assets/images/products/product-4.jpg" alt="contact-img"
                                                    title="contact-img" class="rounded me-3" height="48" />
                                                <p class="m-0 d-inline-block align-middle font-16">
                                                    <a href="apps-ecommerce-products-details.html" class="text-body">Biblio
                                                        Plastic Armchair</a>
                                                    <br />
                                                    <span class="text-warning mdi mdi-star"></span>
                                                    <span class="text-warning mdi mdi-star"></span>
                                                    <span class="text-warning mdi mdi-star"></span>
                                                    <span class="text-warning mdi mdi-star"></span>
                                                    <span class="text-warning mdi mdi-star-half"></span>
                                                </p>
                                            </td>
                                            <td>
                                                Wooden Chairs
                                            </td>
                                            <td>
                                                09/08/2018
                                            </td>
                                            <td>
                                                $8.99
                                            </td>

                                            <td>
                                                1,874
                                            </td>
                                            <td>
                                                <span class="badge bg-success">Active</span>
                                            </td>
                                            <td class="table-action">
                                                <a href="javascript:void(0);" class="action-icon"> <i
                                                        class="mdi mdi-eye"></i></a>
                                                <a href="javascript:void(0);" class="action-icon"> <i
                                                        class="mdi mdi-square-edit-outline"></i></a>
                                                <a href="javascript:void(0);" class="action-icon"> <i
                                                        class="mdi mdi-delete"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>
                                                <img src="assets/images/products/product-3.jpg" alt="contact-img"
                                                    title="contact-img" class="rounded me-3" height="48" />
                                                <p class="m-0 d-inline-block align-middle font-16">
                                                    <a href="apps-ecommerce-products-details.html" class="text-body">Branded
                                                        Wooden Chair</a>
                                                    <br />
                                                    <span class="text-warning mdi mdi-star"></span>
                                                    <span class="text-warning mdi mdi-star"></span>
                                                    <span class="text-warning mdi mdi-star"></span>
                                                    <span class="text-warning mdi mdi-star"></span>
                                                    <span class="text-warning mdi mdi-star-outline"></span>
                                                </p>
                                            </td>
                                            <td>
                                                Dining Chairs
                                            </td>
                                            <td>
                                                09/05/2018
                                            </td>
                                            <td>
                                                $68.32
                                            </td>

                                            <td>
                                                2,541
                                            </td>
                                            <td>
                                                <span class="badge bg-success">Active</span>
                                            </td>

                                            <td class="table-action">
                                                <a href="javascript:void(0);" class="action-icon"> <i
                                                        class="mdi mdi-eye"></i></a>
                                                <a href="javascript:void(0);" class="action-icon"> <i
                                                        class="mdi mdi-square-edit-outline"></i></a>
                                                <a href="javascript:void(0);" class="action-icon"> <i
                                                        class="mdi mdi-delete"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>
                                                <img src="assets/images/products/product-4.jpg" alt="contact-img"
                                                    title="contact-img" class="rounded me-3" height="48" />
                                                <p class="m-0 d-inline-block align-middle font-16">
                                                    <a href="apps-ecommerce-products-details.html"
                                                        class="text-body">Designer Awesome Chair</a>
                                                    <br />
                                                    <span class="text-warning mdi mdi-star"></span>
                                                    <span class="text-warning mdi mdi-star"></span>
                                                    <span class="text-warning mdi mdi-star"></span>
                                                    <span class="text-warning mdi mdi-star-half"></span>
                                                    <span class="text-warning mdi mdi-star-outline"></span>
                                                </p>
                                            </td>
                                            <td>
                                                Baby Chairs
                                            </td>
                                            <td>
                                                08/23/2018
                                            </td>
                                            <td>
                                                $112.00
                                            </td>

                                            <td>
                                                3,540
                                            </td>
                                            <td>
                                                <span class="badge bg-success">Active</span>
                                            </td>

                                            <td class="table-action">
                                                <a href="javascript:void(0);" class="action-icon"> <i
                                                        class="mdi mdi-eye"></i></a>
                                                <a href="javascript:void(0);" class="action-icon"> <i
                                                        class="mdi mdi-square-edit-outline"></i></a>
                                                <a href="javascript:void(0);" class="action-icon"> <i
                                                        class="mdi mdi-delete"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>
                                                <img src="assets/images/products/product-5.jpg" alt="contact-img"
                                                    title="contact-img" class="rounded me-3" height="48" />
                                                <p class="m-0 d-inline-block align-middle font-16">
                                                    <a href="apps-ecommerce-products-details.html"
                                                        class="text-body">Cardan Armchair</a>
                                                    <br />
                                                    <span class="text-warning mdi mdi-star"></span>
                                                    <span class="text-warning mdi mdi-star"></span>
                                                    <span class="text-warning mdi mdi-star"></span>
                                                    <span class="text-warning mdi mdi-star"></span>
                                                    <span class="text-warning mdi mdi-star"></span>
                                                </p>
                                            </td>
                                            <td>
                                                Plastic Armchair
                                            </td>
                                            <td>
                                                08/02/2018
                                            </td>
                                            <td>
                                                $59.69
                                            </td>

                                            <td>
                                                26
                                            </td>
                                            <td>
                                                <span class="badge bg-danger">Active</span>
                                            </td>

                                            <td class="table-action">
                                                <a href="javascript:void(0);" class="action-icon"> <i
                                                        class="mdi mdi-eye"></i></a>
                                                <a href="javascript:void(0);" class="action-icon"> <i
                                                        class="mdi mdi-square-edit-outline"></i></a>
                                                <a href="javascript:void(0);" class="action-icon"> <i
                                                        class="mdi mdi-delete"></i></a>
                                            </td>
                                        </tr>

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
