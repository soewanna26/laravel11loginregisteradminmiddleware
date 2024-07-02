@extends('admin.layouts.app')
@section('title','Dashboard')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0"></h3>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Products</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0"></h3>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Orders</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0"></h3>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Customers</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0"></h3>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Expense current</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0"></h3>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Order Delivered</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0"></h3>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Order Processing</h6>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
