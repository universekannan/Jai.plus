<ul>
    @foreach($children as $child)
        <li>
            <a href="{{ url()->current() }}?r={{ $child['id'] }}" title="{{ $child['referral_id'] }}">
                <img style="border-radius: 50%; padding: 4px; margin: 0; box-sizing: border-box;" 
                     src="@if($child['photo']){{ asset('upload/profile_photo/'.$child['photo']) }}@else{{ asset('upload/profile_photo/user.png') }}@endif" 
                     width="70" height="70" alt="{{ $child['name'] }}" />
                <br>{{ $child['name'] }}
            </a>

            @if(!empty($child['children']))
                @include('admin.users.geneology_branch', ['children' => $child['children']])
            @endif
        </li>
    @endforeach
</ul>
