@if(session('message') && session('message') == 'Added Successfully')
    <div class="alert alert-success">
        <span class="closebtn" onclick="this.parentElement.style.display='none';"> &times; </span>
        {{session('message')}}
    </div>
@elseif(session('message') && session('message') == 'Deleted')
    <div class="alert alert-danger">
        <span class="closebtn" onclick="this.parentElement.style.display='none';"> &times; </span>
        {{session('message')}}
    </div>
@endif
