<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>@yield("title")</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        @yield("styles")
        
    </head>
    <body class="bg-body-secondary">
        <header class="p-3 text-bg-dark">
            <div class="container">
              <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="{{route('home')}}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
                    <span class="fs-4 text-warning">TO</span>
                    <span class="fs-4 text-bg-warning">GO</span>
                    <span class="fs-4 text-warning">LDEN</span>
                </a>
        
                <ul class="nav nav-pills">
                  <li><a href="{{route('home')}}" class="nav-link px-2 text-white me-1">Компании</a></li>
                  @guest
                    <li><a href="{{ route('login') }}"><button type="button" class="btn btn-outline-light me-2">Вход <i class="bi bi-box-arrow-in-left"></i></button></a></li>
                    <li><a href="{{ route('register') }}"><button type="button" class="btn btn-warning">Регистрация <i class="bi bi-person-plus"></i></button></a></li>
                  @else
                    <li><span class="nav-link px-2 text-white me-3"><i class="bi bi-person"></i> {{ Auth::user()->name }}</span></li>
                    <li>
                      <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                      <button type="button" class="btn btn-warning">Выход <i class="bi bi-box-arrow-right"></i></button>
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                      </form>
                    </li>
                  @endguest
                </ul>
        
                <div class="text-end">
                  
                  
                </div>
              </div>
            </div>
          </header>
            
          <div id='main'>
            @yield("content")
          </div>
            

            @yield("scripts")
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    </body>
</html>

                        