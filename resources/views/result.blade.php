<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Scraper Shopee</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <div class="row">
      <form  action="{{url('/')}}" method="get">
         <div class="col-md-12 mt-4">
           <div class="input-group input-group-sm mb-3">
      <span class="input-group-text" id="inputGroup-sizing-sm">Search</span>
      <input type="text" class="form-control" name="keyword">
    </div>
         </div>
           <button type="submit" class="btn btn-primary col-md-12">Cari</button>
         </form>
          <div class="col-md-12">
             <form  action="{{url('/')}}" method="get">
              <div class="input-group input-group-sm mb-3">
      
      <input type="text" hidden class="form-control" name="store">
    </div>
            <button type="submit" class="btn btn-success col-md-12">Store Data</button>
             </form>
          </div>
@foreach ($name as $result)
      <div class="col-md-3 mt-4">
 
        <div class="card">
  <img src="https://cf.shopee.co.id/file/{{$result['image']}}" class="card-img-top" alt="...">
  <div class="card-body">
    <h6 class="card-title">{{$result['name']}}</h6>
    <p class="card-text">Price: {{$result['price']}} <br>
    State: {{$result['shop_location']}} <br>
   Stock: {{$result['stock']}} </p>
  
    <a href="https://shopee.co.id/api/v2/item/get?itemid={{$result['itemid']}}&shopid={{$result['shopid']}}" class="btn btn-primary">Link</a>
  </div>
</div>

      </div>
@endforeach
    </div>
  </div>
</body>
</html>


