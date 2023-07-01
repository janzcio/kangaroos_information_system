@extends('layouts.authenticated.layout')

@section('title', 'Kangaroos')
@section('page_name', 'Kangaroos')
@section('page_description', 'List of Kangaroos')

@section('extend-css')
<link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/23.1.3/css/dx.light.css">
<style>
    .fs-15px {
        font-size: 15px !important;
    }
</style>
@endsection


@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('web.kangaroos.index') }}"> <i class="ti-harddrives"></i> </a>
    </li>
    <li class="breadcrumb-item"><a href="{{ route('web.kangaroos.index') }}">Kangaroos</a>
    </li>
</ul>

@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Kangaroos Table</h5>
                        <span>List of Kangaroos and details</span>
                        <div class="card-header-right">
                            <a href="{{ route('web.kangaroos.create') }}" class="btn waves-effect waves-light btn-primary fs-15px"> Add New </a>
                        </div>
                    </div>
                    <div class="card-block">
                        <div id="gridContainer"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('extend-js')
<!-- datagrid -->
<script src="https://cdn3.devexpress.com/jslib/23.1.3/js/dx.all.js"></script>
<script>
    $(document).ready(function() {
        getKangaroos()

    })

    function getKangaroos() {
        axios.get('api/kangaroos')
            .then(response => {
                // Handle the response
                $('#gridContainer').dxDataGrid({
                    dataSource: response.data.data,
                    keyExpr: 'id',
                    filterRow: {
                        visible: true
                    },
                    headerFilter: {
                        visible: true
                    },
                    columns: [{
                            dataField: 'name',
                            caption: 'Name',
                            allowHeaderFiltering: false
                        },
                        {
                            dataField: 'birthday',
                            caption: 'Birthday',
                            allowHeaderFiltering: false

                        },
                        {
                            dataField: 'weight',
                            caption: 'Weight',
                            allowHeaderFiltering: false
                        },
                        {
                            dataField: 'height',
                            caption: 'Height',
                            allowHeaderFiltering: false
                        },
                        {
                            dataField: 'friendliness',
                            caption: 'Friendliness',
                        },
                        {
                            type: "buttons",
                            caption: 'Actions',
                            buttons: [{
                                // ...
                                template: function(data, row, column) {
                                    const kid = row.data.id;
                                    return $("<div>").html('<a href="/kangaroos/' + kid + '/edit" title="Edit"> <i class="icofont icofont-edit f-15 text-success" style="display: inline-block;"></i> </a>&nbsp;<a href="#" title="Delete" class="delete-kangaroo" data-id="' + kid + '" onclick="deleteTrigger(this, ' + kid + ')"> <i class="icofont icofont-trash f-15 text-danger" style="display: inline-block;"></i> </a>');
                                },
                            }]
                        }
                    ],
                    showBorders: true,
                });
            })
            .catch(error => {
                // Handle the error
                console.error(error);
            });
    }

    function deleteTrigger(el, id) {
        console.log(el);
        console.log(id);
        // Handle click event on delete links

        var link = $(el);
        var id = link.data('id');
        console.log(link);
        console.log(id  );
        // Show the confirm dialog
        if (confirm('Are you sure you want to delete this item?')) {
            // User clicked "OK" in the confirm dialog
            // Perform the delete action

            // Make the AJAX request to delete the item
            axios.delete('/api/kangaroos/' + id)
                .then((response) => {
                    showNofif('success', "Successs!", "Kangaroo successfully deleted.")
                    // Handle success response
                    getKangaroos()
                })
                .catch((error) => {
                    // Handle error response
                    console.error(error);
                    // Perform error handling actions if needed
                });
        } else {
            // User clicked "Cancel" in the confirm dialog
            // Do nothing or perform any other desired action
        }
    }
</script>
@endsection