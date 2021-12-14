@extends('template.homepage.main')

@section('mainContent')
<div class="box">
    <div class="w3-content w3-display-container">
        <img class="mySlides" src="{{URL::asset('discound1.png');}}" style="width:100%">
        <img class="mySlides" src="{{URL::asset('discound2.png');}}" style="width:100%">
        <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
        <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
    </div>
</div>
<div class="main">
    <div class="bottomline"><h2>Featured Item</h2></div>
    @php
        $barang=DB::table('barang')->get();
    @endphp
    @foreach ($barang as $barang)
        <div class="card">
            <h4 style="text-align: center">{{$barang->nama_barang}}</h4>
            <img src="{{URL::asset('dummy.png')}}" style="width:90%; height:90%; margin:10px; border-radius:10px;">
            <button class="btn btn-success" style="width:250px; margin-left:-6px;">Add to cart</button>
        </div>
    @endforeach

</div>

<script>
    var slideIndex = 1;
    showDivs(slideIndex);
    carousel();

    function plusDivs(n) {
        showDivs(slideIndex += n);
    }
    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        if (n > x.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = x.length
        }
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        x[slideIndex-1].style.display = "block";
    }
    function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > x.length) {slideIndex = 1}
        x[slideIndex-1].style.display = "block";
        setTimeout(carousel, 2000);
    }
</script>
@endsection

@section('secondContent')

@endsection

@section('customStyle')
<style>


.mySlides{
    margin-top:30px;
    border-radius: 10px;
    background-color: teal;
    height:25vw;
    padding: 20px;
}

.box{
    width:100vw;
    height:200px;
    background-color: white;
    padding: 10px;
    border-bottom-left-radius: 75px;
    border-bottom-right-radius: 75px;
}

.card{
    width:250px;
    height:300px;
    background-color: white;
    padding: 5px;
    margin:20px;
    margin-left: 32px;
    float: left;
}

.main{
    width:90%;
    margin:0 auto;
    margin-top:200px;
    height: auto;
}

h2{
    border-bottom:1px solid gray;
}

a {
  text-decoration: none;
  display: inline-block;
  padding: 8px 16px;
}

a:hover {
  background-color: #ddd;
  color: black;
}

.previous {
  margin-top:7vw;
  background-color: #f1f1f1;
  position: absolute;
  font-weight: 900;
  color: black;
}

.next {
  margin-top:7vw;
  float: right;
  background-color: #f1f1f1;
  font-weight: 900;
  color: black;
}

.round {
  border-radius: 50%;
}

@media screen and (max-width: 600px) {
    .col-25, .col-75, input[type=submit] {
        width: 100%;
        margin-top: 0;
    }
}
</style>
@endsection
