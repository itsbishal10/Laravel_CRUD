<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    @auth
    <p>Congrats you are logged in !!!</p>
    <form action="/logout" method ="POST">
        @csrf
        <button>Log out</button>

    </form>
    <div style="border: 3px solid black;">
    <h2>Create a new Post </h2>    
    <form action="/create-post" method="POST">
    @csrf
    <input type="text" name="title" placeholder="post title">
    <textarea name="body" placeholder="write the post here"></textarea>
    <button>Create Post</button>
    </form>
    </div>

    
    @else   

    <div style="border: 3px solid black;">
     <h2>Register</h2>
      <form action="/register" method="post">
        @csrf
        <input name="name" type="text" placeholder="name">
        <input name="email" type="text" placeholder="email">
        <input name="password" type="password" placeholder="password">
        <button >Register</button>
      </form>
    </div>

</br> 
    <div style="border: 3px solid black;">
     <h2>Login</h2>
      <form action="/login" method="post">
        @csrf
        <input name="login_name" type="text" placeholder="name">
        <input name="login_password" type="password" placeholder="password">
        <button >Login</button>
      </form>
    </div>

    @endauth
  </br>
    <div style="border: 3px solid black;">
    <h2>All Posts</h2>
    @foreach ($posts as $post)
        <div style="background-color:skyblue; padding:10px; margin: 10px;">
          <h3>{{$post['title']}} by {{$post->user->name}}</h3>
          {{$post['body']}}
          <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
          <form action="/delete-post/{{$post->id}}" method="POST">
          @csrf
          @method('DELETE')
          <button>Delete Post</button>
        </form>
        </div>
    @endforeach


</body>
</html>