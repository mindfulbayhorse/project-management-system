<div id="top_slogan" class="@if (Auth::check()) shortcut @endif">
    <a href="/" class="title">Project management system</a>
    <div class="user_profile">
    	@include('auth.user_panel')
    </div>
</div>