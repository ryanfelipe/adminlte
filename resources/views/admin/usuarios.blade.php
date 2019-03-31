@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Usuários</h1>
    
@stop

@section('content')

<table class="table table-bordered">
    @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>
                <a class="btn btn-app"
                    id="editarUsuario" 
                   data-toggle="modal" 
                   data-target="#modal-default"
                   data-user="{{$user}}">
                    <i class="fa fa-edit"></i> Edit
                </a>
                
            </td>
        </tr>
    @endforeach
    </table>

    {{ $users->links() }}

    <div class="modal fade" id="modal-default" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
                    <div class="box box-primary">
                    <div class="box-body">
                        <form action="{{route('alterarpermissao')}}" method="POST">
                        <div class="form-group">
                            <div class="row">                            
                                <div class="col-md-3">
                                    <label for="permissions">PERFIL</label>
                                    <span id="permissoes" data-permissoes="{{env('PERMISSIONS')}}"></span>
                                    <select  class="form-control" id="user_p" placeholder="Enter email">                            
                                    </select>
                                </div>
                                <div class="col-md-2">                                 
                                  {{csrf_field()}}
                                  <input type="hidden" name="id">
                                  <input type="hidden" name="permissao"> 
                                    <label>Opção</label>    
                                    <button type="submit" class="btn btn-primary">CONFIRMAR</button>                                    
                                </div>
                            </div>                                                    
                        </div>
                        </form>

                    </div>                    
                </div>
              </div>
              <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> -->
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>  
@stop

