@extends('layout')
@section('content')
<div class="container mt-4">
    <form action="{{ route('uploadToDatabase') }}" method="POST">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Column Name</th>
                    <th>Matching Header</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($headers as $filename => $fileHeaders)
                    <tr>
                        <td>First Name</td>
                        <td>
                            <select class="form-select" name="headers[{{ $filename }}][first_name]">
                                <option value="">Select Column</option>
                                @foreach ($fileHeaders as $header)
                                    <option value="{{ $header }}">{{ $header }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td>
                            <select class="form-select" name="headers[{{ $filename }}][last_name]">
                                <option value="">Select Column</option>
                                @foreach ($fileHeaders as $header)
                                    <option value="{{ $header }}">{{ $header }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            <select class="form-select" name="headers[{{ $filename }}][email]">
                                <option value="">Select Column</option>
                                @foreach ($fileHeaders as $header)
                                    <option value="{{ $header }}">{{ $header }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>
                            <select class="form-select" name="headers[{{ $filename }}][phone]">
                                <option value="">Select Column</option>
                                @foreach ($fileHeaders as $header)
                                    <option value="{{ $header }}">{{ $header }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>
                            <select class="form-select" name="headers[{{ $filename }}][address]">
                                <option value="">Select Column</option>
                                @foreach ($fileHeaders as $header)
                                    <option value="{{ $header }}">{{ $header }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Upload to Database</button>
    </form>
</div>
@endsection