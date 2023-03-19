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
@elseif(session('message') && session('message') == 'Email')
    <script> alert('Your pin code is sent .. check your email inbox') </script>
@elseif(session('message') && session('message') == 'Password')
    <script> alert('Your password has been updated') </script>
@endif
