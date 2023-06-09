<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Watermark Image Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
          <a class="navbar-brand" href="/">Image Watermark</a>
        </div>
    </nav>
    <div class="container py-5">
      <h2 class="text-center font-weight-bold-center mb-4">Watermark Your Picture Here</h2>
      <p class="text-center">The easiest and simplest way to give your picture watermark</p>
      <div class="row mt-5">
        <div class="col-md-5">
          <div class="card shadow mb-5">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Input Picture</h4>
              </div>
              <div class="card-body">
                @if ($errors->any())
                  <div class="alert alert-danger mb-3 pb-0">
                      <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                  </div>
                @elseif($message = Session::get('success'))
                  <div class="alert alert-success mb-3 pb-0">
                    <ul>
                      <li>{{ $message }}</li>
                    </ul>
                  </div>
                @endif
                {{-- @if (session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
                @endif --}}
                <form action="{{ route('picture.store') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="name">Watermark</label>
                    <input type="text" class="form-control" name="name" value="{{ session('watermark') }}" placeholder="Input your watermark here">
                  </div>
                  <div class="form-group mt-2">
                    <label for="size">Size</label>
                    <input type="text" class="form-control" name="size" value="{{ session('size') }}" placeholder="Input your size here">
                  </div>
                  <div class="form-group mt-2">
                    <label for="color">Color: </label>
                    <select name="color">
                      <option value="#000000">White</option>
                      <option value="#C0C0C0">Silver</option>
                      <option value="#808080">Grey</option>
                      <option value="#FFFFFF">Black</option>
                      <option value="#FF0000">Red</option>
                      <option value="#800000">Maroon</option>
                      <option value="#FFFF00">Yellow</option>
                      <option value="#808000">Olive</option>
                      <option value="#00FF00">Lime</option>
                      <option value="#008000">Green</option>
                      <option value="#00FFFF">Aqua</option>
                      <option value="#008080">Teal</option>
                      <option value="#0000FF">Blue</option>
                      <option value="#000080">Navy</option>
                      <option value="#FF00FF">Fuchsia</option>
                      <option value="#800080">Purple</option>
                    </select>
                    <label for="align">Horizontal: </label>
                    <select name="align">
                      <option value="left">Left</option>
                      <option value="right">Right</option>
                      <option value="center">Center</option>
                    </select>
                    <label for="valign">Vertical: </label>
                    <select name="valign">
                      <option value="top">Top</option>
                      <option value="bottom">Bottom</option>
                      <option value="middle">Middle</option>
                    </select>
                  </div>
                  <div class="form-group mt-2">
                    <label for="">Image: </label><br>
                    <input type="file" name="image" id="image">
                  </div>
                  <div class="text-end">
                    <button type="submit" class="btn btn-success">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
            @if (session('result'))
              <div class="col-md-7">
                <div class="card shadow">
                  <div class="card">
                    <div class="card-header">
                      <h4 class="card-title">Download Picture</h4>
                    </div>  
                    <div class="card-body">
                      @php
                        $result = session('result');
                      @endphp
                      <div class="text-center">
                        <img src="{{asset('storage/pictures/'.$result)}}" class="img-thumbnail round" alt="Image Watermark">
                      </div>
                    </div>
                  </div>
                </div>
              </div>  
            @endif
        </div>
    </div>
  <br>
  <br>
    <!-- Scripts -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
      crossorigin="anonymous"
    ></script>
</body>
<footer style="position: fixed; height: 50px; bottom: 0; width: 100%; background-color: #d3d3d3; padding-top: 15px" id="footer" class="text text-center">
    <p> Developed with &#10084;&#65039; by Farhan kurnia </p>
  </footer>
</html>