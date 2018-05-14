<ul id="sidebarnav">
	<li class="nav-devider"></li>
	<li class="nav-label">Home</li>
@foreach($items as $menu_item)
	<li><a href="{{ $menu_item->link() }}"><i class="fa fa-bar-chart"></i>{{ $menu_item->title }}</a></li>
@endforeach
</ul>