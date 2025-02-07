@extends('layouts.layout')

@push('custom-modal-css')
    <style>
        /* The container */
        .container {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            /* font-size: 22px; */
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default radio button */
        .container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* Create a custom radio button */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
            border-radius: 50%;
        }

        /* On mouse-over, add a grey background color */
        .container:hover input~.checkmark {
            background-color: #ccc;
        }

        /* When the radio button is checked, add a blue background */
        .container input:checked~.checkmark {
            background-color: #2196F3;
        }

        /* Create the indicator (the dot/circle - hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the indicator (dot/circle) when checked */
        .container input:checked~.checkmark:after {
            display: block;
        }

        /* Style the indicator (dot/circle) */
        .container .checkmark:after {
            top: 9px;
            left: 9px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: white;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row m-3">
            <table id="myTable" name="myTable" class="table table-sm table-hover table-striped">
                <thead>
                    <th>#</th>
                    <th>FA Category</th>
                    <th>FA Number</th>
                    <th>Description</th>
                    <th>Cost</th>
                    <th>NBV</th>
                    <th>Date of capitalized</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($fas as $fa)
                        <tr class="cursor-pointer hover:bg-blue-400">
                            <td style="color: grey">{{ $fa->id }}</td>
                            <td>{{ $fa->fa_category }}</td>
                            <td>{{ $fa->fa_number }}</td>
                            <td>{{ $fa->description }}</td>
                            <td>{{ number_format($fa->cost, 2, '.', ',') }}</td>
                            <td>{{ number_format($fa->nbv, 2, '.', ',') }}</td>
                            <td>{{ $fa->doc }}</td>
                            <td>{{ $fa->location }}</td>
                            <td>
                                @if ($fa->status == 'avl')
                                <span class="badge badge-success">avl</span>
                                @elseif ($fa->status == 'dsp')
                                <span class="badge badge-secondary">dsp</span>
                                @elseif ($fa->status == 'tbd')
                                <span class="badge badge-info">tdb</span>
                                @elseif ($fa->status == 'anf')
                                <span class="badge badge-warning">anf</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-info"
                                    onclick="showFixedAsset({{ $fa->id }})">Load</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row m-3">
            {{-- bootstrap modal goes here --}}
            <div class="modal" tabindex="-1" role="dialog" id="fa-modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Fixed Asset Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fa_number">FA Number</label>
                                        <p><strong><span id="fa_number"></strong></span> | #<span id="fa_id" style="color: rgb(197, 197, 197)"></span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <p><strong><span id="description"></strong></span></p>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>


                        <form action="" method="post" id="updateFixedAsset">
                            {{-- @csrf --}}
                            {{-- <input type="hidden" name="fa_id" id="fa_id"> --}}
                            <div class="col-md-12">
                                <label class="container">Available
                                    <input type="radio" name="asset_status" id="avl" value="avl">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">To be disposed
                                    <input type="radio" name="asset_status" id="tbd" value="tbd">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Disposed
                                    <input type="radio" name="asset_status" id="dsp" value="dsp">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Asset not found/ need time more time
                                    <input type="radio" name="asset_status" id="anf" value="anf">
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                                <button type="reset" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            {{-- end of modal --}}
        </div>
    </div>
@endsection

@push('script-for-modal')
    <script>
        function showFixedAsset(id) {
            $.ajax({
                url: "/get-fixed-asset/" + id,
                type: "GET",
                success: function(response) {
                    $("#description").text(response.description);
                    $("#fa_number").text(response.fa_number);
                    $("#fa_id").val(response.id);
                    $("#faid").text(response.id);
                    $("#fa-modal").modal("show");
                }
            });
        }
    </script>
    {{-- script for form submission --}}
    <script>
        $(document).ready(function() {
            $("#updateFixedAsset").submit(function(event) {
                event.preventDefault(); // Prevent normal form submission

                let assetId = $("#fa_id").val(); // Get ID from hidden field
                let assetStatus = $("input[name='asset_status']:checked").val(); // Get selected radio button value
                // let assetValue = $("#assetValue").val();

                $.ajax({
                    url: "/update-fixed-asset/" + assetId, // Update API
                    type: "POST", // Use PUT for updates
                    data: {
                        // id: assetId,
                        status: assetStatus,
                        _token: "{{ csrf_token() }}" // CSRF Token for Laravel
                    },
                    success: function(response) {
                        // alert("Asset updated successfully!");
                        $("#fa-modal").modal("hide"); // Close modal
                        location.reload(); // Reload page to update table
                        alert("Fixed asset status is changed.");
                    },
                    error: function(xhr) {
                        alert("Something went wrong! " + xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush
