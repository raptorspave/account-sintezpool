@extends('layouts.account')

@section('container')
        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-title">
                            <h4>BTC total income</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>BTC</th>
                                        <th>USD</th>
                                        <th>Period</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>0.000001</td>
                                        <td><span class="badge badge-primary">1 day</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>0.000002</td>
                                        <td><span class="badge badge-success">1 week</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>0.000001</td>
                                        <td><span class="badge badge-danger">1 month</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>0.000001</td>
                                        <td><span class="badge badge-warning">3 month</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>0.000002</td>
                                        <td><span class="badge badge-info">6 month</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>0.000001</td>
                                        <td><span class="badge badge-dark">1 year</span></td>
                                    </tr>
												<tr>
                                        <th scope="row">1</th>
                                        <td>0.000001</td>
                                        <td><span class="badge badge-pink">Total</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-title">
                            <h4>BTC transactions </h4>
                            <button type="button" class="btn btn-info btn-xs m-l-5 right-float" data-remodal-target="addModal"><i class="ti-plus"></i> Add</button>
                            <div class="right-float sweetalert m-t-15">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="transactionTableBTC" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">02.05.2018</th>
                                        <td>0.000000666 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.05.2018</th>
                                        <td>0.0000000777 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.05.2018</th>
                                        <td>0.0000000777 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.05.2018</th>
                                        <td>0.0000000777 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.05.2018</th>
                                        <td>0.0000000777 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.05.2018</th>
                                        <td>0.0000000777 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.05.2018</th>
                                        <td>0.0000000777 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.05.2018</th>
                                        <td>0.0000000777 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.05.2018</th>
                                        <td>0.0000000777 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.05.2018</th>
                                        <td>0.0000000777 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.05.2018</th>
                                        <td>0.0000000777 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.05.2018</th>
                                        <td>0.0000000777 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.05.2018</th>
                                        <td>0.0000000777 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
            </div>
            <!-- /# row -->
            <!-- End PAge Content -->
        </div>
        <!-- End Container fluid  -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-title">
                            <h4>ETH total income</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>ETH</th>
                                        <th>USD</th>
                                        <th>Period</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>0.000001</td>
                                        <td><span class="badge badge-primary">1 day</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>0.000002</td>
                                        <td><span class="badge badge-success">1 week</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>0.000001</td>
                                        <td><span class="badge badge-danger">1 month</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>0.000001</td>
                                        <td><span class="badge badge-warning">3 month</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>0.000002</td>
                                        <td><span class="badge badge-info">6 month</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>0.000001</td>
                                        <td><span class="badge badge-dark">1 year</span></td>
                                    </tr>
												<tr>
                                        <th scope="row">1</th>
                                        <td>0.000001</td>
                                        <td><span class="badge badge-pink">Total</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-title">
                            <h4>ETH transactions </h4>
                            <button type="button" class="btn btn-info btn-xs m-l-5 right-float" data-remodal-target="addModal"><i class="ti-plus"></i> Add</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="transactionTableETH" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">02.05.2018</th>
                                        <td>0.000000666 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.05.2018</th>
                                        <td>0.0000000777 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.05.2018</th>
                                        <td>0.0000000777 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.05.2018</th>
                                        <td>0.0000000777 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.05.2018</th>
                                        <td>0.0000000777 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.05.2018</th>
                                        <td>0.0000000777 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.05.2018</th>
                                        <td>0.0000000777 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.05.2018</th>
                                        <td>0.0000000777 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.05.2018</th>
                                        <td>0.0000000777 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.05.2018</th>
                                        <td>0.0000000777 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.05.2018</th>
                                        <td>0.0000000777 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.05.2018</th>
                                        <td>0.0000000777 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">03.05.2018</th>
                                        <td>0.0000000777 <a class="edit-transaction-btn" href="#" data-remodal-target="editModal"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
            </div>
            <!-- /# row -->
            <!-- End PAge Content -->
        </div>
        <!-- End Container fluid  -->
@endsection

@section('modal')
	@include('parts.add-modal')
	@include('parts.edit-modal')
@endsection