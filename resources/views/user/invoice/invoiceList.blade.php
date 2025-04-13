@extends('layout')
@section('content')
    <div class="functionality-content mt-4">
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-3 text-end">
                <form action="{{-- route('admin.search') --}}" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="search" name="find" id="find" placeholder="Search" class="form-control py-0">
                        <button type="submit" class="btn btn-sm btn-dark"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-md-1 text-end">
                <a href="{{ route('add.invoice') }}" class="btn btn-sm btn-dark align-end mb-3"><i class="fa fa-plus"></i> Add</a>
            </div>
        </div>
    </div>
    <div class="container pt-4 px-3 mx-2 mb-2 rounded" style="width:100%;float:inline-end;background-color:rgb(239, 247, 255)">
        @if (session()->has('message'))
            <div class="success-msg">{{session('message')}}</div>
        @endif
        <div class="table table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Joining Date</th>
                        {{-- @if (auth()->user()->role_id == "2")
                            <th>Leaving Date</th>
                            <th>Status</th>
                        @endif --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sr=1;
                    @endphp
                    {{-- @if (count($list) > 0)
                        @foreach ($list as $row)
                            @php
                                $joining = date('d-M-Y', (int)$row->joining_date);
                                if($row->leaving_date == null || $row->leaving_date == ""){
                                    $leaving = "not left yet";
                                }else{
                                    $leaving = date('d-M-Y', (int)$row->leaving_date);
                                }
                            @endphp
                            <tr>
                                <td>{{$sr}}</td>
                                <td class="text-capitalize">{{$row['firstname']." ".$row['lastname']}}</td>
                                <td class="text-capitalize">{{$row['role']}}</td>
                                <td>{{$row['email']}}</td>
                                <td>{{$row['contact']}}</td>
                                <td>{{$joining}}</td>
                                @if (auth()->user()->role_id == "2")
                                    <td>{{$leaving}}</td>
                                    <td>{{$row->status}}</td>
                                @endif
                                <td class="d-flex">
                                    <a href="{{route('admin.edit', $row['id'])}}" class="btn btn-sm btn-info mx-1"><i class="fa fa-edit"></i> Edit</a>
                                    <form action="{{route('admin.delete', $row['id'])}}" method="post">
                                        @csrf
                                        @method("delete")
                                        
                                        <button type="submit" class="btn btn-sm btn-danger mx-1"><i class="fa fa-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @php
                                $sr++;
                            @endphp
                        @endforeach
                    @else --}}
                        <tr>
                            <td colspan="7" class="h5 text-danger text-center">Record Not Found</td>
                        </tr>
                    {{-- @endif --}}
                </tbody>
                {{-- @if ($list->lastPage() > 1)
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                {{ $list->links() }}
                            </td>
                        </tr>
                    </tfoot>
                @endif --}}
            </table>
        </div>
    </div>
@endsection