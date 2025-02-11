@extends('layouts.layout')

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
                                <a href="{{ route('getFixedAsset', $fa->id) }}" class="btn btn-sm btn-outline-info"
                                    title="Update">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row m-3">
            @if (session('msgSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('msgSuccess') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session('msgError'))
                <div class="alert alert-success alert-danger fade show" role="alert">
                    {{ session('msgError') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div>
@endsection
