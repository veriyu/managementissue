@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$pageTitle}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{route('issue.update',$issue)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Isu</label>
                            <input type="text" name="name" class="form-control" value="{{$issue->name}}">
                            @if($errors->has('name'))
                                $errors->first('name')
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" name="date" class="form-control" value="{{$issue->date}}">
                            @if($errors->has('date'))
                                $errors->first('name')
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">simpan</button>
                            <a href="{{route('issue.index')}}" class="btn btn-link btn-block">kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
