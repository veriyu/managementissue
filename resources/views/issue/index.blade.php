@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                {{$pageTitle}}
                <a href="{{route('issue.create')}}" class="ml-4 float-right">Buat isu</a>
                <a href="{{route('issue.trash')}}" class="float-right text-danger">trash</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <table class="table table-sm">
                        <thead>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Isu</th>
                            <th width="100px">Action</th>
                        </thead>
                        <tbody>
                            <form action="{{route('issue.index')}}" method="GET">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><input type="text" name="name"></td>
                                    <td><button type="submit">search</button></td>
                                </tr>
                            </form> 
                            @forelse($data as $key => $value)
                            <tr>
                                <td></td>
                                <td>{{$value->date}}</td>
                                <td>{{$value->name}}</td>
                                <td class="d-flex">
                                    <a href="{{route('issue.edit',$value)}}" class="btn btn-link">edit</a>
                                    <form action="{{route('issue.destroy',$value)}}" class="form-inline" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link">delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4">
                                    {!! $data->links() !!}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
