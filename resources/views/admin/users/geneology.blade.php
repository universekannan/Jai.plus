@extends('admin.layouts.app')
@section('content')
<style>

.tree-container {
  overflow-x: auto;
  padding: 20px;
  text-align: center;
}

.tree {
  display: table;
  margin: 0 auto;
  position: relative;
}

.tree ul {
  padding-top: 20px;
  position: relative;
  display: table;
  margin: 0 auto;
}

.tree li {
  display: table-cell;
  vertical-align: top;
  text-align: center;
  position: relative;
  padding: 20px 10px 0 10px;
}

.tree li::before, .tree li::after {
  content: '';
  position: absolute;
  top: 0;
  border-top: 1px solid #ccc;
  width: 50%;
  height: 20px;
}

.tree li::before {
  right: 50%;
  border-right: 1px solid #ccc;
}

.tree li::after {
  left: 50%;
  border-left: 1px solid #ccc;
}

.tree li:only-child::before, .tree li:only-child::after {
  display: none;
}

.tree li:only-child {
  padding-top: 0;
}

.tree li:first-child::before, .tree li:last-child::after {
  border: none;
}

.tree ul ul::before {
  content: '';
  position: absolute;
  top: 0;
  left: 50%;
  border-left: 1px solid #ccc;
  height: 20px;
}

.tree li a {
  border: 1px solid #ccc;
  padding: 10px 5px;
  text-decoration: none;
  color: #333;
  font-size: 12px;
  display: inline-block;
  border-radius: 5px;
  width: 160px;
  background-color: #fff;
}

.tree li a img {
  border-radius: 50%;
  width: 70px;
  height: 70px;
  padding: 4px;
}

.tree li a:hover, .tree li a:hover+ul li a {
  background: #c8e4f8;
  color: #000;
  border: 1px solid #94a0b4;
}

.tree li a:hover+ul li::after,
.tree li a:hover+ul li::before,
.tree li a:hover+ul::before,
.tree li a:hover+ul ul::before {
  border-color: #94a0b4;
}
</style>

<div class="page-wrapper">
  <div class="page-content">
    <div class="page-breadcrumb d-flex align-items-center justify-content-between mb-3">
      <div class="mb-0">
        <h6>Genealogy</h6>
      </div>
    </div>

    <div class="tree-container">
        <div class="tree" style="text-align: center;">
          <ul>
              <li>
                  <a href="{{ url()->current() }}?r={{ $tree['id'] }}" title="{{ $tree['referral_id'] }}">
                      <img style="border-radius: 50%; padding: 4px; margin: 0; box-sizing: border-box;" 
                          src="@if($tree['photo']){{ asset('upload/profile_photo/'.$tree['photo']) }}@else{{ asset('upload/profile_photo/user.png') }}@endif" 
                          width="70" height="70" alt="{{ $tree['name'] }}" />
                      <br>{{ $tree['name'] }}
                  </a>
      
                  @if(!empty($tree['children']))
                      @include('admin.users.geneology_branch', ['children' => $tree['children']])
                  @endif
              </li>
          </ul>
      </div>
    </div>
    
    {{-- <div class="card">
      <div class="card-body">
        <div class="tree" style="text-align: center;">
          <ul>
            <li>
              <a href="{{ url()->current() }}?r={{ $primaryuse->id }}" title="{{ $primaryuse->referral_id }}">
                <img style="border-radius: 50%; padding: 4px; margin: 0; box-sizing: border-box;" 
                     src="@if($primaryuse->photo !== NULL){{ asset('upload/profile_photo') }}/{{ $primaryuse->photo }}@else{{ asset('upload/profile_photo/user.png') }}@endif" 
                     width="70" height="70" alt="{{ $primaryuse->name }}" />
                <br>{{ $primaryuse->name }}
              </a>
              
              @if(isset($uses['u'.$primaryuse->id]) && count($uses['u'.$primaryuse->id]) > 0)
              <ul>
                @foreach($uses['u'.$primaryuse->id] as $m)
                <li>
                  <a href="{{ url()->current() }}?r={{ $m['id'] }}" title="{{ $m['referral_id'] }}">
                    <img style="border-radius: 50%; padding: 4px; margin: 0; box-sizing: border-box;" 
                         src="@if($m['photo'] !== NULL){{ asset('upload/profile_photo') }}/{{ $m['photo'] }}@else{{ asset('upload/profile_photo/use.jpg') }}@endif" 
                         width="70" height="70" alt="{{ $m['name'] }}" />
                    <br>{{ $m['name'] }}
                  </a>
                  
                  @if(isset($uses['u'.$m['id']]) && count($uses['u'.$m['id']]) > 0)
                  <ul>
                    @foreach($uses['u'.$m['id']] as $s)
                    <li>
                      <a href="{{ url()->current() }}?r={{ $s['id'] }}" title="{{ $s['referral_id'] }}">
                        <img style="border-radius: 50%; padding: 4px; margin: 0; box-sizing: border-box;" 
                             src="@if($s['photo'] !== NULL){{ asset('upload/profile_photo') }}/{{ $s['photo'] }}@else{{ asset('upload/profile_photo/use.jpg') }}@endif" 
                             width="70" height="70" alt="{{ $s['name'] }}" />
                        <br>{{ $s['name'] }}
                      </a>
                      
                      @if(isset($uses['u'.$s['id']]) && count($uses['u'.$s['id']]) > 0)
                      <ul>
                        @foreach($uses['u'.$s['id']] as $v)
                        <li>
                          <a href="{{ url()->current() }}?r={{ $v['id'] }}" title="{{ $v['referral_id'] }}">
                            <img style="border-radius: 50%; padding: 4px; margin: 0; box-sizing: border-box;" 
                                 src="@if($v['photo'] !== NULL){{ asset('upload/profile_photo') }}/{{ $v['photo'] }}@else{{ asset('upload/profile_photo/use.jpg') }}@endif" 
                                 width="70" height="70" alt="{{ $v['name'] }}" />
                            <br>{{ $v['name'] }}
                          </a>
                        </li>
                        @endforeach
                      </ul>
                      @endif
                    </li>
                    @endforeach
                  </ul>
                  @endif
                </li>
                @endforeach
              </ul>
              @endif
            </li>
          </ul>
        </div>
      </div>
    </div> --}}
    <!-- /.card -->
  </div>
  <!-- /.page-content -->
</div>
<!-- /.page-wrapper -->

@endsection