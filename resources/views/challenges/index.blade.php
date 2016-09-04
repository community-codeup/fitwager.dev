@extends('layouts.master')
@section('content')
    <div class="container-fluid"><h1>My Challenges</h1></div>

    <br>

    <div class="container">
        <div class="row">
                <div id="activeTab" class="col-md-4 text-center"><button type="button" class="btn btn-default btn-lg">Active</button>
                </div>



                <div id="historicTab" class="col-md-4 text-center"><button type="button" class="btn btn-default btn-lg">Historic</button>
                </div>


                <div id="pendingTab" class="col-md-4 text-center"><button type="button" class="btn btn-default btn-lg">Pending</button>
                </div>

        </div>
    </div>

    <br>

{{--  BEGINNING OF TABLE  --}}
    <div class="container">
        <div class="row">


            <div class="col-md-12">
                <div class="table-responsive">

                    <table id="mytable" class="table table-bordered table-striped table-hover">

                        <thead>

                        <th>Challenge ID</th>
                        <th>Created By</th>
                        <th>Bet Type</th>
                        <th>Challenge Type</th>
                        <th>Wager</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Complete Challenge</th>
                        </thead>
                        <tbody id="buildTableHTML">


                        </tbody>

                    </table>

                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input class="form-control " type="text" placeholder="Mohsin">
                    </div>
                    <div class="form-group">

                        <input class="form-control " type="text" placeholder="Irshad">
                    </div>
                    <div class="form-group">
                        <textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>


                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>



    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>

                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection

