@extends('layout')

@section('content')
    <div class="container mt-4">
       
        <form action="{{ route('uploadCsv') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="csvFiles" class="form-label">Upload CSV Files:</label>
                <input type="file" class="form-control" name="csvFiles[]" id="csvFiles" multiple>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
@endsection
