@extends('admin.layout')

@section('main')
    <div class="card">
        <h4 class="card-title">{{$title}}</h4>

        <div class="card-body">
            <p><a href="{{Request::url()}}/create" class="btn btn-w-md btn-outline btn-primary">@lang('system_variable.action_create')</a></p>
            <table class="table" data-provide="selectall selectable">
                @if(!empty($show_field) && count($show_field) > 0)
                <thead>
                    <tr>
                        @foreach($show_field as $sh_fld)
                            <th>{{$sh_fld['title']}}</th>
                        @endforeach
                            <th class="text-center w-100px">@lang('system_variable.table_action')</th>
                    </tr>
                </thead>
                @endif
                <tbody>
                @if(!empty($data) && count($data) > 0)
                    @foreach($data as $item)
                    <tr>
                        @if(!empty($show_field) && count($show_field) > 0)
                            @foreach($show_field as $fld)
                                <td>
                                    @if(!empty($fld['edit']))
                                        <a href="{{Request::url()}}/{{$item->id}}/edit">{{$item[$fld['field_name']]}}</a>
                                    @else
                                        {{$item[$fld['field_name']]}}
                                    @endif
                                </td>
                            @endforeach
                        @endif
                        <td class="text-right table-actions">
                            <a class="table-action hover-primary" href="{{Request::url()}}/{{$item->id}}/edit"><i class="ti-pencil"></i></a>
                            <a class="table-action hover-danger" href="javascript:void(0)" data-id="{{$item->id}}"><i class="ti-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                @else
                    @if(!empty($show_field))
                    <tr>
                        <td colspan="{{count($show_field) + 1}}" style="text-align: center">
                            <div class="alert alert-danger" role="alert">
                                {!! trans('system_variable.warning_count_items') !!}
                            </div>
                        </td>
                    </tr>
                    @endif
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('modals')
    <!-- Modal -->
    <div class="modal modal-center fade" id="modal-center" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('system_variable.delete_modal_title')</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <br><br><br>
                    <p style="font-size: 96pt; text-align: center;"><i class="fa fa-trash-o"></i></p>
                    <p style="text-align: center; font-size: 22pt;">@lang('system_variable.delete_question')</p>
                    <br><br><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">@lang('system_variable.cancel_delete')</button>
                    <button type="button" class="btn btn-bold btn-pure btn-primary accept_delete">@lang('system_variable.accept_delete')</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    var id = null;
    $('.table-action.hover-danger').click(function(){
        $('#modal-center').modal('show');
        id = $(this).data('id');
    });
    $('.btn.btn-primary.accept_delete').click(function () {
        $.ajax({
            url: '{{Request::url()}}/' + id,
            type: 'DELETE',
            success: function(result) {
                if(result == 1)
                    location.reload();
            }
        });
    })
</script>
@endsection