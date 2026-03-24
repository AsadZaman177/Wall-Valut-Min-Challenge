@props(['title'=>'', 
        'showLink' => true, 
        'linkUrl' => '#', 
        'linkText' => 'Add New',
        'datatoggle'=>'',
        'datatarget'=>''])
       

<div class="card card-outline card-primary">
    <div class="card-header align-content-center d-flex">
        <h3 class="card-title mr-auto p-2"><i class="fas fa-edit"></i> {{ $title }}</h3>

        @if ($showLink)
            <a href="{{ $linkUrl }}" type="button" class="btn btn-primary btn-sm" 
                @if(!empty($datatoggle)) data-toggle={{ $datatoggle }} @endif  
                @if(!empty($datatarget)) data-target={{ $datatarget }} @endif>
                <i class="fa fa-plus-circle"></i> {{ $linkText }}</a>
        @endif
    </div>

    <div class="card-body">
        {{ $slot }}
    </div>
</div>
