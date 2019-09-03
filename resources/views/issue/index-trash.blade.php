@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                {{$pageTitle}}
                <a href="{{route('issue.index')}}" class="float-right">kembali</a>
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
                            @forelse($data as $key => $value)
                            <tr>
                                <td></td>
                                <td>{{$value->date}}</td>
                                <td>{{$value->name}}</td>
                                <td class="d-flex">

                                    <form action="{{route('issue.restore',$value)}}" class="form-inline" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-link">restore</button>
                                    </form>
                                    <form action="{{route('issue.remove',$value)}}" class="form-inline" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link">delete permanent</button>
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
