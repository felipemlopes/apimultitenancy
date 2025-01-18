
@if(isset ($errors) && count($errors) > 0)
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::get('success', false))
    <?php $data = Session::get('success');?>
    @if (is_array($data))
        @foreach ($data as $msg)
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="fa fa-check"></i>
                {{ $msg }}
            </div>
        @endforeach
    @else
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="fa fa-check"></i>
            {{ $data }}
        </div>
    @endif
@endif
