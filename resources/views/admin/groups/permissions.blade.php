@extends('layouts/admin')

@section('content')
    <h1>Phân quyền Nhóm người dùng: {{$groups->name}}</h1>
    <p><a href="{{route('admin.groups.index')}}" class="btn btn-success">Quay lại</a></p>
    @if(session('msg'))
    <div class="alert alert-success">
        {{session('msg')}}
    </div>
    @endif

    <form action="" method="POST">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="20%">Modules</th>
                    <th>Phân quyền</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($modules))
                    @foreach($modules as $module)
                <tr>
                    <td>{{$module->title}}</td>
                    <td>
                        <div class="row">
                            @if(!empty($roleListArr))
                                @foreach($roleListArr as $roleName => $roleTitle) 
                                    <div class="col-2">
                                        <label for="role_{{$module->name}}_{{$roleName}}">
                                            <input type="checkbox" name="role[{{$module->name}}][]" id="role_{{$module->name}}_{{$roleName}}" value="{{$roleName}}" {{isRole($roleArr, $module->name, $roleName) ? 'checked': false}}>
                                            {{$roleTitle}}
                                        </label>
                                    </div>
                                @endforeach
                            @endif
    
                            @if($module->name=='groups')
                                <div class="col-3">
                                    <label for="role_{{$module->name}}_permissions">
                                        <input type="checkbox" name="role[{{$module->name}}][]" id="role_{{$module->name}}_permissions" value="permissions" {{isRole($roleArr, $module->name, 'permissions') ? 'checked': false}}>
                                        Phân quyền
                                    </label>
                                </div>
                            @endif
                        </div>
                    </td>
                </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        @csrf
        <button class="btn btn-primary" type="submit">Phân quyền</button>
    </form>
@endsection