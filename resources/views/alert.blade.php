@if ($errors->any())
    <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show mt-3">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <div class="text-white">Check out the errors</div>
        <ul style="margin-top:10px;">
            @foreach ($errors->all() as $error)
                <li><span style="margin-top:10px;text-transform:uppercase;color:white;">{{ $error }}</span></li>
            @endforeach
        </ul>
    </div>
@endif