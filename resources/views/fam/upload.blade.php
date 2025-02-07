@extends('layouts.layout')

@section('content')
    <div class="container mt-10">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('updloadExcelFilePost') }}" method="post" enctype="multipart/form-data">
                    <div class="mt-5">
                        @csrf
                    <input type="file" name="excelfile" id="">
                    <input type="submit" value="Upload" class="btn btn-sm btn-primary">
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            @session('Success')
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endsession
        </div>
    </div>
@endsection
