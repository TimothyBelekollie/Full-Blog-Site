<span class="closeButton">&times;</span>
<p class="brand-title"><a href="{{url('/')}}">TIM Blog</a></p>

<div class="side-links">
  <ul>
    <li><a class="{{Request::routeIs('welcome.index') ? 'active' : ''}}" href="{{route('welcome.index')}}">Home</a></li>
    <li><a class="{{Request::routeIs('blog.index') ? 'active' : ''}}" href="{{route('blog.index')}}">Blog</a></li>
    <li><a class="{{Request::routeIs('about') ? 'active' : ''}}" href="{{route('about')}}">About</a></li>
    <li><a class="{{Request::routeIs('contact.index') ? 'active' : ''}}" href="{{route('contact.index')}}">Contact</a></li>
   @guest
   <li><a class="{{Request::routeIs('login') ? 'active' : ''}}" href="{{route('login')}}">Login</a></li>
   <li><a class="{{Request::routeIs('register') ? 'active' : ''}}" href="{{route('register')}}">Register</a></li>
   @endguest
  @auth
  <li><a class="{{Request::routeIs('dashboard') ? 'active' : ''}}" href="{{route('dashboard')}}">Dashboard</a></li>
  @endauth
  </ul>
</div>

<!-- sidebar footer -->
<footer class="sidebar-footer">
  <div>
    <a href=""><i class="fab fa-facebook-f"></i></a>
    <a href=""><i class="fab fa-instagram"></i></a>
    <a href=""><i class="fab fa-twitter"></i></a>
  </div>

  <small>&copy 2021 TIM Blog</small>
</footer>