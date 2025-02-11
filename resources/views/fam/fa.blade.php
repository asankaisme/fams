@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="card mt-3">
            <h5 class="card-header">Fixed Asset Details<span style="float: right; color:gray;">#{{ $fa->id }}</span>
            </h5>
            <div class="card-body">
                <h5 class="card-title">{{ $fa->fa_category }} <span style="float: right;">
                        @if ($fa->status == 'avl')
                            <span class="badge badge-success">Available</span>
                        @elseif ($fa->status == 'dsp')
                            <span class="badge badge-secondary">Disposed</span>
                        @elseif ($fa->status == 'tbd')
                            <span class="badge badge-info">To be Disposed</span>
                        @elseif ($fa->status == 'anf')
                            <span class="badge badge-warning">Asset not found</span>
                        @endif
                    </span></h5>
                <p class="card-text">{{ $fa->description }}.</p>
                <p class="card-text">{{ $fa->fa_number }}.</p>
                <p class="card-text">LKR {{ number_format($fa->cost, 2, '.', ',') }}</p>
                <hr>
                <h5>Asset Status</h5>
                <form action="{{ route('updateFixedAsset', $fa->id) }}" method="post">
                    @csrf
                    <label for=""><input type="radio" name="status" value="avl"
                            {{ $fa->status == 'avl' ? 'checked' : '' }}>Available</label>
                    <label for=""><input type="radio" name="status" value="tbd"
                            {{ $fa->status == 'tbd' ? 'checked' : '' }} style="margin-left: 15px;">To be disposed</label>
                    <label for=""><input type="radio" name="status" value="anf"
                            {{ $fa->status == 'anf' ? 'checked' : '' }} style="margin-left: 15px;">Asset not found</label>
                    <label for=""><input type="radio" name="status" value="dsp"
                            {{ $fa->status == 'dsp' ? 'checked' : '' }} style="margin-left: 15px;">Disposed</label>
                    <div class="form-group mt-3">
                        <label for="remarks">Remark</label>
                        <input type="text" name="remarks" id="remarks" class="form-control form-control-sm"
                            placeholder="Optional" value="{{ $fa->remarks ?? ''}}">
                    </div>
                    <input type="reset" value="Clear" class="btn btn-sm btn-outline-danger" style="float: right;">
                    <a href="{{ route('faindex') }}" class="btn btn-sm btn-outline-dark" style="float: right; margin-right:3px;">Back</a>
                    <input type="submit" value="Update" class="btn btn-sm btn-primary"
                        style="float: right; margin-right:3px;">
                </form>
            </div>
        </div>
    </div>
@endsection
