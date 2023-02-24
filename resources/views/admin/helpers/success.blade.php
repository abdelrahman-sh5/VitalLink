@if(session('message'))
<div class="alert alert-success">
    <span class="closebtn" onclick="this.parentElement.style.display='none';"> &times; </span>
    {{session('message')}}
</div>
@endif
