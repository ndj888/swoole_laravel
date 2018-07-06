@include('vendor.UEditor.head')


<div class="form-group {!! !$errors->has($errorKey) ?: 'has-error' !!}">

    <label for="{{$id}}" class="{{$viewClass['label']}} control-label">{{$label}}</label>

    <div class="{{$viewClass['field']}}">
    @include('admin::form.error')

        <script id="{{$id}}" name="{{$name}}" type="text/plain">
            {!! old($column, $value) !!}
        </script>


        <!-- 实例化编辑器 -->
        <script type="text/javascript">
            $(function(){
                // 解决需要刷新二次的BUG
                UE.delEditor('{{$id}}');
                var ue_{{$id}} = UE.getEditor('{{$id}}');
                ue_{{$id}}.ready(function () {
                    ue_{{$id}}.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
                });
            })
        </script>
        @include('admin::form.help-block')

    </div>
</div>
