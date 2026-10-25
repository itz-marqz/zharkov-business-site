@extends('admin.layout')

@section('main')
    <div class="card">
        <h4 class="card-title">{{$title}} - {{trans('system_variable.action_' . $action)}} </h4>

        <div class="card-body">
            @if(session('report'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{session('report')}}
                </div>
            @endif
            @if(!empty($edit_field))
                <?
                    if(empty($form_action)){
                        $form_action = Request::url();
                        if($action == "create"){
                            $form_action = explode('/', Request::url());
                            if($form_action[count($form_action) - 1] == 'create'){
                                unset($form_action[count($form_action) - 1]);
                                $form_action = implode('/', $form_action);
                            }
                        }else if($action == "edit"){
                            $form_action = explode('/', $form_action);
                            if($form_action[count($form_action) - 1] == 'edit'){
                                unset($form_action[count($form_action) - 1]);
                                $form_action = implode('/', $form_action);
                            }
                        }
                    }                    
                ?>
                <form action="{{$form_action}}" enctype="multipart/form-data" method="post">
                    {!! csrf_field() !!}
                    @if($action == "edit" && !$close_put_request)
                        {{ method_field('PUT') }}
                    @endif
                    @foreach($edit_field as $edit_fld)
                        @include('admin.form_fields.'.$edit_fld['type'])
                    @endforeach
                    <button class="btn btn-label btn-primary"><label><i class="ti-check"></i></label> @lang('system_variable.action_save')</button>
                </form>
            @endif
        </div>
    </div>
@endsection